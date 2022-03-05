<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    //
    public function getDirection()
    {
        //Get ID from URL
        $url = url()->full();
        $parts = parse_url($url);

        if(isset($parts['query']) !== false)
        {
            $url_card_id = substr_replace($parts['query'], "", -1);
        }
        else
        {
            return view( 'landing');
        }

        //Search Member with this Card ID
        $member = Member::where('card_id', $url_card_id)->first();

        //IF Member get the USER account ELSE there is no USER yet
        if($member){
            $user = User::where('id', $member->id)->first();
        }else{
            $user = null;
        }

        if($user){

            return view( 'front.landingspage_default.index', compact('member'));

        } else {

            return view( 'auth.register', compact('url_card_id'));
        }

    }
}
