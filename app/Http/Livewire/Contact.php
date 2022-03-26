<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Contact extends Component
{
    public $datepicker = "";

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
        if($this->datepicker == "")
        {
            $contacts = \App\Models\Contact::where('archived', 0)
                ->latest()
                ->paginate(10);
            return view('livewire.contact', compact('contacts'));
        }
        else
        {
            ['datepicker' => $this->datepicker];

            $date = $this->datepicker;
            $dateSub = Carbon::parse($date);

            $year = $dateSub->year;
            $month = $dateSub->month;
            $day = $dateSub->day;

            $contacts = \App\Models\Contact::where('archived', 0)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->whereDay('created_at', $day)
                ->paginate(10);


            return view('livewire.contact', compact('contacts'));
        }

    }
}
