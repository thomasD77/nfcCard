<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Member;
use App\Models\Package;
use App\Models\Profile;
use App\Models\State;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AdminProfilesController extends Controller
{
    public function index()
    {
        //
        $count = User::where('team_id', Auth::user()->team_id)->count();
        return view('admin.members.index', compact('count'));
    }

    public function edit($id){
        $member = Member::findOrFail($id);
        $profiles = Profile::with(['state', 'logo', 'banner'])->where('member_id', $id)->get();
        $package = Package::where('value', 1)->first();

        if(! isset($package)){
            $package = 'No package selected';
        }else{
            $package = $package->package;
        }

        return view('admin.members.edit', compact('member', 'package','profiles'));
    }

    public function update(ProfileRequest $request, $profileId){
        $profile = Profile::findOrFail($profileId);
        $member = Member::findOrFail($profile->member_id);
        $profiles = Profile::where('member_id', $member->id)->get();
        $state = State::where('profile_id', $profileId)->first();

        // Profile
        if($request->profile_name){
            $profile->profile_name = $request->profile_name;
        }

        if($request->active){
            foreach($profiles as $p){
                $p->active = 0;
                $p->update();
            }
            $profile->active = 1;
        }

        if($request->check_avatar !== NULL){
            $state->avatar = $request->check_avatar;
        }else {
            $state->avatar = 0;
        }
        if($request->check_banner !== NULL){
            $state->banner = $request->check_banner;
        }else {
            $state->banner = 0;
        }
        if($request->check_logo !== NULL){
            $state->logo = 1;
        } else{
            $state->logo = 0;
        }
        if($request->front_style !== NULL){
            $profile->front_style = 'dark';
        } else{
            $profile->front_style = 'light';
        }
        if($request->check_firstname !== NULL){
            $state->firstname = $request->check_firstname;
        }else {
            $state->firstname = 0;
        }
        if($request->firstname){
            $profile->firstname = $request->firstname;
        }
        if($request->check_lastname !== NULL){
            $state->lastname = $request->check_lastname;
        }else {
            $state->lastname = 0;
        }
        if($request->lastname){
            $profile->lastname = $request->lastname;
        }
        if($request->check_email !== NULL){
            $state->email = $request->check_email;
        }else {
            $state->email = 0;
        }
        if($request->email){
            $profile->email = $request->email;
        }
        if($request->check_company !== NULL){
            $state->company = $request->check_company;
        }else {
            $state->company = 0;
        }
        if($request->company){
            $profile->company = $request->company;
        }
        if($request->check_jobTitle !== NULL){
            $state->jobTitle = $request->check_jobTitle;
        }else {
            $state->jobTitle = 0;
        }
        if($request->jobTitle){
            $profile->jobTitle = $request->jobTitle;
        }
        if($request->check_age !== NULL){
            $state->age = $request->check_age;
        }else {
            $state->age = 0;
        }
        if($request->age){
            $profile->age = $request->age;
        }
        if($request->check_website !== NULL){
            $state->website = $request->check_website;
        }else {
            $state->website = 0;
        }
        if($request->website){
            $profile->website = $request->website;
        }
        if($request->check_notes !== NULL){
            $state->notes = $request->check_notes;
        }else {
            $state->notes = 0;
        }
        if($request->notes){
            $profile->notes = $request->notes;
        }
        // Contact
        if($request->check_mobileWork !== NULL){
            $state->mobileWork = $request->check_mobileWork;
        }else {
            $state->mobileWork = 0;
        }
        if($request->mobileWork){
            $profile->mobileWork = $request->mobileWork;
        }
        if($request->check_mobile !== NULL){
            $state->mobile = $request->check_mobile;
        }else {
            $state->mobile = 0;
        }
        if($request->mobile){
            $profile->mobile = $request->mobile;
        }
        if($request->check_addressLine1 !== NULL){
            $state->addressLine1 = $request->check_addressLine1;
        }else {
            $state->addressLine1 = 0;
        }
        if($request->addressLine1){
            $profile->addressLine1 = $request->addressLine1;
        }
        if($request->check_city !== NULL){
            $state->city = $request->check_city;
        }else {
            $state->city = 0;
        }
        if($request->city){
            $profile->city = $request->city;
        }
        if($request->check_postalCode !== NULL){
            $state->postalCode = $request->check_postalCode;
        }else {
            $state->postalCode = 0;
        }
        if($request->postalCode){
            $profile->postalCode = $request->postalCode;
        }
        if($request->check_country !== NULL){
            $state->country = $request->check_country;
        }else {
            $state->country = 0;
        }
        if($request->country){
            $profile->country = $request->country;
        }
        // Buttons
        if($request->check_facebook !== NULL){
            $state->facebook = $request->check_facebook;
        }else {
            $state->facebook = 0;
        }
        if($request->facebook){
            $profile->facebook = $request->facebook;
        }
        if($request->check_instagram !== NULL){
            $state->instagram = $request->check_instagram;
        }else {
            $state->instagram = 0;
        }
        if($request->instagram){
            $profile->instagram = $request->instagram;
        }
        if($request->check_twitter !== NULL){
            $state->twitter = $request->check_twitter;
        }else {
            $state->twitter = 0;
        }
        if($request->twitter){
            $profile->twitter = $request->twitter;
        }
        if($request->check_youTube !== NULL){
            $state->youTube = $request->check_youTube;
        }else {
            $state->youTube = 0;
        }
        if($request->youTube){
            $profile->youTube = $request->youTube;
        }
        if($request->check_linkedIn !== NULL){
            $state->linkedIn = $request->check_linkedIn;
        }else {
            $state->linkedIn = 0;
        }
        if($request->linkedIn){
            $profile->linkedIn = $request->linkedIn;
        }
        if($request->check_tikTok !== NULL){
            $state->tikTok = $request->check_tikTok;
        }else {
            $state->tikTok = 0;
        }
        if($request->tikTok){
            $profile->tikTok = $request->tikTok;
        }
        if($request->check_whatsApp !== NULL){
            $state->whatsApp = $request->check_whatsApp;
        }else {
            $state->whatsApp = 0;
        }
        if($request->whatsApp){
            $profile->whatsApp = $request->whatsApp;
        }
        // Video
        if($request->check_youtube_video !== NULL){
            $state->youtube_video = 1;
        } else{
            $state->youtube_video = 0;
        }
        if($request->youtube_video){
            $profile->whatsApp = $request->whatsApp;
        }
        if($file = $request->file('video_id')){
            if($file->getSize() <= 200000000) {
                if($profile->video){
                    File::delete(public_path('media/videos/' . $member->video->file));
                }
                $name = time() . $file->getClientOriginalName() ;
                $file->move('media/videos', $name);
                $video = Video::create(['file' => $name]);

                $profile->video_id = $video->id;
            } else{
                return redirect()->to(url()->previous() . "#videos")->withErrors(['video_error' => "Video is to large, you can only upload up to 200mb"]);
            }
        }
        // Message
        if($request->titleMessage){
            $profile->titleMessage = $request->titleMessage;
        }
        if($request->message){
            $profile->message = $request->message;
        }

        $state->update();
        $profile->update();

        Session::flash('flash_message', 'Member Successfully Updated');
        return redirect('/admin/');
    }
}
