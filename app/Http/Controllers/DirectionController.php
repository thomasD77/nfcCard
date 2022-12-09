<?php

namespace App\Http\Controllers;

use App\Models\Button;
use App\Models\listUrl;
use App\Models\Member;
use App\Models\Package;
use App\Models\Profile;
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
            $url = listUrl::where('card_id', $url_card_id)->first();
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
        $profile = Profile::where('member_id', $member->id)->where('active', 1)->first();

        if(!$member)
        {
            return view( 'auth.register', compact('url_card_id', 'url'));
        }

        if(!$member->user->is_company)
        {
            $count = $profile->profile_views + 1;
            $profile->profile_views = $count;
            $profile->update();
            $buttons = Button::where('member_id', $member->id)->get();
            return view( 'front.landingspage_default.index', compact('profile', 'buttons', 'member'));
        } else {
            $vCard = null;
            $count = $profile->profile_views + 1;
            $profile->profile_views = $count;
            $profile->update();
            $buttons = Button::where('member_id', $member->id)->get();
            return view( 'front.landingspage_default.company', compact('profile', 'buttons', 'member'));
        }

    }

    public function getDirectionFromId($id)
    {
        //Get ID from URL
        $url_card_id = $id;
        $url = listUrl::where('card_id', $url_card_id)->first();

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
            return view( 'auth.register', compact('url_card_id', 'url'));
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


    public function getTestProfile(Member $member)
    {
        $vCard = null;
        $buttons = Button::where('member_id', $member->id)->get();
        return view( 'front.landingspage_default.index', compact('member', 'vCard', 'buttons'));
    }

}
