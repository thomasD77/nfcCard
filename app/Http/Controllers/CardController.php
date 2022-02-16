<?php

namespace App\Http\Controllers;

use App\Exports\MemberListExport;
use App\Exports\SubmissionExport;
use App\Models\Member;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CardController extends Controller
{
    //

    public function landingPageMember($id)
    {
        $member = Member::findOrFail($id);
        return view('front.members.show', compact('member'));
    }

    public function listGenerator(Request $request)
    {
        $member_url = $request->member_url;

        $members = Member::all();
        foreach ($members as $member){
            $member->memberURL = $member_url . $member->id;
            $member->update();
        }

        return Excel::download(new MemberListExport(), 'membersListURL.xlsx');

    }

}
