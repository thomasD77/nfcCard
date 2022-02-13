<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Spatie\GoogleCalendar\Event;

class UnarchiveBookings extends Component
{
    public function unArchiveBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->archived = 0;
        $booking->update();

    }

    public function render()
    {
        $bookings = Booking::with([ 'user', 'services', 'location', 'status'])
            ->where('archived', 1)
            ->latest()
            ->paginate(20);

        return view('livewire.unarchive-bookings', compact('bookings'));
    }

}
