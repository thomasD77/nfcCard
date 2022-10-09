<?php

namespace App\Http\Controllers;

use App\Models\CompanyCredential;
use App\Models\Contact;
use App\Models\listUrl;
use App\Models\Lock;
use App\Models\Member;
use App\Models\Order;
use App\Models\Package;
use App\Models\Photo;
use App\Models\QRCODE;
use App\Models\Role;
use App\Models\Team;
use App\Models\URL;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $is_business = $user->business;

        $member = Member::where('user_id',$user->id)->first();

        $scans = Contact::count();

        $users = User::count() - 2;

        $teams = Team::count();

        return view('admin.dashboard', compact('member', 'scans',
            'users',
            'teams',
            'is_business'
        ));
    }

}
