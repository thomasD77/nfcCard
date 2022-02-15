<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Members extends Component
{
    public function archiveMember($id)
    {
        $member = Member::findOrFail($id);
        $member->archived = 1;
        $member->update();
    }

    public function render()
    {
        $active_user_role = Auth::user()->roles->first()->name;
        $active_user = Auth::user()->id;

        $members = Member::query()
            ->with(['user'])
            ->where('archived', 0)
            ->paginate(25);

        return view('livewire.members', compact('members', 'active_user_role', 'active_user'));
    }

}
