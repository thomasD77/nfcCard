<?php

namespace App\Console\Commands;

use App\Models\Member;
use App\Models\Profile;
use Illuminate\Console\Command;

class syncProfiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:profiles';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $members = Member::all();

        foreach ($members as $member){
            $profile = new Profile();

            //Default values
            $profile->active = 1;
            $profile->profile_name = "Default";
            $profile->default = 1;

            $profile->front_style = $member->front_style;
            $profile->logo_id = $member->logo_id;
            $profile->avatar = $member->avatar;
            $profile->banner_id = $member->banner_id;
            $profile->video_id = $member->video_id;
            $profile->profile_views = $member->profile_views;

            $profile->firstname = $member->firstname;
            $profile->lastname = $member->lastname;
            $profile->email = $member->email;
            $profile->company = $member->company;
            $profile->jobTitle = $member->jobTitle;
            $profile->age = $member->age ? $member->age : now();
            $profile->shortDescription = $member->shortDescription;
            $profile->notes = $member->notes;
            $profile->website = $member->website;
            $profile->mobile = $member->mobile;
            $profile->mobileWork = $member->mobileWork;
            $profile->addressLine1 = $member->addressLine1;
            $profile->city = $member->city;
            $profile->postalCode = $member->postalCode;
            $profile->country = $member->country;
            $profile->facebook = $member->facebook;
            $profile->instagram = $member->instagram;
            $profile->linkedIn = $member->linkedIn;
            $profile->twitter = $member->twitter;
            $profile->youTube = $member->youTube;
            $profile->tikTok = $member->tikTok;
            $profile->whatsApp = $member->whatsApp;
            $profile->member_id = $member->id;

            $profile->state_id = $member->state_id;

            $profile->customField = $member->customField;
            $profile->customText = $member->customText;
            $profile->titleMessage = $member->titleMessage;
            $profile->message = $member->message;

            $profile->youtube_video = $member->youtube_video;

            $profile->save();
        }
    }
}
