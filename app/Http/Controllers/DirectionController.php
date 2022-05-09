<?php

namespace App\Http\Controllers;

use App\Models\listUrl;
use App\Models\Member;
use App\Models\Package;
use App\Models\User;
use App\Models\vCard;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    //
    public function getDirection()
    {
        //Get ID from URL
        $url = url()->full();
        $parts = parse_url($url);


        //Get the ID from the URL
        if(isset($parts['query']) !== false)
        {
            $url_card_id = substr_replace($parts['query'], "", -1);
        }
        else
        {
            return view( 'landing');
        }

        //Check if ID is generated in the LIST
        $listurl = listUrl::where('id', $url_card_id)->select('id')->first();
        if(!$listurl)
        {
            return view( 'auth.card');
        }

        //Search Member with this Card ID
        $member = Member::where('card_id', $url_card_id)->first();
        if(!$member)
        {
            return view( 'auth.register', compact('url_card_id'));
        }
        if($member->package->package == 'Default')
        {
            $vCard = null;
            return view( 'front.landingspage_default.index', compact('member', 'vCard'));
        }
        elseif ($member->package->package == 'Custom')
        {
            return view('front.members.show', compact('member'));
        }
        elseif ($member->package->package == 'vCard')
        {
            $vCard = new vCard();
            $vCard->vCard($member->id);
            return $vCard;
        }
    }


    public function test(){
     
        $member = Member::where('card_id', 1)->first();
        $vCard = null;
        return view( 'front.landingspage_default.download', compact('member', 'vCard'));
    }

}
