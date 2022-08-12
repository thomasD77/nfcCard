<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Member;
use App\Models\Note;
use Livewire\Component;
use Livewire\WithPagination;

class ContactDetailNotes extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public Contact $contact;

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function render()
    {
        $notes = Note::where('contact_id', $this->contact->id)->latest()->simplePaginate(5);
        return view('livewire.contact-detail-notes', compact('notes'));
    }
}
