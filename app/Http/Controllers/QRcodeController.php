<?php

namespace App\Http\Controllers;

use App\Models\listUrl;
use App\Models\Member;
use App\Models\Package;
use App\Models\QRCODE;
use App\Models\QRcodeValidator;
use App\Models\URL;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class QRcodeController extends Controller
{
    public function QRcodeList()
    {
        $members = Member::query()
            ->where('archived', 0)
            ->get();

        return view('admin.members.code', compact('members' ));
    }

}

