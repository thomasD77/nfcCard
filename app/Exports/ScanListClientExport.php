<?php

namespace App\Exports;

use App\Models\Contact;
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
        $member = Member::findOrFail(Auth::user()->member_id);

        $contacts = \App\Models\Contact::with(['member'])
            ->where('member_id', $member->id)
            ->where('archived', 0)
            ->where('print', 1)
            ->select('id', 'name', 'email', 'phone')
            ->get();

        //Reset the contact prints
        $reset_contacts = Contact::all();
        foreach ($reset_contacts as $contact){
            $contact->print = 0;
            $contact->update();
        }
        //Reset check all checkbox member
        $member->check_all_print_client = 0;
        $member->update();

        return $contacts;
    }
}
