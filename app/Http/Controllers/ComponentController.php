<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentController extends Controller
{
    //

    public function index()
    {
        return view('admin.pages.components');
    }
}
