<?php

namespace App\Swap\Importer;

use App\Models\listUrl;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AccountUpdateImporter
{
    public function update(listUrl $url, Team $team, $email, $password){
        $user = User::findOrFail($url->member->user->id);
        $user->name = $team->name;
        if(!$email){
            $user->email = $user->email;
        }else {
            $user->email = $email;
        }
        $user->password = Hash::make($password);
        $user->update();

        Auth()->user()->userToUrlImport()->detach($url->id);
    }
}
