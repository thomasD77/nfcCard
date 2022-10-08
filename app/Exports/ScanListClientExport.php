<?php

namespace App\Exports;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class ScanListClientExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        //
        $user = Auth::user();
        $member = Member::findOrFail($user->member_id);

        $contacts = \App\Models\Contact::with(['member'])
            ->where('member_id', $member->id)
            ->where('archived', 0)
            ->where('print', 1)
            ->select('id', 'name', 'email', 'phone')
            ->get();

        return $contacts;
    }
}
