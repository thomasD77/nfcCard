<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Mail\newBooking;
use App\Mail\updateBooking;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Location;
use App\Models\Service;
use App\Models\Status;
use App\Models\Timeslot;
use App\Models\User;
use Brian2694\Toastr\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Spatie\GoogleCalendar\Event;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bookings = Booking::paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $role = ['client'];
        $clients = User::whereHas('roles', function($q) use($role) {
            $q->whereIn('name', $role);})
            ->where('archived', 0)
            ->pluck('name', 'id')
            ->all();

        $services = Service::where('archived', 0)
            ->pluck('name', 'id');

        $locations = Location::where('archived', 0)
            ->pluck('name', 'id');

        $statuses = Status::pluck('name', 'id')
            ->all();

        return view('admin.bookings.create', compact('clients', 'services', 'locations', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $bookingTime = Carbon::parse($request->date . " " . $request->startTime);
        if($bookingTime < now()->addHours(2))
        {
            Session::flash('date', 'You cant book in the past. Please select new date');
            return redirect()->back();
        }

        if(Auth::user()->roles->first()->name == 'client')                                                                //Booking from Client
        {
            $this->validate($request, [
                'services'=>'required',
                'location_id'=>'required',
                'date'=>'required',
                'startTime'=>'required',
            ]);

            $booking = new Booking();
            $booking->location_id = $request->location_id;
            $booking->user_id = Auth::user()->id;
            $booking->client_id = Auth::user()->id;
            $booking->date = $request->date;
            $booking->booking_request_admin = 1;
            $booking->startTime = $request->startTime;
            $booking->endTime = Carbon::parse($request->startTime)->addHour(2);                                         //Default endTime for Client
            $booking->status_id = 1;
            $booking->remarks = $request->remarks;
        }
        else                                                                                                            //Booking from other Role
        {
            if($request->startTime > $request->endTime ){
                Session::flash('timeslot', 'Your End time has to ends after your Start time. Please do it again.');
                return redirect()->back();
            }
            $this->validate($request, [
                'client_id'=>'required',
                'status_id'=>'required',
                'services'=>'required',
                'location_id'=>'required',
                'date'=>'required',
                'startTime'=>'required',
                'endTime'=>'required',
            ]);
            $booking = new Booking();
            $booking->location_id = $request->location_id;
            $booking->client_id = $request->client_id;
            $booking->user_id = Auth::user()->id;
            $booking->status_id = $request->status_id;
            $booking->date = $request->date;
            $booking->startTime = $request->startTime;
            $booking->endTime = $request->endTime;
            $booking->remarks = $request->remarks;
            $booking->booking_request_client = 1;

            //Timeslot range
            $start = Carbon::parse($request->startTime);
            $end = Carbon::parse($request->endTime);
            $range = $start->diffInMinutes($end);
            $booking->timeslot_range = $range;
        }
        $booking->save();

        //Google Calendar credentials
        $client = User::where('id', $booking->client_id)->first();
        $booking->google_calendar_name = 'Booking' . "-" . $client->name . "-" . $booking->location->name . "-" . $booking->status->name;
        $booking->update();

        //wegschrijven van de tussentabel
        $booking->services()->sync($request->services, false);


        //Need to send mail
        if($request->button_submit == 'sendMail')
        {
            $client_mail = $client->email;
            $user_mail = User::findOrFail($booking->user_id)->email;

            $emails = [ $client_mail, $user_mail];

            Mail::to($emails)->send(new newBooking($booking));
        }

        //Google Calendar Booking
        if(Auth::user()->roles->first()->name != 'client')
        {
            $startTime = Carbon::parse($request->date . ' ' . $request->startTime, 'GMT+02:00' );
            $endTime = Carbon::parse($request->date . ' ' . $request->endTime, 'GMT+02:00' );


            $event = Event::create([
                'name' => $booking->google_calendar_name,
                'startDateTime' => $startTime,
                'endDateTime' => $endTime,
                'calendarId' => $booking->location->google_calendar_id,
            ]);

            $booking->event_id = $event->id;
            $booking->update();
        }

        \Brian2694\Toastr\Facades\Toastr::success('Booking Successfully Saved');

        return redirect('/admin/bookings');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $booking = Booking::findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $booking = Booking::findOrFail($id);

        $role = ['client'];
        $clients = User::whereHas('roles', function($q) use($role) {
            $q->whereIn('name', $role);})
            ->where('archived', 0)
            ->pluck('name', 'id')
            ->all();

        $services = Service::where('archived', 0)
            ->pluck('name', 'id');
        $locations = Location::where('archived', 0)
            ->pluck('name', 'id');
        $statuses = Status::pluck('name', 'id')
            ->all();

        return view('admin.bookings.edit', compact('clients', 'services', 'locations','statuses', 'booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $bookingTime = Carbon::parse($request->date . " " . $request->startTime);
        if($bookingTime < now()->addHours(2))
        {
            Session::flash('date', 'You cant book in the past. Please select new date');
            return redirect()->back();
        }

        if($request->startTime > $request->endTime )
        {
            Session::flash('timeslot', 'Your End time has to ends after your Start time. Please do it again.');
            return redirect()->back();
        }

        if(Auth::user()->roles->first()->name == 'client')
        {
            $this->validate($request, [
                'services'=>'required',
                'location_id'=>'required',
                'date'=>'required',
                'startTime'=>'required',
            ]);

            $booking = Booking::findOrFail($id);
            $booking->location_id = $request->location_id;
            $booking->client_id = Auth::user()->id;
            $booking->user_id = Auth::user()->id;
            $booking->date = $request->date;
            $booking->startTime = $request->startTime;
            $booking->endTime = Carbon::parse($request->startTime)->addMinutes($booking->timeslot_range)->format('H:i:s');
            $booking->remarks = $request->remarks;
            $booking->booking_request_admin = 1;
            $booking->booking_request_client = 0;
        }
        else
        {
            $this->validate($request, [
                'client_id'=>'required',
                'status_id'=>'required',
                'services'=>'required',
                'location_id'=>'required',
                'date'=>'required',
                'startTime'=>'required',
                'endTime'=>'required',
            ]);

            $booking = Booking::findOrFail($id);
            $booking->location_id = $request->location_id;
            $booking->client_id = $request->client_id;
            $booking->user_id = Auth::user()->id;
            $booking->status_id = $request->status_id;
            $booking->date = $request->date;
            $booking->startTime = $request->startTime;
            $booking->endTime = $request->endTime;
            $booking->remarks = $request->remarks;
            $booking->booking_request_admin = 0;
            $booking->booking_request_client = 1;
            $booking->approved = 0;

            //Timeslot range
            $start = Carbon::parse($request->startTime);
            $end = Carbon::parse($request->endTime);
            $range = $start->diffInMinutes($end);
            $booking->timeslot_range = $range;
        }
        $booking->update();

        $client = User::where('id', $booking->client_id)->first();
        $booking->google_calendar_name = 'Booking' . "-" . $client->name . "-" . $booking->location->name . "-" . $booking->status->name;
        $booking->update();

        /**wegschrijven van de tussentabel**/
        $booking->services()->sync($request->services, true);

        if($request->button_submit == 'sendMail')
        {
            $client_mail = User::where('id', $booking->client_id)->first()->email;
            $user_mail = User::findOrFail($booking->user_id)->email;

            $emails = [ $client_mail, $user_mail];

            Mail::to($emails)->send(new updateBooking($booking));
        }

        //Google Calendar Booking
        if(Auth::user()->roles->first()->name != 'client')
        {
            $startTime = Carbon::parse($request->date . ' ' . $request->startTime, 'GMT+02:00' );
            $endTime = Carbon::parse($request->date . ' ' . $request->endTime, 'GMT+02:00' );

            $eventId = $booking->event_id;
            if(isset($eventId))
            {
                $event = Event::find($eventId, $booking->location->google_calendar_id);

                $event->update([
                    'name' => $booking->google_calendar_name,
                    'startDateTime' => $startTime,
                    'endDateTime' => $endTime
                ]);
            }
        }

        \Brian2694\Toastr\Facades\Toastr::success('Booking Successfully Updated');

        return redirect('/admin/bookings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function archive()
    {
        $bookings = Booking::where('archived', 1)
            ->latest()
            ->paginate(20);
        return view('admin.bookings.archive', compact('bookings'));
    }

    public function approved(Request $request)
    {
        $booking = Booking::findOrFail($request->booking);
        $booking->approved = 1;
        $booking->update();

        return redirect()->back();
    }
}
