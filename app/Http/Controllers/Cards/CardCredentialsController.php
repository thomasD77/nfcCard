<?php

namespace App\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use App\Models\listUrl;
use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CardCredentialsController extends Controller
{
    //
    public function cardCredentialsList()
    {
        return view ('admin.members.list');
    }

    //This is the function that will generate a sheet with all the (custom) SWAP CARD information that we need
    //to send to our supplier
    public function cardCredentialsSheetGenerator()
    {
        $members = listUrl::where('print', 1)->get();
        $pdf = PDF::loadView('admin.members.code', compact('members'));

        foreach ($members as $member) {
            $member->print = 0;
            $member->update();
        }

        return $pdf->download('card-details.pdf');
    }
}
