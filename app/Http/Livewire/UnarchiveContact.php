<?php

namespace App\Http\Livewire;

use App\Models\contact;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class UnarchiveContact extends Component
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
        if($this->datepicker == "")
        {
            $contacts = \App\Models\Contact::where('archived', 1)
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
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->whereDay('created_at', $day)
                ->simplePaginate($this->pagination);


            return view('livewire.unarchive-contact', compact('contacts'));
        }

    }
}
