<?php

namespace App\Http\Livewire;

use App\Models\Member;
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
            latest()
            ->simplePaginate($this->pagination);
        return view('livewire.events-contact', compact('locations'));
    }
}
