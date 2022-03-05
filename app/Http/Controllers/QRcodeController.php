<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Package;
use App\Models\QRCODE;
use App\Models\QRcodeValidator;
use App\Models\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class QRcodeController extends Controller
{
    //
    public function QRcodeList()
    {
        $members = Member::query()
            ->where('archived', 0)
            ->get();

        return view('admin.members.code', compact('members' ));
    }

    public function QRcodeListWithParams()
    {

        $members = Member::query()
            ->where('archived', 0)
            ->get();

        return view::make('admin.members.code', compact('members'));
    }

    public function QRcodeSelect(Request $request)
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

        return redirect('/admin');
    }
}

