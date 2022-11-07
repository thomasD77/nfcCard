<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactEventRequest;
use App\Http\Requests\CreateNoteContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Requests\UpdateNoteContactRequest;
use App\Models\Contact;
use App\Models\ContactLocation;
use App\Models\Location;
use App\Models\Member;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $count = Contact::where('archived', '=', 0)->count();
        return view('admin.contacts.index', compact('count'));
    }

    public function indexClient(User $user)
    {
        //
        $user = $user;

        $count = \App\Models\Contact::with(['member'])
            ->where('archived', 0)
            ->where('member_id', $user->member_id)
            ->count();

        return view('admin.contacts.index-client', compact('user', 'count'));
    }

    public function archive()
    {
        $team = Auth()->user()->team;
        $users = User::where('team_id', $team->id)->pluck('id');
        $members = Member::whereIn('user_id', $users)->where('archived', 0)->pluck('id');

        $count = \App\Models\Contact::with(['member', 'contactStatus'])
            ->where('archived', 1)
            ->whereIn('member_id', $members)
            ->count();

        return view('admin.contacts.archive', compact('count'));
    }

    public function archiveContact(Contact $contact)
    {
        $contact->archived = 1;
        $contact->update();

        \Brian2694\Toastr\Facades\Toastr::success('Contact Successfully Archived');

        return view('admin.contacts.index');
    }

    public function archiveClients()
    {
        return view('admin.contacts.archive-client');
    }


    public function archiveTeamContacts()
    {
        return view('admin.contacts.archive-teams-contacts');
    }

    public function updateContact(UpdateContactRequest $request, Contact $contact)
    {
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;

        if ($request->sector) {
            $contact->sector_id = $request->sector;
        }
        if ($request->status) {
            $contact->status_id = $request->status;
        }
        if ($request->notes) {
            $contact->notes = $request->notes;
        }

        $contact->update();

        \Brian2694\Toastr\Facades\Toastr::success('Contact Successfully Updated');

        return redirect()->back();
    }

    public function createNoteContact(CreateNoteContactRequest $request, Contact $contact)
    {
        $note = new Note();
        $note->name = $request->notes;
        $note->contact_id = $contact->id;
        $note->save();

        \Brian2694\Toastr\Facades\Toastr::success('Note Successfully Saved');

        return redirect()->back();
    }

    public function updateNoteContact(UpdateNoteContactRequest $request, $id)
    {
        $note = Note::findOrFail($id);
        $note->name = $request->notes;
        $note->update();

        \Brian2694\Toastr\Facades\Toastr::success('Note Successfully Updated');

        return redirect()->back();
    }

    public function deleteNoteContact($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        \Brian2694\Toastr\Facades\Toastr::success('Note Successfully Deleted');

        return redirect()->back();
    }

    public function createEventContact(ContactEventRequest $request, Contact $contact)
    {
        $event = new Location();
        $event->date = $request->date;
        $event->name = $request->event;
        $event->contact_id = $contact->id;

        \Brian2694\Toastr\Facades\Toastr::success('Event Successfully Created');

        $event->save();

        return redirect()->back();
    }

    public function updateShortNoteContact(UpdateNoteContactRequest $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->notes = $request->notes;
        $contact->update();

        \Brian2694\Toastr\Facades\Toastr::success('Short note Successfully Updated');

        return redirect()->back();
    }

    public function updateEventContact(Request $request, $contact)
    {
        $events = $request->events;
        $ex_events = ContactLocation::where('contact_id', $contact)->delete();

        if($events){
            foreach ($events as $event){
                if($event != null){
                    ContactLocation::insert([
                        'contact_id' => $contact,
                        'location_id' => $event,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        \Brian2694\Toastr\Facades\Toastr::success('Event Successfully Updated');

        return redirect()->back();
    }

    public function deleteEventContact($id)
    {
        $event = Location::findOrFail($id);
        $event->delete();

        \Brian2694\Toastr\Facades\Toastr::success('Event Successfully Deleted');

        return redirect()->back();
    }
}
