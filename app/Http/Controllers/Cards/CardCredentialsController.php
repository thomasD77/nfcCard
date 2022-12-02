<?php

namespace App\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use App\Models\listUrl;
use App\Models\Member;
use App\Models\Team;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
    public function cardCredentialsSheetGenerator($id)
    {
        $members = listUrl::where('print', 1)->get();
        $pdf = PDF::loadView('admin.members.code', compact('members'));
        $team = Team::findOrFail($id);

        foreach ($members as $member) {
            $member->print = 0;
            $member->update();
        }

        return $pdf->download('card-details-' . $team->name . '.pdf');
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
        $url->type_id = $request->type_id;
        $url->reservation = $request->reservation;
        $url->image = $request->image;
        $url->memberURL = $request->custom_url;
        $url->role_id = $request->role_id;
        $url->webshop_order_id = $request->webshop_order_id;
        $url->trial_date = $request->trial_date;

        if($request->input_QR_url)
        {
            $url->custom_QR_url = $request->input_QR_url;
        }

        if(!$request->is_importer){
            $url->is_importer = 0;
        }else {
            $url->is_importer = 1;
        }

        if(!$request->business){
            $url->business = 0;
        }else {
            $url->business = 1;
        }

        if(!$request->is_company){
            $url->is_company = 0;
        }else {
            $url->is_company = 1;
        }

        $url->update();


        $member = Member::where('card_id', $request->url_id)->first();
        if($member)
        {
            $member->material_id = $url->material_id;
            $member->update();
        }

        return redirect()->route('card-credentials-details', $url->team_id);
    }
}
