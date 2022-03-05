<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;

class MemberCredentialCardExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $credentials = ['firstname', 'lastname', 'email', 'company', 'age', 'jobTitle', 'mobile', 'website'];
        $members = Member::query()
            ->where('archived', 0)
            ->select($credentials)
            ->get();

        return $members;
    }
}
