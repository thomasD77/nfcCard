<?php

namespace App\Swap\Importer;

use App\Models\listUrl;
use App\Models\Member;
use App\Models\Team;
use App\Models\URL;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountCreateImporter
{
    public function create(listUrl $url, Team $team, $email, $password, $explode_email)
    {
        $url_browser = URL::first()->url;

        $user = User::create([
            'name' => $team->name,
            'email' => $explode_email,
            'password' => Hash::make($password),
        ]);

        DB::table('user_role')->insert([
            'user_id' => $user->id,
            'role_id' => $url->role_id,
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),]);

        $member = new Member();
        $faker = Factory::create();
        //Save member settings
        $member->user_id = $user->id;
        $member->email = $user->email;
        $member->card_id = $url->card_id;
        $member->memberURL = $url_browser . '/?' . $url->card_id;
        $member->memberQRcode = $url_browser . '/QRcode'. '/' . $url->card_id;
        $member->material_id = $url->material_id;
        $member->package_id = $url->package_id;
        $member->titleMessage = "Thank you for this amazing SWAP";
        $member->referral = '#' . $faker->unique()->numberBetween($min = 10, $max = 100) . '-' . $faker->unique()->numberBetween($min = 10000, $max = 100000);
        $member->save();

        //Make card state connection
        DB::table('states')->insert([
            'member_id'=> $member->id,
        ]);

        //Make card setting connection
        DB::table('settings')->insert([
            'member_id'=> $member->id,
        ]);

        //Connect User with member
        $user->member_id = $member->id;
        $user->team_id = $url->team_id;
        $user->business = $url->business;
        $user->is_company = $url->is_company;
        $user->is_importer = $url->is_importer;
        $user->email_verified_at = now();
        $user->save();

        //Connect ListURl with Member
        $url->member_id = $member->id;
        $url->is_admin_generated = 1;
        $url->save();

        Auth()->user()->userToUrlImport()->detach($url->id);
    }
}
