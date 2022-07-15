<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\listUrl;
use App\Models\Team;
use App\Models\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CardListGenerator extends Controller
{
    //This is the function that will generate all the URL'S for the SWAP Card that we need for programming
    public function generateListUrl(Request $request)
    {
        //Amount of Cards
        $count = $request->card_number;
        $project_url = URL::first()->url;


        for($i = 1; $i <= $count; $i++ ){
            $cardURL = new listUrl();
            $cardURL->team_id = $request->ambassador;
            $cardURL->save();
        }

        $updateCardURL = listUrl::query()
            ->where('team_id', $request->ambassador)
            ->whereNull('memberURL')
            ->get();

        foreach ($updateCardURL as $url){
            $url->card_id = $url->id;
            $url->memberURL = $project_url . '/?' . $url->id;
            $url->memberQRcode = $project_url . '/QRcode'. '/' . $url->id;
            $url->material_id = 1;
            $url->package_id = 2;
            $url->update();
        }

        return redirect('/admin/card-credentials');
    }
}
