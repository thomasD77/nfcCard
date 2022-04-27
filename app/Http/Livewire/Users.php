<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

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

        $current_user = Auth::user()->id;

        $users = User::with([ 'roles', 'member'])
            ->where('archived', 0)
            ->where('id', '!=' ,1)
            ->where('id', '!=' ,2)
            ->where('id', '!=' ,$current_user)
            ->paginate(25);

        return view('livewire.users', compact('users'));
    }
}
