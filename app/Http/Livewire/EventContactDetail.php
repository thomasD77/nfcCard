<?php

namespace App\Http\Livewire;

use App\Models\Location;
use App\Models\ContactLocation;
use Livewire\Component;

class EventContactDetail extends Component
{
    public $location;

    public function mount(Location $location)
    {
        $this->location = $location;
    }
    public function render()
    {
        $location = $this->location;
        $contacts = ContactLocation::where(
            'location_id', $location->id
        )->get();
        return view('livewire.event-contact-detail', compact('location', 'contacts'));
    }

    public function deleteContactFromEvent($locationId, $contactId){
        ContactLocation::where("location_id", $locationId)->where('contact_id', $contactId)->delete();
    }
}
