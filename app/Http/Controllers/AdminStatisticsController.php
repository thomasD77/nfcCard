<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminStatisticsController extends Controller
{
    //
    public function index()
    {
        $member = Auth::user()->member;

        if($member){
            $swaps = Contact::where('member_id', $member->id)->count();
            $contacts = Auth::user()->contacts->count();
            $views = $member->profile_views;
        }

        return view('admin.statistics.index', compact('swaps', 'contacts', 'views'));
    }
}
