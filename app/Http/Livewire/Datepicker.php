<?php

namespace App\Http\Livewire;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Datepicker extends Component
{

    public $datepicker = "";

    public function dateALL()
    {
        $this->datepicker = "";
    }

    public function archiveSub($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->archived = 1;
        $submission->update();
    }


    public function render()
    {
        if($this->datepicker == "")
        {
            $submissions = Submission::where('archived', 0)
                ->latest()
                ->paginate(10);
            return view('livewire.datepicker', compact('submissions'));
        }
        else
        {
            ['datepicker' => $this->datepicker];

            $date = $this->datepicker;
            $dateSub = Carbon::parse($date);

            $year = $dateSub->year;
            $month = $dateSub->month;

            $submissions = Submission::where('archived', 0)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->paginate(10);


            return view('livewire.datepicker', compact('submissions'));
        }
    }
}
