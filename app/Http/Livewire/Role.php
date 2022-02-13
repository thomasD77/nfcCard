<?php

namespace App\Http\Livewire;

use http\Env\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Livewire\Component;

class Role extends Component
{

    public $name;

    protected $rules = [
        'name' => 'required',
    ];


    public function submit()
    {
        $this->validate();
        $data = [ 'name' => $this->name ];

        \App\Models\Role::create([
            'name' => $this->name,
        ]);

        $this->emit('updateRolesTable', $this->name);


        $this->reset([
            'name',
        ]);

    }
    public function render()
    {
        return view('livewire.role');
    }
}
