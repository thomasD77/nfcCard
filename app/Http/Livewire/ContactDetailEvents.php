<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\ContactLocation;
use App\Models\Location;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ContactDetailEvents extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public Contact $contact;

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function render()
    {
        $events = Location::where('user_id', Auth::user()->id)->pluck('name', 'id');
        $ex_events = ContactLocation::where('contact_id', $this->contact->id)->pluck('location_id');

        return view('livewire.contact-detail-events', compact('events', 'ex_events'));
    }
}
