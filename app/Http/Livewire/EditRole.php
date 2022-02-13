<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;

class EditRole extends Component
{

    public $role;

    public function mount($role)
    {
       $this->role = $role;
    }



    public function render()
    {
        $roles = Role::all();
        return view('livewire.edit-role', compact('roles'));
    }
}
