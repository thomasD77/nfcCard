<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Member;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ContactDetailRefferedMembers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public Contact $contact;
    public Member $member;

    public $name;


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

    public function render()
    {
        if(isset($this->member)) {
            $users = User::where('team_id', $this->member->user->team_id)->pluck('id');
            $referred_members = Member::query()
                ->whereIn('user_id', $users)
                ->whereNull('deleted_at')
                ->where('id', '!=', $this->member->id)
                ->where('id', '!=', Auth()->user()->member->id)
                ->simplePaginate(3);
        } else {
            $referred_members = [];
        }

        return view('livewire.contact-detail-reffered-members', compact('referred_members'));
    }
}
