<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Request;
use Livewire\WithPagination;

class Members extends Component
{

    use WithPagination;
    public $pagination = 25;


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
            ->simplePaginate($this->pagination);

        $active_user = Auth::user()->id;
        $member = Member::where('user_id', $active_user)->first();

        return view('livewire.members', compact('members', 'member'));
    }
}
