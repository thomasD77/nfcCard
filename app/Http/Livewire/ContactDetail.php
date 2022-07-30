<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\Note;
use App\Models\User;
use Livewire\Component;
use \App\Models\Contact;

class ContactDetail extends Component
{
    public Contact $contact;
    public Member $member;


    public function mount(Contact $contact)
    {
        $this->contact = $contact;

        $member = Member::query()
            ->where('email', $this->contact->email)
            ->whereNull('deleted_at')
            ->first();

        if($member) {
            $this->member = $member;
        }

    }



    public function render()
    {
        $users = User::where('team_id', $this->member->user->team_id)->pluck('id');
        $referred_members = Member::query()
            ->whereIn('user_id', $users)
            ->whereNull('deleted_at')
            ->where('id', '!=', $this->member->id)
            ->get();


        $notes = Note::where('contact_id', $this->contact->id)->get();


        return view('livewire.contact-detail', compact('referred_members', 'notes'));
    }
}
