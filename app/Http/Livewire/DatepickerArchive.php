<?php

namespace App\Http\Livewire;

use App\Models\Submission;
use Illuminate\Support\Carbon;
use Livewire\Component;

class DatepickerArchive extends Component
{
    public $datepicker = "";

    public function dateALL()
    {
        $this->datepicker = "";
    }

    public function unArchiveSub($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->archived = 0;
        $submission->update();
    }


    public function render()
    {
        if($this->datepicker == "")
        {
            $submissions = Submission::where('archived', 1)
                ->latest()
                ->paginate(10);
            return view('livewire.datepicker-archive', compact('submissions'));
        }
        else
        {
            ['datepicker' => $this->datepicker];

            $date = $this->datepicker;
            $dateSub = Carbon::parse($date);

            $year = $dateSub->year;
            $month = $dateSub->month;

            $submissions = Submission::where('archived', 1)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->paginate(10);


            return view('livewire.datepicker-archive', compact('submissions'));
        }
    }
}
