<?php

namespace App\Swap\Members;

use App\Models\Member;
use App\Models\User;

class TeamMembers
{
    public function getTeamMembers(User $user)
    {
        $team = $user->team;
        $users = User::where('team_id', $team->id)->pluck('id');
        $members = Member::whereIn('user_id', $users)->where('archived', 0)->get();

        return $members;
    }


    public function getTeamMembersInArrayPluckId(User $user)
    {
        $team = $user->team;
        $users = User::where('team_id', $team->id)->pluck('id');
        $members = Member::whereIn('user_id', $users)->where('archived', 0)->pluck('id');

        return $members;
    }
}
