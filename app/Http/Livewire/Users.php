<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Users extends Component
{
    public function archiveUser($id)
    {
        $user = User::findOrFail($id);
        $user->archived = 1;
        $user->update();
    }

    public function render()
    {
        $roles = ['superAdmin', 'admin', 'employee', 'client'];

        $users = User::with([ 'roles'])
            ->whereHas('roles', function($q) use($roles) {
            $q->whereIn('name', $roles);})
            ->where('archived', 0)
            ->paginate(25);

        return view('livewire.users', compact('users'));
    }
}
