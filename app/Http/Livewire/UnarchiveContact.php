<?php

namespace App\Http\Livewire;

use App\Models\contact;
use Livewire\Component;

class UnarchiveContact extends Component
{
    public function unArchiveContact($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->archived = 0;
        $contact->update();
    }

    public function render()
    {
        $contacts = Contact::where('archived', 1)
            ->latest()
            ->paginate(25);

        return view('livewire.unarchive-contact', compact('contacts'));
    }
}
