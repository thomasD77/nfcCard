<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UnarchiveContactClient extends Component
{
    use WithPagination;
    public $datepicker = "";
    public $pagination = 25;
    public $datepicker_day = "";
    public User $user;


    public function unArchiveContact($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->archived = 0;
        $contact->update();
    }

    public function dateALL()
    {
        $this->datepicker = "";
        $this->datepicker_day = "";
    }


    public function render()
    {
        $user = Auth::user();

        if($user->roles->first()->name == 'superAdmin'){
            $members = Member::where('user_id', $this->user->id)
                ->where('archived', '=', 0)
                ->pluck('id');
        }else {
            $members = Member::where('user_id', $user->id)->where('archived', '=', 0)->pluck('id');
        }

        if($this->datepicker == "")
        {
            $contacts = \App\Models\Contact::where('archived', 1)
                ->whereIn('member_id', $members)
                ->latest()
                ->paginate($this->pagination);

            return view('livewire.unarchive-contact-client', compact('contacts'));
        }
        else
        {
            ['datepicker' => $this->datepicker];

            $date = $this->datepicker;
            $dateSub = Carbon::parse($date);

            $year = $dateSub->year;
            $month = $dateSub->month;


            if ($this->datepicker_day != "") {
                $contacts = \App\Models\Contact::with(['member'])
                    ->where('archived', 1)
                    ->where('member_id', Auth()->user()->member_id)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->whereDay('created_at', $this->datepicker_day)
                    ->simplePaginate($this->pagination);

            } else {

                $contacts = \App\Models\Contact::with(['member'])
                    ->where('archived', 1)
                    ->where('member_id', Auth()->user()->member_id)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->simplePaginate($this->pagination);
            }

            return view('livewire.unarchive-contact-client', compact('contacts'));
        }

    }
}
