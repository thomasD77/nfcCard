<?php

namespace App\Http\Livewire;

use App\Models\ContactLocation;
use App\Models\Location;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EventsContact extends Component
{
    public $name;
    public int $pagination = 25;
    public $members;
    public $showNotes = false;
    public $selectMember;

    public function mount()
    {
        $this->members = Member::where('archived', 0)->get();
    }
    public function render()
    {
        $locations = \App\Models\Location::
            latest();
        $date = time();
        $userId = Auth::id();
        $locations = Location::latest()
            ->where('user_id', $userId)
            ->simplePaginate($this->pagination);
        return view('livewire.events-contact', compact('locations', 'date'));
    }

    public function addEvent($formData)
    {
        $userId = Auth::id();
        Location::insert([
            'name' => $formData['name'],
            'date' => $formData['date'],
            'remark' => $formData['remark'],
            'user_id' => $userId
        ]);
        // $this->reset();
        //$this->render();
    }
    public function deleteEvent($locationId)
    {
        Location::where('id', $locationId)->delete();
        ContactLocation::where('location_id', $locationId)->delete();
    }

    public function updateEvent($locationId, $formData)
    {
        $location = Location::where('id', $locationId);
        $location->update(['name'=> $formData['name'], 'date' => $formData['date'], 'remark' => $formData['remark']]);
    }

    public function detail($locationId)
    {
        $location = Location::find($locationId);
        return view('livewire.event-contact-detail', compact('location'));
    }
}
