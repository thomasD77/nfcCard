<?php

namespace App\Exports;

use App\Models\Member;
use App\Models\Profile;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class MemberCredentialCardExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $credentials = [
            'firstname',
            'lastname',
            'email',
            'company',
            'age',
            'jobTitle',
            'mobile',
            'website'
        ];

        $users = User::query()
            ->whereNull('archived')
            ->where('team_id', Auth()->user()->team_id)
            ->select('id')
            ->get();

        $members = Member::query()
            ->whereNull('archived')
            ->whereIn('user_id', $users)
            ->select('id')
            ->get();

        $profiles = Profile::query()
            ->where('active', 1)
            ->whereIn('member_id', $members)
            ->select($credentials)
            ->get();

        return $profiles;
    }
}
