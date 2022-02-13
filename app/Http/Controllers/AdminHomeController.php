<?php

namespace App\Http\Controllers;

use App\Models\CompanyCredential;
use App\Models\Photo;
use App\Models\Role;
use Illuminate\Http\Request;
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
        $user = Auth::user()->id;
        $test = Role::where('id', $user)->first();
        $company = CompanyCredential::latest()->first();
        $photos = Photo::all();
        return view('admin.dashboard', compact('test', 'company', 'photos'));
    }

}
