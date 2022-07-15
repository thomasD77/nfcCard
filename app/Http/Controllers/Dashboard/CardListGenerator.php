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
        $cardURL = listUrl::all();
        $max_id = listUrl::max('id');

        dd($max_id);

        //If we have cards, we delete the old amount
        if($cardURL->count() > 0)
        {
            if($count > $cardURL->count())
            {
                //Amount is more so we ADD
                $count_diff = $count - $cardURL->count();

                for($i = 1; $i <= $count_diff; $i++ ){
                    $cardURL = new listUrl();
                    $id = $i + $max_id;
                    $cardURL->memberURL = $project_url . '/?' . $id;
                    $cardURL->memberQRcode = $project_url . '/QRcode'. '/' . $id;
                    $cardURL->material_id = 1;
                    $cardURL->package_id = 2;

                    $cardURL->team_id = $request->ambassador;

                    $cardURL->save();
                }
            }
            else
            {
                Session::flash('negative_number', 'You can not add a smaller card amount. This is for security reasons. We do not want to lose existing accounts. Thank you. ');
                return redirect()->back();
            }
        }else {
            //First time generating
            for($i = 1; $i <= $count; $i++ ){
                $cardURL = new listUrl();
                $cardURL->memberURL = $project_url . '/?' . $i;
                $cardURL->memberQRcode = $project_url . '/QRcode'. '/' . $i;
                $cardURL->material_id = 1;
                $cardURL->package_id = 2;

                $cardURL->team_id = $request->ambassador;

                $cardURL->save();
            }
        }
        return redirect('/admin');
    }
}
