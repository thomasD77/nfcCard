<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ContactAdmin extends Component
{
    use WithPagination;
    public string $datepicker = "";
    public int $pagination = 25;
    public string $datepicker_day = "";
    public $name;
    public $notes;
    public $showNotes = false;
    public $scans;

    public function onlyMyScans(){
        if($this->scans){
            $this->scans = false;
        }else {
            $this->scans = true;
        }
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
        $member = "";

        if($this->scans) {
            $member = Auth()->user()->member;
        } else {
            $team = Auth()->user()->team;
            $users = User::where('team_id', $team->id)->pluck('id');
            $members = Member::whereIn('user_id', $users)->where('archived', 0)->pluck('id');
        }

        //All the swap connections from the admin
        if($member != ""){
            //When there is no filter
            if($this->datepicker == "")
            {
                $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                    ->where('archived', 0)
                    ->where('member_id', $member->id)
                    ->latest()
                    ->where('name', 'LIKE', '%' . $this->name . '%')
                    ->simplePaginate($this->pagination);
                return view('livewire.contact-admin', compact('contacts'));
            }
            //When there is a filter
            else {
                ['datepicker' => $this->datepicker];

                $date = $this->datepicker;
                $dateSub = Carbon::parse($date);

                $year = $dateSub->year;
                $month = $dateSub->month;
                $day = $this->datepicker_day;
                //When we select a day
                if ($day != "") {
                    $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                        ->where('archived', 0)
                        ->where('member_id', $member->id)
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->whereDay('created_at', $day)
                        ->where('name', 'LIKE', '%' . $this->name . '%')
                        ->simplePaginate($this->pagination);
                    return view('livewire.contact-admin', compact('contacts'));
                } else {
                    $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                        ->where('archived', 0)
                        ->where('member_id', $member->id)
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->where('name', 'LIKE', '%' . $this->name . '%')
                        ->simplePaginate($this->pagination);
                    return view('livewire.contact-admin', compact('contacts'));
                }
            }
        }
        //All the swap connections from the team
        else {
            //When there is no filter
            if($this->datepicker == "")
            {
                $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                    ->where('archived', 0)
                    ->whereIn('member_id', $members)
                    ->latest()
                    ->where('name', 'LIKE', '%' . $this->name . '%')
                    ->simplePaginate($this->pagination);
                return view('livewire.contact-admin', compact('contacts'));
            //When there is a filter
            } else {
                ['datepicker' => $this->datepicker];

                $date = $this->datepicker;
                $dateSub = Carbon::parse($date);

                $year = $dateSub->year;
                $month = $dateSub->month;
                $day = $this->datepicker_day;
                //When we select a day
                if ($day != "") {
                    $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                        ->where('archived', 0)
                        ->whereIn('member_id', $members)
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->whereDay('created_at', $day)
                        ->where('name', 'LIKE', '%' . $this->name . '%')
                        ->simplePaginate($this->pagination);
                    return view('livewire.contact-admin', compact('contacts'));
                } else {
                    $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                        ->where('archived', 0)
                        ->whereIn('member_id', $members)
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->where('name', 'LIKE', '%' . $this->name . '%')
                        ->simplePaginate($this->pagination);
                    return view('livewire.contact-admin', compact('contacts'));
                }
            }
        }
    }
}
