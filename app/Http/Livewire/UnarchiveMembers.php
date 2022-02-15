<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;

class UnarchiveMembers extends Component
{
    public function unArchiveMember($id)
    {
        $member = Member::findOrFail($id);
        $member->archived = 0;
        $member->update();
    }

    public function render()
    {
        $members = Member::where('archived', 1)
            ->latest()
            ->paginate(25);

        return view('livewire.unarchive-members', compact('members'));
    }
}
