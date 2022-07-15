<?php

namespace App\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use App\Models\listUrl;
use App\Models\Member;
use App\Models\Team;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CardCredentialsController extends Controller
{
    //
    public function cardCredentialsList()
    {
        return view ('admin.members.list');
    }

    public function cardCredentialsListDetail(Team $team)
    {
        $current_team = $team;

        return view ('admin.members.list-detail', compact('current_team'));
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


    //This is the modal that gives you the option to customize your SWAP CARD info.
    //Attention! Check your URLS !!!
    public function updateCard(Request $request)
    {
        $validated = $request->validate([
            'reservation'=>'max:150',
        ]);

        $url = listUrl::findOrFail($request->url_id);

        $url->material_id = $request->material_id;
        $url->reservation = $request->reservation;
        $url->image = $request->image;
        $url->memberURL = $request->custom_url;
        $url->role_id = $request->role_id;

        if($request->input_QR_url)
        {
            $url->custom_QR_url = $request->input_QR_url;
        }

        if(!$request->business){
            $url->business = 0;
        }else {
            $url->business = 1;
        }

        $url->update();


        $member = Member::where('card_id', $request->url_id)->first();
        if($member)
        {
            $member->material_id = $url->material_id;
            $member->update();
        }

        \Brian2694\Toastr\Facades\Toastr::success('Edit Card Successfully');
        return redirect()->back();
    }
}
