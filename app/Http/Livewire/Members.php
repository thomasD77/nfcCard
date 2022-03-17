<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;
use Livewire\Request;
use Livewire\WithPagination;

class Members extends Component
{

    use WithPagination;

    public function select($id)
    {
        $member = Member::findOrFail($id);

        if($member->print == 1)
        {
            $member->print = 0;
            $member->update();
        }
        else
        {
            $member->print = 1;
            $member->update();
        }

    }


    public function archiveMember($id)
    {
        $member = Member::findOrFail($id);
        $member->archived = 1;
        $member->update();
    }

    public function render()
    {
        $members = Member::with(['user', 'package', 'material'])
            ->where('archived', 0)
            ->simplePaginate(2);

        return view('livewire.members', compact('members'));
    }
}
