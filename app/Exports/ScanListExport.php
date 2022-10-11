<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class ScanListExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $member = Member::findOrFail(Auth::user()->member_id);

        $contacts = Contact::with(['member'])
            ->where('member_id', $member->id)
            ->where('archived', 0)
            ->select('id', 'name', 'email', 'phone', 'notes')
            ->get();

        return $contacts;
    }
}
