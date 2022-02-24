<?php

namespace App\Http\Controllers;

use App\Exports\MemberCredentialCardExport;
use App\Exports\MemberListExport;
use App\Models\Member;
use App\Models\Order;
use App\Models\Package;
use App\Models\URL;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LaravelQRCode\Facades\QRCode;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Browsershot\Browsershot;

class AdminMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $member = Member::first();
        $member_url = substr_replace($member->memberURL, "" ,-9) ;
        $QRcode = \App\Models\QRCODE::first();

        return view('admin.members.index', compact('member_url', 'member', 'QRcode'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $member = new Member();

        //General
        $member->firstname = $request->firstname;
        $member->lastname = $request->lastname;
        $member->email = $request->email;
        $member->company = $request->company;
        $member->age = $request->age;
        $member->jobTitle = $request->jobTitle;
        $member->shortDescription = $request->shortDescription;
        $member->website = $request->website;
        $member->notes = $request->notes;

        //Contact information
        $member->mobileWork = $request->mobileWork;
        $member->mobile = $request->mobile;
        $member->addressLine1 = $request->addressLine1;
        $member->addressLine2 = $request->addressLine2;
        $member->city = $request->city;
        $member->country = $request->country;
        $member->postalCode = $request->postalCode;

        //Socials
        $member->facebook = $request->facebook;
        $member->instagram = $request->instagram;
        $member->twitter = $request->twitter;
        $member->youTube = $request->youTube;
        $member->tikTok = $request->tikTok;
        $member->linkedIn = $request->linkedIn;
        $member->whatsApp = $request->whatsApp;
        $member->facebookMessenger = $request->facebookMessenger;

        $member->save();

        \Brian2694\Toastr\Facades\Toastr::success('Member Successfully Saved');

        return redirect('/admin/members');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $member = Member::findOrFail($id);
        return view('admin.members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $member = Member::findOrFail($id);

        $package = Package::where('value', 1)->first();

        if(! isset($package)){
            $package = 'No package selected';
        }else{
            $package = $package->package;
        }

        return view('admin.members.edit', compact('member', 'package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $member = Member::findOrFail($id);



        //General
        if($request->firstname != null){
            $member->firstname = $request->firstname;
        }else{
            $member->firstname = "MEMBER FIRSTNAME";
        }

        if($request->lastname != null){
            $member->lastname = $request->lastname;
        }else{
            $member->lastname = "MEMBER LASTNAME";
        }

        if($request->email != null){
            $member->email = $request->email;
        }else{
            $member->email = "MEMBER EMAIL";
        }

        if($request->company != null){
            $member->company = $request->company;
        }else{
            $member->company = "MEMBER COMPANY";
        }

        if($request->age != null){
            $member->age = $request->age;
        }else{
            $member->age = Carbon::now()->format('Y-m-d');
        }

        if($request->jobTitle != null){
            $member->jobTitle = $request->jobTitle;
        }else{
            $member->jobTitle = "MEMBER JOB TITLE";
        }

        if($request->shortDescription != null){
            $member->shortDescription = $request->shortDescription;
        }else{
            $member->shortDescription = "THIS IS DEFAULT TEXT";
        }

        if($request->website != null){
            $member->website = $request->website;
        }else{
            $member->website = "MEMBER WEBSITE";
        }

        if($request->notes != null){
            $member->notes = $request->notes;
        }else{
            $member->notes = "MEMBER NOTES";
        }

        //Contact information
        if($request->mobileWork != null){
            $member->mobileWork = $request->mobileWork;
        }else{
            $member->mobileWork = "MEMBER MOBILE WORK";
        }
        if($request->mobile != null){
            $member->mobile = $request->mobile;
        }else{
            $member->mobile = "MEMBER MOBILE";
        }
        if($request->addressLine1 != null){
            $member->addressLine1 = $request->addressLine1;
        }else{
            $member->addressLine1 = "MEMBER ADDRESS 1";
        }
        if($request->addressLine2 != null){
            $member->addressLine2 = $request->addressLine2;
        }else{
            $member->addressLine2 = "MEMBER ADDRESS 2";
        }
        if($request->city != null){
            $member->city = $request->city;
        }else{
            $member->city = "MEMBER CITY";
        }
        if($request->country != null){
            $member->country = $request->country;
        }else{
            $member->country = "MEMBER COUNTRY";
        }
        if($request->postalCode != null){
            $member->postalCode = $request->postalCode;
        }else{
            $member->postalCode = "MEMBER POSTALCODE";
        }

        //Socials
        if($request->facebook != null){
            $member->facebook = $request->facebook;
        }else{
            $member->facebook = "MEMBER FACEBOOK";
        }
        if($request->instagram != null){
            $member->instagram = $request->instagram;
        }else{
            $member->instagram = "MEMBER INSTAGRAM";
        }
        if($request->twitter != null){
            $member->twitter = $request->twitter;
        }else{
            $member->twitter = "MEMBER TWITTER";
        }
        if($request->youTube != null){
            $member->youTube = $request->youTube;
        }else{
            $member->youTube = "MEMBER YOUTUBE";
        }
        if($request->tikTok != null){
            $member->tikTok = $request->tikTok;
        }else{
            $member->tikTok = "MEMBER TIKTOK";
        }
        if($request->linkedIn != null){
            $member->linkedIn = $request->linkedIn;
        }else{
            $member->linkedIn = "MEMBER LINKEDIN";
        }
        if($request->whatsApp != null){
            $member->whatsApp = $request->whatsApp;
        }else{
            $member->whatsApp = "MEMBER WHATSAPP";
        }
        if($request->facebookMessenger != null){
            $member->facebookMessenger = $request->facebookMessenger;
        }else{
            $member->facebookMessenger = "MEMBER MESSENGER";
        }

        /** wegschrijven van de avatar **/
        if($file = $request->file('avatar_id')){
            $name = time(). $file->getClientOriginalName();
            $file->move('card/avatars', $name);
            $member->avatar = $name;
        }

        $member->update();

        \Brian2694\Toastr\Facades\Toastr::success('Member Successfully Updated');
        return redirect('/admin/members');
    }

    public function archive()
    {
       $members = Member::where('archived', 1)
            ->latest()
            ->paginate(25);

        return view('admin.members.archive', compact('members'));
    }


    //This function will generate MEMBERS & USERS
    public function generate(Request $request)
    {
        $member_number = $request->member_number;
        $member_count = Member::max('id');

        $last_member = Member::max('id') + 1;
        $new_amount = $member_number + $member_count;

        for ($i = $last_member; $i <= $new_amount; $i++ )
        {
            $user = new User();
            $user->name = 'USER-' . $i;
            $user->email = 'info@user-' . $i;
            $user->password = bcrypt('USER-' . $i);
            $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->created_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->save();


            $url = URL::first()->url;
            $member = new Member();

            $member->user_id = $user->id;
            $member->memberURL = $url . '/member/' . $i;
            $member->memberCustomURL = $url . '/member/custom/' . $i;
            $member->membervCard = $url . '/vCard/' . $i;
            $member->memberQRcode = $url . '/QRcode/' . $i;
            $member->save();

            $user->member_id = $member->id;
            $user->update();

            DB::table('user_role')->insert([                                                                          // superAdmin for Innova account
                'user_id' => $user->id,
                'role_id' => '3',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),]);
        }

        \Brian2694\Toastr\Facades\Toastr::success('Members Successfully Generated');
        return redirect('/admin/members');
    }

    public function generateCredentialMemberList()
    {
        \Brian2694\Toastr\Facades\Toastr::success('List Successfully Generated');
        return Excel::download(new MemberCredentialCardExport(), 'MemberCardList.xlsx');
    }

    public function searchMember(Request $request)
    {
        $member_value = $request->member;

        $members = Member::where(function($q) use($member_value) {
            $q->where('firstname', 'LIKE', '%' . $member_value . '%')
                ->Orwhere('lastname', 'LIKE', '%' . $member_value . '%')
                ->where('archived', 0);
        })->paginate(25);

        $member = Member::first();
        $member_url = substr_replace($member->memberURL, "" ,-9) ;
        $active_user_role = Auth::user()->roles->first()->name;
        $active_user = Auth::user()->id;


        return view('admin.members.search', compact('members', 'member', 'member_url', 'active_user_role', 'active_user'));

    }

}
