<?php

namespace App\Http\Controllers;

use App\Exports\MemberListExport;
use App\Exports\SubmissionExport;
use App\Models\listUrl;
use App\Models\Member;
use App\Models\Package;
use App\Models\URL;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $member = Member::where('card_id', $id)->first();

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
        $vcard->addPhoto($member->avatar ? asset('card/avatars/' . $member->avatar) : asset('assets/front/img/avatar-2.svg'));
        $vcard->addNote($member->notes);


        // return vcard as a download
        return $vcard->download();
    }


    //Generate the URLS for the MEBER ID's & export EXCEL file
    public function listGenerator(Request $request)
    {
        return Excel::download(new MemberListExport(), 'membersListURL.xlsx');
    }


    public function QRcode($id)
    {
        $currentURL = URL::first()->url;

        $QRcode_url = $currentURL . '/' . 'vCard' . '/' . $id;

        $QRcode = QrCode::size(150)->backgroundColor(255,255,255)->generate($QRcode_url);

        return $QRcode;

//        $member = Member::where('card_id', $id)->first();
//        if(!$member){
//            $firstName = "";
//            $lastName = "";
//            $email = "";
//            $title = "";
//
//            $Address = [
//                'type' => "",
//                'pref' => true,
//                'street' => "",
//                'city' => "",
//                'state' => "",
//                'country' => "",
//                'zip' => ""
//            ];
//
//            $workPhone = [
//                'type' => "",
//                'number' => "",
//                'cellPhone' => true
//            ];
//            $cellPhone = [
//                'type' => "",
//                'number' => "",
//                'cellPhone' => true
//            ];
//        }
//        else
//        {
//            // Personal Information
//            $firstName = $member->firstname;
//            $lastName = $member->lastname;
//            $email = $member->email;
//            $title = $member->jobTitle;
//
//            // Addresses
//            $Address = [
//                'type' => 'work',
//                'pref' => true,
//                'street' => $member->addressLine1,
//                'city' => $member->city,
//                'state' => '',
//                'country' => $member->country,
//                'zip' => $member->postalCode
//            ];
//            // Phones
//            $workPhone = [
//                'type' => 'work',
//                'number' => $member->mobileWork,
//                'cellPhone' => true
//            ];
//            $cellPhone = [
//                'type' => 'home',
//                'number' => $member->mobile,
//                'cellPhone' => true
//            ];
//        }
//
//        $addresses = [$Address];
//        $phones = [$workPhone, $cellPhone];
//        //$org = $member->company;
//
//        $QRcode = \LaravelQRCode\Facades\QRCode::vCard($firstName, $lastName, $title, $email, $addresses, $phones)
//            ->setErrorCorrectionLevel('H')
//            ->setSize(2)
//            ->setMargin(2)
//            ->png();
//
//        return $QRcode;
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

    public function generateCards(Request $request)
    {
        //Amount of Cards
        $count = $request->card_number;

        $project_url = URL::first()->url;
        $cardURL = listUrl::all();


        //If we have cards, we delete the old amount
        if($cardURL->count() > 0)
        {
            foreach ($cardURL as $url)
            {
                $url->delete();
            }
        }

        //Reset Database ID's
        DB::table('list_urls')->truncate();


        //Create new Card amount
        for($i = 1; $i <= $count; $i++ ){
            $cardURL = new listUrl();
            $cardURL->memberURL = $project_url . '/?' . $i;
            $cardURL->memberQRcode = $project_url . '/QRcode'. '/' . $i;
            $cardURL->save();
        }

        return redirect('/admin');

    }

}
