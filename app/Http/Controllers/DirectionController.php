<?php

namespace App\Http\Controllers;

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

        $package = Package::where('value', 1)->first();

        //Get package
        if(! isset($package)){
            $package = 'No package selected';
        }else{
            $package = $package->package;
        }


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

            if($package == 'landingpageDefault')
            {
                return view( 'front.landingspage_default.index', compact('member'));
            }
            elseif ($package == 'landingpageCustom')
            {
                return view('front.members.show', compact('member'));
            }
            elseif ($package == 'vCard')
            {
                $vCard = new vCard();
                $vCard->vCard($member->id);
                return $vCard;
            }
            elseif ($package == 'No package selected')
            {
                return 'No package selected';
            }


        }
        else
        {

            return view( 'auth.register', compact('url_card_id'));
        }

    }
}
