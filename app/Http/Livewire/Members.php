<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Request;
use Livewire\WithPagination;

class Members extends Component
{

    use WithPagination;
    public int $pagination = 25;
    public $member_value;


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
        if($this->member_value){

            $value = $this->member_value;

            //If superAdmin
            if(Auth()->user()->roles->first()->name == 'superAdmin'){
                $members = Member::where(function($q) use($value) {
                    $q->where('firstname', 'LIKE', '%' . $value . '%')
                        ->Orwhere('lastname', 'LIKE', '%' . $value . '%')
                        ->Orwhere('referral', 'LIKE', '%' . $value . '%')
                        ->where('archived', 0);

                })->simplePaginate($this->pagination);
            }else {
                $members = Member::where(function($q) use($value) {

                    $team_id = Auth::user()->team->id;
                    $teamUsers = User::where('team_id', $team_id)->pluck('id');

                    $q->where('firstname', 'LIKE', '%' . $value . '%')
                        ->Orwhere('lastname', 'LIKE', '%' . $value . '%')
                        ->Orwhere('referral', 'LIKE', '%' . $value . '%')
                        ->whereIn('user_id', $teamUsers)
                        ->where('archived', 0);

                })->simplePaginate($this->pagination);
            }

        }elseif(Auth()->user()->roles->first()->name == 'superAdmin'){
            $members = Member::with(['user', 'package', 'material'])
                ->where('archived', 0)
                ->simplePaginate($this->pagination);
        }else {
            $team_id = Auth::user()->team->id;
            $teamUsers = User::where('team_id', $team_id)->pluck('id');
            $members = Member::with(['user', 'package', 'material'])
                ->whereIn('user_id', $teamUsers)
                ->where('archived', 0)
                ->simplePaginate($this->pagination);
        }

        return view('livewire.members', compact('members'));
    }
}
