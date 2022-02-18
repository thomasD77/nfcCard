<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\QRcodeValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class QRcodeController extends Controller
{
    //
    public function QRcodeList()
    {
        $members = Member::query()
            ->where('archived', 0)
            ->where('id', '!=', 1)
            ->get();

        $QRcode = QRcodeValidator::first();

        return view('admin.members.code', compact('members', 'QRcode'));
    }

    public function QRcodeListWithParams(Request $request)
    {

        $QRcode = QRcodeValidator::first();

        $QRcode->landingpaginaDefault = 0;
        $QRcode->landingpaginaCustom = 0;
        $QRcode->vCard = 0;
        $QRcode->update();


        if($request->landingpageDefault == "1" ){
            $QRcode->landingpaginaDefault = 1;
        }

        if($request->landingpageCustom == "1" ){
            $QRcode->landingpaginaCustom = 1;
        }

        if($request->vCard == "1" ){
            $QRcode->vCard = 1;
        }

        $QRcode->update();


        $members = Member::query()
            ->where('archived', 0)
            ->where('id', '!=', 1)
            ->get();

        return view::make('admin.members.code', compact('members', 'QRcode'));
    }
}

