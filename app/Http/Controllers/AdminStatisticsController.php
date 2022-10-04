<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminStatisticsController extends Controller
{
    //
    public function index()
    {
        $member = Auth::user()->member;
        $role = Auth::user()->roles()->first()->name;

        if($member){
            $swaps = Contact::where('member_id', $member->id)->where('archived', 0)->count();
            $views = $member->profile_views;

            if($role == 'admin'){
                $team = Auth()->user()->team;
                $users = User::where('team_id', $team->id)->pluck('id');
                $members = Member::whereIn('user_id', $users)->where('archived', 0)->pluck('id');
                $team_scans = \App\Models\Contact::with(['member', 'contactStatus'])
                    ->where('archived', 0)
                    ->whereIn('member_id', $members)
                    ->count();
            }else {
                $team_scans = 0;
            }
        }

        return view('admin.statistics.index', compact('swaps', 'views', 'team_scans'));
    }
}
