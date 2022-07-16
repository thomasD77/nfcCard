<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class UnarchiveUsers extends Component
{
    public Team $team;

    public function mount(Request $request)
    {
        if($request->team){
            $this->team = Team::where('id', $request->team)->first();
        }
    }

    public function unArchiveUser($id)
    {
        $user = User::findOrFail($id);
        $user->archived = 0;
        $user->update();
    }

    public function render()
    {
        if(isset($this->team)){
            $users = User::with([ 'roles'])
                ->where('archived', 1)
                ->where('team_id', $this->team->id)
                ->latest()
                ->paginate(10);
        }else {
            $users = User::with([ 'roles'])
                ->where('archived', 1)
                ->latest()
                ->paginate(10);
        }

        return view('livewire.unarchive-users', compact('users'));
    }
}
