<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\Contact;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\Boolean;

class ContactClient extends Component
{
    use WithPagination;

    public $datepicker = "";
    public $pagination = 25;
    public $datepicker_day = "";
    public $name;
    public $notes;
    public $showNotes = false;
    public User $user;
    public $status;
    public $contact;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function toggleToContact(Contact $contact)
    {
        $user = Auth()->user();
        $user->contacts()->sync($contact->id, false);
    }

    public function contact(Contact $contact)
    {
        $this->contact = $contact;
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

    public function saveNote(Contact $contact)
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
        if($this->contact && $this->status){
            $this->contact->status_id = $this->status;
            $this->contact->update();
        }

        $statusses = Status::pluck('name', 'id');

        $ids = [];
        $contacts = Auth()->user()->contacts;

        if($contacts) {
            foreach ($contacts as $contact) {
                $ids [] = $contact->id;
            }
        }



        //Check if USER is given in URL request
        if($this->user->member){
            $member_id = $this->user->member->id;
        } else {
            $member_id = Auth()->user()->member->id;
        }

        if ($this->datepicker == "") {
            $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                ->where('archived', 0)
                ->where('member_id', $member_id)
                ->where('name', 'LIKE', '%' . $this->name . '%')
                ->latest()
                ->simplePaginate($this->pagination);

            $statusses = Status::all();

            return view('livewire.contact-client', compact('contacts', 'statusses', 'ids'));
        } else {
            ['datepicker' => $this->datepicker];

            $date = $this->datepicker;
            $dateSub = Carbon::parse($date);

            $year = $dateSub->year;
            $month = $dateSub->month;
            $day = $this->datepicker_day;

            if ($day != "") {
                $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                    ->where('archived', 0)
                    ->where('member_id', $member_id)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->whereDay('created_at', $day)
                    ->simplePaginate($this->pagination);
            } else {
                $contacts = \App\Models\Contact::with(['member'])
                    ->where('archived', 0)
                    ->where('member_id', $member_id)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->simplePaginate($this->pagination);
            }


            return view('livewire.contact-client', compact('contacts', 'statusses', 'ids'));
        }
    }
}
