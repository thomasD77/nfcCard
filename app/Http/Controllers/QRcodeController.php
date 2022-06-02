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
    //This is the option on the dashboard to select if the client wants QRcode on the SWAP cards
    public function QRcodeStatus(Request $request)
    {
        if($request->flexRadioDefault == 'ja'){
            $status = 1;
        }

        if($request->flexRadioDefault == 'nee'){
            $status = 0;
        }

        $QRcode = QRCODE::first();
        $QRcode->status = $status;
        $QRcode->update();

        return redirect()->route('admin.home');
    }

    //
    public function QRcodeList()
    {
        $members = Member::query()
            ->where('archived', 0)
            ->get();

        return view('admin.members.code', compact('members' ));
    }

}

