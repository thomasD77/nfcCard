<?php

namespace App\Http\Livewire;

use App\Models\Location;
use App\Models\ContactLocation;
use Livewire\Component;
use Livewire\WithPagination;

class EventContactDetail extends Component
{
    use WithPagination;
    public int $pagination = 25;
    protected $paginationTheme = 'bootstrap';

    public Location $location;

    public $ev_name;
    public $date;
    public $remark;

    public function mount(Location $location)
    {
        $this->location = $location;
        $this->ev_name = $location->name;
        $this->date = $location->date;
        $this->remark = $location->remark;
    }

    public function updateEvent()
    {
        $this->location->name = $this->ev_name;
        $this->location->date = $this->date;
        $this->location->remark = $this->remark;
        $this->location->update();
    }

    public function deleteEvent()
    {
        $this->location->delete();
        return redirect()->route('filters.events');
    }

    public function render()
    {
        $location = $this->location;
        $contacts = ContactLocation::with('location', 'contact')
            ->where('location_id', $location->id)
            ->simplePaginate($this->pagination);

        return view('livewire.event-contact-detail', compact('location', 'contacts'));
    }

    public function deleteContactFromEvent($locationId, $contactId){
        ContactLocation::where("location_id", $locationId)->where('contact_id', $contactId)->delete();
    }
}
