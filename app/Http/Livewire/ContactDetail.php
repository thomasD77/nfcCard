<?php

namespace App\Http\Livewire;

use App\Models\JobFunction;
use App\Models\Location;
use App\Models\Member;
use App\Models\Note;
use App\Models\Status;
use App\Models\User;
use Livewire\Component;
use \App\Models\Contact;

class ContactDetail extends Component
{
    public Contact $contact;
    public Member $member;
    public $newNotes;

    public $name;
    public $status;
    public $sector;


    public function mount(Contact $contact)
    {
        $this->contact = $contact;
        $this->name = $contact->name;

        $member = Member::query()
            ->where('email', $this->contact->email)
            ->whereNull('deleted_at')
            ->first();

        if($member) {
            $this->member = $member;
        }
    }

    public function deleteContact()
    {
        $this->contact->delete();

        return redirect()->route('contacts.list');
    }



    public function render()
    {
        if(isset($this->member)) {
            $users = User::where('team_id', $this->member->user->team_id)->pluck('id');
            $referred_members = Member::query()
                ->whereIn('user_id', $users)
                ->whereNull('deleted_at')
                ->where('id', '!=', $this->member->id)
                ->get();
        } else {
            $referred_members = [];
        }

        $notes = Note::where('contact_id', $this->contact->id)->get();
        $events = Location::where('contact_id', $this->contact->id)->get();
        $statusses = Status::pluck('name', 'id');
        $sectors = JobFunction::pluck('name', 'id');

        return view('livewire.contact-detail', compact(
            'referred_members',
            'notes',
            'statusses',
            'sectors',
            'events'
        ));
    }
}
