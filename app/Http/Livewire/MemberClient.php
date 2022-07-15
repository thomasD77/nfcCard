<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MemberClient extends Component
{
    public function render()
    {
        $active_user = Auth::user()->id;
        $member = Member::where('user_id', $active_user)->first();

        return view('livewire.member-client', compact('member'));
    }
}
