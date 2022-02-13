<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;

class RoleTable extends Component
{

    public $role_name;
    public $newRole;


    protected $listeners = [
        'updateRolesTable',
    ];

    public function updateRolesTable($name)
    {
      //
        $this->newRole = $name;
    }

    protected $rules = [
        'role_name' => 'required',
    ];

    public function submitFormRole($id)
    {
        $this->validate();

        $data = [
            'role_name' => $this->role_name,
        ];


        $role = Role::findOrFail($id);

        $role->name = $this->role_name;

        $role->update();

        $this->reset([
            'role_name',
        ]);

        $this->dispatchBrowserEvent('closeModal');
    }

    public function removeRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }


    public function render()
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('livewire.role-table', compact( 'roles'));
    }
}
