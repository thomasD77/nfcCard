<?php

namespace App\Http\Controllers;

use App\Models\CompanyCredential;
use App\Models\listUrl;
use App\Models\Lock;
use App\Models\Member;
use App\Models\Package;
use App\Models\Photo;
use App\Models\QRCODE;
use App\Models\Role;
use App\Models\URL;
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
        $currentURL = URL::first();

        $package = Package::where('value', 1)->first();

        if(! isset($package)){
            $package = 'No package selected';
        }else{
            $package = $package->package;
        }

        $QRcode = QRCODE::first();

        $member = Member::where('user_id',$user)->first();

        $total_cards = listUrl::all()->count();
        $total_custom = listUrl::where('package_id', 3)->get()->count();
        $total_default = listUrl::where('package_id', 2)->get()->count();
        $total_vCard = listUrl::where('package_id', 1)->get()->count();

        $total_pvc = listUrl::where('material_id', 1)->get()->count();
        $total_metal = listUrl::where('material_id', 2)->get()->count();
        $total_wood = listUrl::where('material_id', 3)->get()->count();

        $lock = Lock::first();

        return view('admin.dashboard', compact('company',
            'photos',
            'package',
            'currentURL',
            'QRcode',
            'member',
            'total_cards',
            'total_custom',
            'total_default',
            'total_vCard',
            'total_pvc',
            'total_metal',
            'total_wood',
            'lock'
        ));
    }

}
