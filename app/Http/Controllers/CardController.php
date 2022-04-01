<?php

namespace App\Http\Controllers;

use App\Exports\ListUrlExportView;
use App\Exports\MemberListExport;
use App\Exports\MemberUrlExport;
use App\Exports\ScanListClientExport;
use App\Exports\ScanListExport;
use App\Exports\SubmissionExport;
use App\Http\Requests\ContactRequest;
use App\Jobs\SendCardCredentialsJob;
use App\Jobs\SendProspectJob;
use App\Mail\SendCardCredentails;
use App\Mail\SendProspect;
use App\Models\Contact;
use App\Models\listUrl;
use App\Models\Lock;
use App\Models\Member;
use App\Models\Package;
use App\Models\URL;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
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
        //$vcard->addPhoto($member->avatar ? asset('card/avatars/' . $member->avatar) : asset('/card/img/bg-vcard.png'));
        $vcard->addNote($member->notes);

        // return vcard as a download
        return $vcard->download();

    }


    //Generate the URLS for the MEBER ID's & export EXCEL file
    public function listGenerator()
    {
        return Excel::download(new ListUrlExportView(), 'card-list.xlsx');
    }


    public function QRcode($id)
    {
        $Card_id = listUrl::findOrFail($id);

        //If there is a custom QR code URL
        if($Card_id->custom_QR_url != "")
        {
            $QRcode_url = $Card_id->custom_QR_url;
            $QRcode = QrCode::size(150)->backgroundColor(255,255,255)->generate($QRcode_url);
            return $QRcode;
        }
        else
        {
            $currentURL = URL::first()->url;
            $QRcode_url = $currentURL . '/' . 'vCard' . '/' . $id;
            $QRcode = QrCode::size(150)->backgroundColor(255,255,255)->generate($QRcode_url);
            return $QRcode;
        }


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


    public function generateCards(Request $request)
    {
        //Amount of Cards
        $count = $request->card_number;
        $project_url = URL::first()->url;
        $cardURL = listUrl::all();
        $max_id = listUrl::max('id');

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
                    $cardURL->save();
                }
            }
            else
            {
                Session::flash('negative_number', 'You can not add a smaller card amount. This is for security reasons. We do not want to lose existing accounts. Thank you. ');
                return redirect()->back();
                //Amount is LESS so we RESTART
//                foreach ($cardURL as $url)
//                {
//                    $url->delete();
//                }
//                //Reset Database ID's
//                DB::table('list_urls')->truncate();
//                //Create new Card amount
//                for($i = 1; $i <= $count; $i++ ){
//                    $cardURL = new listUrl();
//                    $cardURL->memberURL = $project_url . '/?' . $i;
//                    $cardURL->memberQRcode = $project_url . '/QRcode'. '/' . $i;
//                    $cardURL->material_id = 1;
//                    $cardURL->package_id = 2;
//                    $cardURL->save();
//                }
            }
        }else{
            //First time generating
            for($i = 1; $i <= $count; $i++ ){
                $cardURL = new listUrl();
                $cardURL->memberURL = $project_url . '/?' . $i;
                $cardURL->memberQRcode = $project_url . '/QRcode'. '/' . $i;
                $cardURL->material_id = 1;
                $cardURL->package_id = 2;
                $cardURL->save();
            }
        }



        return redirect('/admin');

    }

    public function lock()
    {
        $lock = Lock::first();
        $lock->status = 0;
        $lock->update();

        return redirect('/admin');
    }

    public function unlock()
    {
        $lock = Lock::first();
        $lock->status = 1;
        $lock->update();

        return redirect('/admin');
    }

    public function print()
    {
        $QRcode = \App\Models\QRCODE::first();

        $ids = Member::where('print', 1)->select(['id'])->get();
        $members = listUrl::whereIn('member_id', $ids)
            ->get();

        if($QRcode->status == 1)
        {
            $pdf = PDF::loadView('admin.members.code', compact('members'));

            $members = Member::select(['id', 'print'])->get();
            foreach ($members as $member){
                $member->print = 0;
                $member->update();
            }

            return $pdf->download('card-details.pdf');
        }
        else
        {
            return Excel::download(new MemberUrlExport(), 'member-card-list.xlsx');
        }
    }


    public function saveInfo(ContactRequest $request, $id)
    {
        $member = Member::where('card_id', $id)->first();
        $contact = new Contact();

        $contact->member_id = $member->id;
        $contact->name = $request->name;
        $contact->email = $request->email;

        if($request->phone == "")
        {
            $contact->phone = "";
        }
        else
        {
            $contact->phone = $request->phone;
        }

        if($request->message == "")
        {
            $contact->message = "";
        }
        else
        {
            $contact->message = $request->message;
        }

        $contact->save();

       $this->dispatch(new SendCardCredentialsJob($contact, $member));
       $this->dispatch(new SendProspectJob($contact, $member));

        //$this->vCard($id);
    }

    public function printScans()
    {
        return Excel::download(new ScanListExport(), 'scan-list.xlsx');
    }
    public function printScansClient()
    {
        return Excel::download(new ScanListClientExport(), 'scan-list.xlsx');
    }



}
