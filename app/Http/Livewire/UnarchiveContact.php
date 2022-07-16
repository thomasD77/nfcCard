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
    public Team $team;


    public function mount(Request $request){
        if($request->team){
            $this->team = Team::where('id', $request->team)->first();
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
        if(isset($this->team)){
            $users = User::where('team_id', $this->team->id )->pluck('id');
            $members = Member::query()
                ->where('archived', '=', 0)
                ->whereIn('user_id', $users)
                ->pluck('id');
        }else {
            $members = Member::query()
                ->where('archived', '=', 0)
                ->pluck('id');
        }

        if($this->datepicker == "")
        {
            $contacts = \App\Models\Contact::where('archived', 1)
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

            $contacts = \App\Models\Contact::where('archived', 1)
                ->whereIn('member_id', $members)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->whereDay('created_at', $day)
                ->simplePaginate($this->pagination);


            return view('livewire.unarchive-contact', compact('contacts'));
        }

    }
}
