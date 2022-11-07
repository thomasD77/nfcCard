<?php

namespace App\Http\Livewire;

use App\Models\ContactLocation;
use App\Models\JobFunction;
use App\Models\Location;
use App\Models\Member;
use App\Models\Note;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use \App\Models\Contact;
use Livewire\WithPagination;

class ContactDetail extends Component
{
    public Contact $contact;
    public Member $member;
    public $newNotes;

    public $name;
    public $status;
    public $sector;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

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
        Auth()->user()->contacts()->detach($this->contact->id);
        return redirect()->route('contacts.list');
    }

    public function render()
    {
        $notes = Note::where('contact_id', $this->contact->id)->count();
        $events = ContactLocation::where('contact_id', $this->contact->id)->count();

        $statusses = Status::pluck('name', 'id');
        $sectors = JobFunction::pluck('name', 'id');

        return view('livewire.contact-detail', compact(
            'notes',
            'statusses',
            'sectors',
            'events',
        ));
    }
}
