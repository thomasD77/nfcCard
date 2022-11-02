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

        $count = Contact::with(['member'])
            ->where('member_id', $member->id)
            ->where('archived', 0)
            ->count();

        $count_contacts = Contact::with(['member'])
            ->where('member_id', $member->id)
            ->where('archived', 0)
            ->where('print', 0)
            ->count();

        if($count == $count_contacts){
            $contacts = Contact::with(['member'])
                ->where('member_id', $member->id)
                ->where('archived', 0)
                ->select('id', 'name', 'email', 'phone', 'message', 'created_at')
                ->get();
        }else {
            $contacts = Contact::with(['member'])
                ->where('member_id', $member->id)
                ->where('archived', 0)
                ->where('print', 1)
                ->select('id', 'name', 'email', 'phone', 'message', 'created_at')
                ->get();
        }

        //Reset the contact prints
        foreach ($contacts as $contact){
            $contact->print = 0;
            $contact->update();
        }
        //Reset check all checkbox member
        $member->check_all_print_client = 0;
        $member->update();

        return $contacts;
    }
}
