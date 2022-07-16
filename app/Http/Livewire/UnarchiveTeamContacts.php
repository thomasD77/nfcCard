<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class UnarchiveTeamContacts extends Component
{
    public Team $team;
    use WithPagination;
    public string $datepicker = "";
    public int $pagination = 25;
    public string $datepicker_day = "";
    public $name;
    public $notes;
    public $showNotes = false;

    public function mount(Request $request)
    {
        if($request->team){
            $team = Team::findOrfail($request->team);
            $this->team = $team;
        }
    }


    public function unArchiveContact($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->archived = 0;
        $contact->update();
    }

    public function dateALL()
    {
        $this->datepicker = "";
    }


    public function saveNote(\App\Models\Contact $contact)
    {
        $contact->notes = $this->notes;
        $contact->update();
        $this->showNotes = false;
    }

    public function showNotes()
    {
        if($this->showNotes){
            $this->showNotes = false;
        }else {
            $this->showNotes = true;
        }
    }

    public function render()
    {

        if(Auth()->user()->roles->first()->name == 'superAdmin'){
            $members = Member::pluck('id');
        }else {
            $users = User::where('team_id', Auth()->user()->team->id)->pluck('id');
            $members = Member::whereIn('user_id', $users)->pluck('id');
        }


        if($this->datepicker == "")
        {
            $contacts = \App\Models\Contact::where('archived', 1)
                ->whereIn('member_id', $members)
                ->latest()
                ->simplePaginate($this->pagination);
            return view('livewire.unarchive-team-contacts', compact('contacts'));
        }
        else
        {
            ['datepicker' => $this->datepicker];

            $date = $this->datepicker;
            $dateSub = Carbon::parse($date);

            $year = $dateSub->year;
            $month = $dateSub->month;
            $day = $dateSub->day;

            $contacts = \App\Models\Contact::where('archived', 1)
                ->whereIn('member_id', $members)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->whereDay('created_at', $day)
                ->simplePaginate($this->pagination);


            return view('livewire.unarchive-team-contacts', compact('contacts'));
        }

    }
}
