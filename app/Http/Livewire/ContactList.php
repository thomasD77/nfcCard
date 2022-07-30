<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Contact;

class ContactList extends Component
{
    public $pagination = 25;
    public $name;



    public function render()
    {
        $contacts =  Auth()->user()->contacts;
        $ids = [];

        foreach ($contacts as $contact) {
            $ids [] = $contact->id;
        }

        if($this->name) {
            $contacts = Contact::query()
                ->where('name', 'LIKE', '%' . $this->name . '%')
                ->whereIn('id', $ids)
                ->orderby('name')
                ->simplePaginate($this->pagination);
        }else {
            $contacts = Contact::query()
                ->whereIn('id', $ids)
                ->orderby('name')
                ->simplePaginate($this->pagination);
        }

        return view('livewire.contact-list', compact('contacts'));
    }
}
