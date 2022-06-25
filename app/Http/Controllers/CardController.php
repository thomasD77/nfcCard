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
use App\Models\Member;
use App\Models\Package;
use App\Models\State;
use App\Models\URL;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use JeroenDesloovere\VCard\VCard;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Redirect;

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
        $state = State::where('member_id', $member->id)->first();


        // define variables

        if($state->lastname){
            $lastname = $member->lastname;
        }else {
            $lastname = "";
        }

        if($state->lastname){
            $firstname = $member->firstname;
        }else {
            $firstname = "";
        }

        $additional = '';
        $prefix = '';
        $suffix = '';

        // add personal data

        $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

        if($state->age) {
            $vcard->addBirthday($member->age);
        }

        // add work data

        if($state->company) {
            $vcard->addCompany($member->company);
        }

        if($state->jobTitle) {
            $vcard->addJobtitle($member->jobTitle);
        }

        if($state->email) {
            $vcard->addEmail($member->email);
        }

        if($state->mobile) {
            $vcard->addPhoneNumber($member->mobile);
        }

        if($state->mobileWork) {
            $vcard->addPhoneNumber($member->mobileWork);
        }


        if($state->addressLine1){
            $addressLine1 = $member->addressLine1;
        }else {
            $addressLine1 = "";
        }

        if($state->city){
            $city = $member->city;
        }else {
            $city = "";
        }

        if($state->postalCode){
            $postalCode = $member->postalCode;
        }else {
            $postalCode = "";
        }

        if($state->country){
            $country = $member->country;
        }else {
            $country = "";
        }


        $vcard->addAddress(null, null, $addressLine1, $city, null, $postalCode, $country);


        if($state->website) {
            $vcard->addURL($member->website);
        }

        //$vcard->addPhoto($member->avatar ? asset('card/avatars/' . $member->avatar) : asset('/card/img/bg-vcard.png'));

        if($state->notes) {
            $vcard->addNote($member->notes);
        }

        // return vcard as a download
        return $vcard->download();
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


    public function saveInfo(Request $request, $id)
    {
        $validated = $request->validate([
            'name'=>'required|max:150',
            'email'=>'required|max:150|email:rfc,dns'
        ]);

        // Store request to logs
        Storage::disk('local')
            ->put(time().'-SWAP.json', json_encode($validated));

        $vCard = null;
        $member = Member::where('card_id', $id)->first();

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $data = [
            'secret' => config('custom.RECAPTCHA_SECRET_KEY'),
            'response' => $request->get('recaptcha'),
            'remoteip' => $remoteip
        ];
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);

        if ($resultJson->success != true) {

            //Session::flash('recaptcha_error', 'ReCaptcha is blocking request. Please try again. ');
            return view( 'front.landingspage_default.index', compact('member', 'vCard'));

        }

        if ($resultJson->score >= 0.1) {

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

            //$this->dispatch(new SendCardCredentialsJob($contact, $member));
            //$this->dispatch(new SendProspectJob($contact, $member));
            //Mail::to('thomas@ntriga.agency')->send(new SendCardCredentails($member));

            Mail::to($contact->email)->send(new SendCardCredentails($member));
            Mail::to($member->email)->send(new SendProspect($contact, $member));

            if($request->session()->has('recaptcha_error')){
                $request->session()->forget('recaptcha_error');
            }

            Session::forget('recaptcha_error');
            return view( 'front.landingspage_default.download', compact('member', 'vCard'));

        } else {

            Session::flash('recaptcha_error', 'We think you are a bot. Please try again. ');
            return view( 'front.landingspage_default.index', compact('member', 'vCard'));
        }




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
