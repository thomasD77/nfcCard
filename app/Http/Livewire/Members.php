<?php

namespace App\Http\Livewire;

use App\Models\Member;
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
        $members = Member::where('archived', 0)
            ->latest()
            ->paginate(25);

        return view('livewire.members', compact('members'));
    }

}
