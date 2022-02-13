<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Bookings extends Component
{
    public function archiveBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->archived = 1;
        $booking->update();

    }

    public function render()
    {
        if(Auth::user()->roles->first()->name == 'client')
        {
            $bookings = Booking::with([ 'user', 'services', 'location', 'status'])
                ->where('archived', 0)
                ->where('client_id', Auth::user()->id)
                ->latest()
                ->paginate(20);
        }
        else
        {
            $bookings = Booking::with([ 'user', 'services', 'location', 'status'])
                ->where('archived', 0)
                ->latest()
                ->paginate(20);
        }

        return view('livewire.bookings', compact('bookings'));
    }
}
