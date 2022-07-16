<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UsersMembers extends Component
{
    public Team $team;

    public function archiveUser($id)
    {
        $user = User::findOrFail($id);
        $user->archived = 1;
        $user->update();
    }

    public function mount(Team $team)
    {
        $this->team = $team;
    }

    public function render()
    {
        $current_user = Auth::user()->id;

        $users = User::with([
            'roles',
            'member',
            'team'
        ])
            ->where('archived', 0)
            ->where('id', '!=' ,1)
            ->where('id', '!=' ,2)
            ->where('id', '!=' ,$current_user)
            ->where('team_id', $this->team->id)
            ->paginate(25);

        return view('livewire.users-members', compact('users'));
    }
}
