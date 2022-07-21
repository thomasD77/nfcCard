<?php

namespace App\Http\Livewire;

use App\Models\contact;
use App\Models\Member;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class UnarchiveContact extends Component
{
    use WithPagination;
    public $datepicker = "";
    public $pagination = 25;
    public $scans;

    public function onlyMyScans(){
        if($this->scans){
            $this->scans = false;
        }else {
            $this->scans = true;
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

    public function render()
    {
        if( $this->scans) {
            $members = Member::where('user_id', Auth()->user()->id)->pluck('id');

        } else {
            $team = Auth()->user()->team;
            $users = User::where('team_id', $team->id)->pluck('id');
            $members = Member::whereIn('user_id', $users)->where('archived', 0)->pluck('id');
        }

        if($this->datepicker == "")
        {
            $contacts = \App\Models\Contact::with('member')->where('archived', 1)
                ->whereIn('member_id', $members)
                ->latest()
                ->simplePaginate($this->pagination);
            return view('livewire.unarchive-contact', compact('contacts'));
        }
        else
        {
            ['datepicker' => $this->datepicker];

            $date = $this->datepicker;
            $dateSub = Carbon::parse($date);

            $year = $dateSub->year;
            $month = $dateSub->month;
            $day = $dateSub->day;

            $contacts = \App\Models\Contact::with('member')
                ->where('archived', 1)
                ->whereIn('member_id', $members)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->whereDay('created_at', $day)
                ->simplePaginate($this->pagination);


            return view('livewire.unarchive-contact', compact('contacts'));
        }

    }
}
