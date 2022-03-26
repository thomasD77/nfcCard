<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UnarchiveContactClient extends Component
{
    use WithPagination;
    public $datepicker = "";
    public $pagination = 25;


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
        $user = Auth::user();
        $member = Member::findOrFail($user->member_id);

        if($this->datepicker == "")
        {
            $contacts = \App\Models\Contact::where('archived', 1)
                ->where('member_id', $member->id)
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
            $day = $dateSub->day;

            $contacts = \App\Models\Contact::where('archived', 1)
                ->where('member_id', $member->id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->whereDay('created_at', $day)
                ->simplePaginate($this->pagination);


            return view('livewire.unarchive-contact-client', compact('contacts'));
        }

    }
}
