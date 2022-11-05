<?php

namespace App\Http\Livewire;

use App\Models\ContactLocation;
use App\Models\Location;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class EventsContact extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name;
    public int $pagination = 25;
    public $members;
    public $showNotes = false;
    public $selectMember;

    public $ev_name;
    public $date;
    public $remark;


    public function mount()
    {
        $this->members = Member::where('archived', 0)->get();
    }

    public function mountEvent(Location $location){
        $this->ev_name = $location->name;
    }

    protected $rules = [
        'name' => 'required',
    ];

    public function detail($locationId)
    {
        $location = Location::find($locationId);
        return view('livewire.event-contact-detail', compact('location'));
    }

    public function addEvent()
    {
        Location::create([
            'name' => $this->ev_name,
            'date' => $this->date,
            'remark' => $this->remark,
            'user_id' => Auth::user()->id
        ]);

        $this->reset();
        $this->render();
    }

    public function render()
    {
        $date = time();
        $userId = Auth::id();
        if($this->name){
            $locations = Location::latest()
                ->where('user_id', $userId)
                ->where('name', 'LIKE', '%' . $this->name . '%')
                ->latest()
                ->simplePaginate($this->pagination);
        }else {
            $locations = Location::latest()
                ->where('user_id', $userId)
                ->latest()
                ->simplePaginate($this->pagination);
        }

        return view('livewire.events-contact', compact('locations', 'date'));
    }
}
