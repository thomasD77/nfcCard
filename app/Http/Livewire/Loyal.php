<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Loyal extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required',
    ];



    public function submit()
    {
        $this->validate();
        $data = [ 'name' => $this->name ];

        \App\Models\Loyal::create([
            'name' => $this->name,
        ]);

        $this->emit('updateLoyalsTable', $this->name);


        $this->reset([
            'name',
        ]);

    }
    public function render()
    {
        return view('livewire.loyal');
    }
}
