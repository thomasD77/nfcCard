<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\listUrl;
use App\Models\Member;
use App\Models\Team;
use App\Models\URL;
use App\Models\User;
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
            $url->role_id = 3;
            $url->memberURL = $project_url . '/?' . $url->id;
            $url->memberQRcode = $project_url . '/QRcodeMember'. '/' . $url->id;
            $url->material_id = 1;
            $url->package_id = 2;
            $url->update();
        }

        return redirect('/admin/card-credentials');
    }

    public function bulkSelectListUrl(Request $request)
    {
        $urls = listUrl::where('team_id', $request->team)
            ->where('print', 1)
            ->get();

        foreach ($urls as $url) {
            if($request->reservation) {
                $url->reservation = $request->reservation;
            }
            if($request->design) {
                $url->image = $request->design;
            }
            if($request->roles) {
                $url->role_id = $request->roles;
            }
            if($request->materials) {
                $url->material_id = $request->materials;
            }
            if($request->types) {
                $url->type_id = $request->types;
            }

            $url->print = 0;

            $url->update();

        }

        \Brian2694\Toastr\Facades\Toastr::success('List Successfully Updated');
        return redirect()->back();

    }

    public function bulkDelete(Team $team)
    {
        $urls = listUrl::where('team_id', $team->id)
            ->where('print', 1)
            ->pluck('member_id');

        $members = Member::whereIn('id', $urls)->get();

        $users = User::whereIn('member_id', $members )->get();

        foreach ($users as $user) {
            $user->delete();
        }

        foreach ($members as $member) {
            $member->delete();
        }

        \Brian2694\Toastr\Facades\Toastr::success('User(s) Successfully Deleted');
        return redirect()->back();

    }
}
