<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\listUrl;
use App\Models\Team;
use App\Models\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }
}
