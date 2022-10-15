<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\Member;
use App\Models\User;
use App\Swap\Members\TeamMembers;
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
        $user = Auth::user();
        $member = Member::findOrFail($user->member_id);

        //Get Admin team members (id's in array)
        $members = new TeamMembers();
        $members = $members->getTeamMembersInArrayPluckId($user);

        //General count
        $count = Contact::with('member')
           ->whereIn('member_id', $members)
           ->where('archived', 0)
           ->count();

        //Count for al the print values
        $count_contacts = Contact::with(['member'])
            ->whereIn('member_id', $members)
            ->where('archived', 0)
            ->where('print_admin', 0)
            ->count();

        // Check if we need a general print or selected
        if($count == $count_contacts){
            $contacts = Contact::with(['member'])
                ->whereIn('member_id', $members)
                ->where('archived', 0)
                ->select('id','name', 'email', 'phone', 'notes', 'created_at')
                ->get();
        }else {
            $contacts = Contact::with(['member'])
                ->whereIn('member_id', $members)
                ->where('archived', 0)
                ->where('print_admin', $user->id)
                ->select( 'id','name', 'email', 'phone', 'notes', 'created_at')
                ->get();
        }


        $contact_ids = [];
        foreach ($contacts as $contact) {
            $contact_ids [] = $contact->id;
        }
        //Reset the contact prints
        $printed_contacts = Contact::whereIn('id', $contact_ids)->get();
        foreach ($printed_contacts as $contact){
            $contact->print_admin = 0;
            $contact->update();
        }
        //Reset check all checkbox member
        $member->check_all_print_admin = 0;
        $member->update();

        return $contacts;
    }
}
