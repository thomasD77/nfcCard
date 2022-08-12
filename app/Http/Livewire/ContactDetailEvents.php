<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Location;
use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class ContactDetailEvents extends Component
{
    use WithPagination;

    public Contact $contact;

    protected $paginationTheme = 'bootstrap';

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function render()
    {
        $events = Location::where('contact_id', $this->contact->id)->latest()->simplePaginate(5);
        return view('livewire.contact-detail-events', compact('events'));
    }
}
