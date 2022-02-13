<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Source extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required',
    ];


    public function submit()
    {
        $this->validate();
        $data = [ 'name' => $this->name ];

        \App\Models\Source::create([
            'name' => $this->name,
        ]);

        $this->emit('updateSourcesTable', $this->name);


        $this->reset([
            'name',
        ]);

    }
    public function render()
    {
        return view('livewire.source');
    }
}
