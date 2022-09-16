<?php

namespace App\Http\Controllers;

use App\Exports\MemberCredentialCardExport;
use App\Exports\MemberListExport;
use App\Http\Requests\MemberRequest;
use App\Models\Banner;
use App\Models\listUrl;
use App\Models\Material;
use App\Models\Member;
use App\Models\Order;
use App\Models\Package;
use App\Models\Photo;
use App\Models\State;
use App\Models\URL;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LaravelQRCode\Facades\QRCode;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Browsershot\Browsershot;
use Image;
use Illuminate\Support\Facades\File;

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
        $count = Member::count();
        return view('admin.members.index', compact('count'));
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

        //Thank you message
        $member->titleMessage = $request->titleMessage;
        $member->message = $request->message;

        //Socials
        $member->facebook = $request->facebook;
        $member->instagram = $request->instagram;
        $member->twitter = $request->twitter;
        $member->youTube = $request->youTube;
        $member->tikTok = $request->tikTok;
        $member->linkedIn = $request->linkedIn;
        $member->whatsApp = $request->whatsApp;
        $member->facebookMessenger = $request->facebookMessenger;

        $video = str_replace('watch?v=', 'embed/', $request->youtube_video);
        $member->youtube_video = $video;

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
    public function update(MemberRequest $request, $id)
    {
        //
        $member = Member::findOrFail($id);
        $state = State::where('member_id', $member->id)->first();


        //General

        if($request->check_firstname !== NULL){
            $state->firstname = $request->check_firstname;
        }else {
            $state->firstname = 0;
        }
        if($request->firstname !== NULL)
        {
            $member->firstname = $request->firstname;
        }
        else
        {
            $member->firstname = "";
        }

        if($request->check_lastname !== NULL){
            $state->lastname = $request->check_lastname;
        }else {
            $state->lastname = 0;
        }
        if($request->lastname !== NULL)
        {
            $member->lastname = $request->lastname;
        }
        else
        {
            $member->lastname = "";
        }

        if($request->check_email !== NULL){
            $state->email = $request->check_email;
        }else {
            $state->email = 0;
        }
        if($request->email !== NULL)
        {
            $member->email = $request->email;
        }
        else
        {
            $member->email = "";
        }

        if($request->check_company !== NULL){
            $state->company = $request->check_company;
        }else {
            $state->company = 0;
        }
        if($request->company !== NULL)
        {
            $member->company = $request->company;
        }
        else
        {
            $member->company = "";
        }


        if($request->check_age !== NULL){
            $state->age = $request->check_age;
        }else {
            $state->age = 0;
        }
        if($request->age !== NULL)
        {
            $member->age = $request->age;
        }
        else
        {
            $member->age = NULL;
        }

        if($request->check_notes !== NULL){
            $state->notes = $request->check_notes;
        }else {
            $state->notes = 0;
        }
        $member->notes = $request->notes;

        if($request->check_jobTitle !== NULL){
            $state->jobTitle = $request->check_jobTitle;
        }else {
            $state->jobTitle = 0;
        }
        if($request->jobTitle !== NULL)
        {
            $member->jobTitle = $request->jobTitle;
        }
        else
        {
            $member->jobTitle = "";
        }

        if($request->check_shortDescription !== NULL){
            $state->shortDescription = $request->check_shortDescription;
        }else {
            $state->shortDescription = 0;
        }
        if($request->shortDescription !== NULL)
        {
            $member->shortDescription = $request->shortDescription;
        }
        else
        {
            $member->shortDescription = "";
        }

        if($request->check_website !== NULL){
            $state->website = $request->check_website;
        }else {
            $state->website = 0;
        }
        if($request->website !== NULL)
        {
            $member->website = $request->website;
        }
        else
        {
            $member->website = "";
        }


        //Thank you message
        if($request->titleMessage !== NULL)
        {
            $member->titleMessage = $request->titleMessage;
        }
        else
        {
            $member->titleMessage = "";
        }

        if($request->message !== NULL)
        {
            $member->message = $request->message;
        }
        else
        {
            $member->message = "";
        }


        //Contact information
        if($request->check_mobileWork !== NULL){
            $state->mobileWork = $request->check_mobileWork;
        }else {
            $state->mobileWork = 0;
        }
        if($request->mobileWork !== NULL)
        {
            $member->mobileWork = $request->mobileWork;
        }
        else
        {
            $member->mobileWork = "";
        }

        if($request->check_mobile !== NULL){
            $state->mobile = $request->check_mobile;
        }else {
            $state->mobile = 0;
        }
        if($request->mobile !== NULL)
        {
            $member->mobile = $request->mobile;
        }
        else
        {
            $member->mobile = "";
        }

        if($request->check_addressLine1 !== NULL){
            $state->addressLine1 = $request->check_addressLine1;
        }else {
            $state->addressLine1 = 0;
        }
        if($request->addressLine1 !== NULL)
        {
            $member->addressLine1 = $request->addressLine1;
        }
        else
        {
            $member->addressLine1 = "";
        }

        if($request->check_city !== NULL){
            $state->city = $request->check_city;
        }else {
            $state->city = 0;
        }
        if($request->city !== NULL)
        {
            $member->city = $request->city;
        }
        else
        {
            $member->city = "";
        }

        if($request->check_country !== NULL){
            $state->country = $request->check_country;
        }else {
            $state->country = 0;
        }
        if($request->country !== NULL)
        {
            $member->country = $request->country;
        }
        else
        {
            $member->country = "";
        }

        if($request->check_postalCode !== NULL){
            $state->postalCode = $request->check_postalCode;
        }else {
            $state->postalCode = 0;
        }
        if($request->postalCode !== NULL)
        {
            $member->postalCode = $request->postalCode;
        }
        else
        {
            $member->postalCode = "";
        }

        //Socials
        if($request->check_facebook !== NULL){
            $state->facebook = $request->check_facebook;
        }else {
            $state->facebook = 0;
        }
        if($request->facebook !== NULL)
        {
            $member->facebook = $request->facebook;
        }
        else
        {
            $member->facebook = "";
        }

        if($request->check_instagram !== NULL){
            $state->instagram = $request->check_instagram;
        }else {
            $state->instagram = 0;
        }
        if($request->instagram !== NULL)
        {
            $member->instagram = $request->instagram;
        }
        else
        {
            $member->instagram = "";
        }

        if($request->check_twitter !== NULL){
            $state->twitter = $request->check_twitter;
        }else {
            $state->twitter = 0;
        }
        if($request->twitter !== NULL)
        {
            $member->twitter = $request->twitter;
        }
        else
        {
            $member->twitter = "";
        }

        if($request->check_youTube !== NULL){
            $state->youTube = $request->check_youTube;
        }else {
            $state->youTube = 0;
        }
        if($request->youTube !== NULL)
        {
            $member->youTube = $request->youTube;
        }
        else
        {
            $member->youTube = "";
        }

        if($request->check_tikTok !== NULL){
            $state->tikTok = $request->check_tikTok;
        }else {
            $state->tikTok = 0;
        }
        if($request->tikTok !== NULL)
        {
            $member->tikTok = $request->tikTok;
        }
        else
        {
            $member->tikTok = "";
        }

        if($request->check_linkedIn !== NULL){
            $state->linkedIn = $request->check_linkedIn;
        }else {
            $state->linkedIn = 0;
        }
        if($request->linkedIn !== NULL)
        {
            $member->linkedIn = $request->linkedIn;
        }
        else
        {
            $member->linkedIn = "";
        }

        if($request->check_whatsApp !== NULL){
            $state->whatsApp = $request->check_whatsApp;
        }else {
            $state->whatsApp = 0;
        }
        if($request->whatsApp !== NULL)
        {
            $member->whatsApp = $request->whatsApp;
        }
        else
        {
            $member->whatsApp = "";
        }

        if($request->check_customField !== NULL){
            $state->customField = $request->check_customField;
        }else {
            $state->customField = 0;
        }
        if($request->customField !== NULL)
        {
            $member->customField = $request->customField;
        }
        else
        {
            $member->customField = "";
        }

        if($request->customText !== NULL)
        {
            $member->customText = $request->customText;
        }
        else
        {
            $member->customText = "";
        }

        if($request->check_avatar !== NULL){
            $state->avatar = $request->check_avatar;
        }else {
            $state->avatar = 0;
        }
        /*if($file = $request->file('avatar_id')){
            //$name = time(). $file->getClientOriginalName();
            //$file->move('card/avatars', $name);
            //$member->avatar = $name;
            File::delete('card/avatars/'.$member->avatar);
            $member->avatar = $file->getClientOriginalName();
        }*/

        if($request->check_banner !== NULL){
            $state->banner = $request->check_banner;
        }else {
            $state->banner = 0;
        }
        /** wegscrijven van de banner */
        /*if($file = $request->file('banner_id')){
            if($request->file('banner_id')->getSize() <= 2097152) {

                $ex_file = $member->banner->file;
                File::delete(public_path($ex_file));
                $name = now() . $file->getClientOriginalName() ;
                $file->move('media/banners', $name);
                $banner = Banner::create(['file' => $name]);

                $member->banner_id = $banner->id;
            } else{
                \Brian2694\Toastr\Facades\Toastr::error('Banner image to large');
                return back();
            }
        }*/

        if($request->check_youtube_video !== NULL){
            $state->youtube_video = 1;
        } else{
            $state->youtube_video = 0;
        }
        if($request->youtube_video !== NULL)
        {
            $video = str_replace('watch?v=', 'embed/', $request->youtube_video);
            $member->youtube_video = $video;
        }
        else
        {
            $member->youtube_video = "";
        }
        if($request->check_video !== NULL){
            $state->video = 1;
        } else{
            $state->video = 0;
        }

        if($file = $request->file('attachment_id')){
            if($file->getSize() <= 2097152) {
                if($member->video){
                    File::delete(public_path($member->video->file));
                }
                $name = time() . $file->getClientOriginalName() ;
                $file->move('media/videos', $name);
                $video = Video::create(['file' => $name]);

                $member->video_id = $video->id;
            }
        }

        $member->update();
        $state->update();

        \Brian2694\Toastr\Facades\Toastr::success('Member Successfully Updated');
        return redirect('/admin/');
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
            $user->name = 'user-' . $i;
            $user->email = 'info@user-' . $i;
            $user->password = bcrypt('info@user-' . $i);
            $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->created_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->save();


            $url = URL::first()->url;
            $member = new Member();

            $member->user_id = $user->id;
            $member->firstname = 'MEMBER' . "#" . $i;
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
        if(!$request->member) {
            return redirect()->back();
        }

        $member_value = $request->member;

        $members = Member::where(function($q) use($member_value) {
            $q->where('firstname', 'LIKE', '%' . $member_value . '%')
                ->Orwhere('lastname', 'LIKE', '%' . $member_value . '%')
                ->Orwhere('referral', 'LIKE', '%' . $member_value . '%')
                ->where('archived', 0);
        })->paginate(25);

        $member = Member::first();
        $member_url = substr_replace($member->memberURL, "" ,-9) ;
        $active_user_role = Auth::user()->roles->first()->name;
        $active_user = Auth::user()->id;


        return view('admin.members.search', compact('members', 'member', 'member_url', 'active_user_role', 'active_user'));

    }

}
