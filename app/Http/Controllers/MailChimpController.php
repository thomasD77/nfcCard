<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailChimpController extends Controller
{
    //

    public function index()
    {
        return view('admin.mailchimp.index');
    }

    public function contact()
    {
        return view('admin.mailchimp.contact');
    }
}
