<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ContactClient extends Component
{
    use WithPagination;
    public $datepicker = "";
    public $pagination = 25;


    public function archiveContact($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->archived = 1;
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
            $contacts = \App\Models\Contact::with(['member'])
                ->where('member_id', $member->id)
                ->where('archived', 0)
                ->latest()
                ->simplePaginate($this->pagination);

            return view('livewire.contact-client', compact('contacts'));
        }
        else
        {
            ['datepicker' => $this->datepicker];

            $date = $this->datepicker;
            $dateSub = Carbon::parse($date);

            $year = $dateSub->year;
            $month = $dateSub->month;

            $contacts = \App\Models\Contact::with(['member'])
                ->where('member_id', $member->id)
                ->where('archived', 0)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->simplePaginate($this->pagination);


            return view('livewire.contact-client', compact('contacts'));
        }

    }
}
