<?php

namespace App\Http\Controllers;

use App\Exports\MemberListExport;
use App\Exports\SubmissionExport;
use App\Models\Member;
use Illuminate\Http\Request;
use JeroenDesloovere\VCard\VCard;
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
        foreach ($members as $member)
        {
            $member->memberURL = $member_url . 'member' . $member->id;
            $member->membervCard = $member_url . 'vCard' . $member->id;

            $member->update();
        }


        $CheckboxValidation = [
            'landingpage' => $request->landingpage ? "1" : "0",
            'vCard' => $request->vCard ?  "1" : "0",
        ];

        return Excel::download(new MemberListExport($CheckboxValidation), 'membersListURL.xlsx');

    }

    public function vCard($id)
    {
        // define vcard
        $vcard = new VCard();

        $member = Member::findOrfail($id);

        // define variables
        $lastname = $member->lastname;
        $firstname = $member->firstname;
        $additional = '';
        $prefix = '';
        $suffix = '';

        // add personal data
        $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

        // add work data
        $vcard->addCompany($member->company);
        $vcard->addJobtitle($member->jobTitle);
        //$vcard->addRole('Founder');
        $vcard->addEmail($member->email);
        $vcard->addPhoneNumber($member->mobile );
        $vcard->addAddress(null, null, $member->addressLine1, $member->city, null, $member->postalCode, $member->country);
        $vcard->addURL($member->website);
        //$vcard->addPhoto(asset('images/form_credentials/innova-logo.png'));
        $vcard->addNote($member->notes);

        // return vcard as a download
        return $vcard->download();
    }

}
