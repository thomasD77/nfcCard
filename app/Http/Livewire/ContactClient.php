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
    public $datepicker_day = "";


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


    public function render()
    {
        if ($this->datepicker == "") {
            $contacts = \App\Models\Contact::with(['member'])
                ->where('archived', 0)
                ->latest()
                ->simplePaginate($this->pagination);
            return view('livewire.contact-client', compact('contacts'));
        } else {
            ['datepicker' => $this->datepicker];

            $date = $this->datepicker;
            $dateSub = Carbon::parse($date);

            $year = $dateSub->year;
            $month = $dateSub->month;
            $day = $this->datepicker_day;

            if ($day != "") {
                $contacts = \App\Models\Contact::with(['member'])
                    ->where('archived', 0)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->whereDay('created_at', $day)
                    ->simplePaginate($this->pagination);
            } else {
                $contacts = \App\Models\Contact::with(['member'])
                    ->where('archived', 0)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->simplePaginate($this->pagination);
            }

            return view('livewire.contact-client', compact('contacts'));
        }
    }
}
