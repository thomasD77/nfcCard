<?php

namespace App\Http\Controllers;

use App\Exports\MemberListExport;
use App\Exports\SubmissionExport;
use App\Models\Member;
use App\Models\Package;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use JeroenDesloovere\VCard\VCard;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CardController extends Controller
{
    //This will generate the DEFAULT landingpage
    public function landingPageMemberDefault($id)
    {
        $member = Member::findOrFail($id);
        return view('front.landingspage_default.index', compact('member'));
    }

    //This will generate the CUSTOM landingpage
    public function landingPageMemberCustom($id)
    {
        $member = Member::findOrFail($id);
        return view('front.members.show', compact('member'));
    }

    //This will generate vCard information
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
        $vcard->addBirthday($member->age);

        // add work data
        $vcard->addCompany($member->company);
        $vcard->addJobtitle($member->jobTitle);
        $vcard->addEmail($member->email);
        $vcard->addPhoneNumber($member->mobile );
        $vcard->addAddress(null, null, $member->addressLine1, $member->city, null, $member->postalCode, $member->country);
        $vcard->addURL($member->website);
        //$vcard->addPhoto($member->avatar);
        $vcard->addPhoto(asset('card/avatars/' . $member->avatar));
        $vcard->addNote($member->notes);


        // return vcard as a download
        return $vcard->download();
    }


    //Generate the URLS for the MEBER ID's & export EXCEL file
    public function listGenerator(Request $request)
    {
        $member_url = $request->member_url;
        $members = Member::all();

        foreach ($members as $member)
        {
            $member->memberURL = $member_url . '/member/' . $member->id;
            $member->memberCustomURL = $member_url . '/member/custom/' . $member->id;
            $member->membervCard = $member_url . '/vCard/' . $member->id;
            $member->memberQRcode = $member_url . '/QRcode/' . $member->id;

            $member->update();
        }

        if($request->Excel){
            $CheckboxValidation = [
                'landingpageDefault' => $request->landingpageDefault ? "1" : "0",
                'landingpageCustom' => $request->landingpageCustom ? "1" : "0",
                'vCard' => $request->vCard ?  "1" : "0",
                'QRcode' => $request->QRcode ?  "1" : "0",
            ];

            \Brian2694\Toastr\Facades\Toastr::success('EXCEL Successfully Generated');
            return Excel::download(new MemberListExport($CheckboxValidation), 'membersListURL.xlsx');
        }

        \Brian2694\Toastr\Facades\Toastr::success('URLS Successfully Generated');
        return redirect('/admin/members');
    }


    public function QRcode($id)
    {
        $member = Member::findOrfail($id);

        // Personal Information
        $firstName = $member->firstname;
        $lastName = $member->lastname;
        $email = $member->email;

        // Addresses
        $Address = [
            'type' => 'work',
            'pref' => true,
            'street' => $member->addressLine1,
            'city' => $member->city,
            'state' => '',
            'country' => $member->country,
            'zip' => $member->postalCode
        ];

        $addresses = [$Address];

        // Phones
        $workPhone = [
            'type' => 'work',
            'number' => $member->mobileWork,
            'cellPhone' => true
        ];
        $cellPhone = [
            'type' => 'home',
            'number' => $member->mobile,
            'cellPhone' => true
        ];

        $phones = [$workPhone, $cellPhone];
        $title = $member->jobTitle;
        $org = $member->company;


        $QRcode = \LaravelQRCode\Facades\QRCode::vCard($firstName, $lastName, $title, $email, $addresses, $phones)
            ->setErrorCorrectionLevel('H')
            ->setSize(2)
            ->setMargin(2)
            ->png();

        return $QRcode;
    }

    public function choosePackage(Request $request)
    {
        $package_request = $request->flexRadioDefault;

        $packages = Package::all();

        foreach($packages as $package){
            $package->value = 0;
            $package->update();
        }


        if($package_request == 'custom'){
            $package_current = Package::where('package', 'landingpageCustom')->first();
            $package_current->value = 1;
        }

        if($package_request == 'default'){
            $package_current = Package::where('package', 'landingpageDefault')->first();
            $package_current->value = 1;
        }

        if($package_request == 'vCard'){
            $package_current = Package::where('package', 'vCard')->first();
            $package_current->value = 1;
        }

        $package_current->update();

        return redirect('/admin');
    }


}
