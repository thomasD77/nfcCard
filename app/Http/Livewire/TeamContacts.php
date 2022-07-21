<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TeamContacts extends Component
{

    public Team $team;
    use WithPagination;
    public string $datepicker = "";
    public int $pagination = 25;
    public string $datepicker_day = "";
    public $name;
    public $notes;
    public $showNotes = false;

    public function mount(Team $team)
    {
        $this->team = $team;
    }

    public function archiveContact($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->archived = 1;
        $contact->update();
    }

    public function dateALL()
    {
        $this->datepicker = "";
        $this->datepicker_day = "";
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
        $users = User::where('team_id', $this->team->id)->pluck('id');
        $members = Member::whereIn('user_id', $users)->pluck('id');

        if ($this->datepicker == "") {
            $contacts = \App\Models\Contact::with(['member'])
                ->where('name', 'LIKE', '%' . $this->name . '%')
                ->whereIn('member_id', $members)
                ->latest()
                ->simplePaginate($this->pagination);

            return view('livewire.team-contacts', compact('contacts'));

        } else {
            ['datepicker' => $this->datepicker];

            $date = $this->datepicker;
            $dateSub = Carbon::parse($date);

            $year = $dateSub->year;
            $month = $dateSub->month;
            $day = $this->datepicker_day;

            if ($day != "") {
                $contacts = \App\Models\Contact::with(['member'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->whereDay('created_at', $day)
                    ->whereIn('member_id', $members)
                    ->simplePaginate($this->pagination);
            } else {
                $contacts = \App\Models\Contact::with(['member'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->whereIn('member_id', $members)
                    ->simplePaginate($this->pagination);
            }

            return view('livewire.team-contacts', compact('contacts'));

        }
    }
}
