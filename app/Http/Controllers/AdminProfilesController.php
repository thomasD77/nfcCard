<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Member;
use App\Models\Package;
use App\Models\Profile;
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
        $profiles = Profile::where('member_id', $id)->get();
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
        if($request->front_style !== NULL){
            $profile->front_style = 'dark';
        } else{
            $profile->front_style = 'light';
        }
        if($request->firstname){
            $profile->firstname = $request->firstname;
        }
        if($request->lastname){
            $profile->lastname = $request->lastname;
        }
        if($request->email){
            $profile->email = $request->email;
        }
        if($request->company){
            $profile->company = $request->company;
        }
        if($request->jobTitle){
            $profile->jobTitle = $request->jobTitle;
        }
        if($request->age){
            $profile->age = $request->age;
        }
        if($request->website){
            $profile->website = $request->website;
        }
        if($request->notes){
            $profile->notes = $request->notes;
        }
        // Contact
        if($request->mobileWork){
            $profile->mobileWork = $request->mobileWork;
        }
        if($request->mobile){
            $profile->mobile = $request->mobile;
        }
        if($request->addressLine1){
            $profile->addressLine1 = $request->addressLine1;
        }
        if($request->city){
            $profile->city = $request->city;
        }
        if($request->postalCode){
            $profile->postalCode = $request->postalCode;
        }
        if($request->country){
            $profile->country = $request->country;
        }
        // Buttons
        if($request->facebook){
            $profile->facebook = $request->facebook;
        }
        if($request->instagram){
            $profile->instagram = $request->instagram;
        }
        if($request->twitter){
            $profile->twitter = $request->twitter;
        }
        if($request->youTube){
            $profile->youTube = $request->youTube;
        }
        if($request->linkedIn){
            $profile->linkedIn = $request->linkedIn;
        }
        if($request->tikTok){
            $profile->tikTok = $request->tikTok;
        }
        if($request->whatsApp){
            $profile->whatsApp = $request->whatsApp;
        }
        // Video
        if($request->whatsApp){
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

        $profile->update();

        Session::flash('flash_message', 'Member Successfully Updated');
        return redirect('/admin/');
    }
}
