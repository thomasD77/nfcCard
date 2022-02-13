<?php

namespace App\Http\Controllers;

use App\Models\CompanyCredential;
use App\Models\Cookie;
use App\Models\disclaimer;
use App\Models\Post;
use App\Models\Privacy;
use Illuminate\Http\Request;

class SystemPageController extends Controller
{
    //
    public function index($page)
    {

        if($page == 'disclaimer')
        {
            $data = disclaimer::first();
        }
        elseif ($page == 'privacy')
        {
            $data = Privacy::first();
        }
        elseif ($page == 'cookie')
        {
            $data = Cookie::first();
        }

        $company = CompanyCredential::first();


        return view('front.system', compact('data','company'));
    }
}
