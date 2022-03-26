<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Contact extends Component
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
        if($this->datepicker == "")
        {
            $contacts = \App\Models\Contact::with(['member'])
                ->where('archived', 0)
                ->latest()
                ->simplePaginate($this->pagination);
            return view('livewire.contact', compact('contacts'));
        }
        else
        {
            ['datepicker' => $this->datepicker];

            $date = $this->datepicker;
            $dateSub = Carbon::parse($date);

            $year = $dateSub->year;
            $month = $dateSub->month;

                $contacts = \App\Models\Contact::with(['member'])
                    ->where('archived', 0)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->simplePaginate($this->pagination);

            return view('livewire.contact', compact('contacts'));
        }

    }
}
