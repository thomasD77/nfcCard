<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Contact extends Component
{
    use WithPagination;
    public string $datepicker = "";
    public int $pagination = 25;
    public string $datepicker_day = "";
    public $name;
    public $notes;
    public $showNotes = false;
    public $members;
    public $selectMember;

    public function mount()
    {
        $this->members = Member::where('archived', 0)->get();
    }


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

    public function saveNote(\App\Models\Contact $contact)
    {
        $contact->notes = $this->notes;
        $contact->update();
        $this->showNotes = false;
    }

    public function showNotes()
    {
        if($this->showNotes){
            $this->showNotes = false;
        }else {
            $this->showNotes = true;
        }
    }

    public function render()
    {
        $member = Member::where('id', $this->selectMember)->where('archived', 0)->first();
        //Extra team check
        if($member != null){
            if($this->datepicker == "")
            {
                $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                    ->latest()
                    ->where('name', 'LIKE', '%' . $this->name . '%')
                    ->where('member_id', $member->id)
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
                $day = $this->datepicker_day;

                if($day != "") {
                    $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->whereDay('created_at', $day)
                        ->where('member_id', $member->id)
                        ->simplePaginate($this->pagination);
                } else {
                    $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->where('member_id', $member->id)
                        ->simplePaginate($this->pagination);
                }
                return view('livewire.contact', compact('contacts'));
            }
        }
        else {
            if($this->datepicker == "")
            {
                $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                    ->latest()
                    ->where('name', 'LIKE', '%' . $this->name . '%')
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
                $day = $this->datepicker_day;

                if($day != "") {
                    $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->whereDay('created_at', $day)
                        ->simplePaginate($this->pagination);
                } else {
                    $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->simplePaginate($this->pagination);
                }

                return view('livewire.contact', compact('contacts'));
            }
        }
    }
}
