<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\Member;
use App\Models\User;
use App\Swap\Filter\getIds;
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
        $user = Auth::user();
        $member = Member::findOrFail($user->member_id);
        $ids = new getIds();

        //Get Admin team members (id's in array)
        $members = new TeamMembers();
        $members = $members->getTeamMembersInArrayPluckId($user);

        //General count
        $count = $member->memberToContactPrint()->where('archived', 0)->count();

        // Check if we need a general print or selected
        if($count == 0){
            $contacts = Contact::with(['member'])
                ->whereIn('member_id', $members)
                ->where('archived', 0)
                ->select('id','name', 'email', 'phone', 'message', 'notes' , 'created_at')
                ->get();
        }else {
            $contacts = $member->memberToContactPrint
                ->where('archived', 0);
        }

        $ids = $ids->getArrayIds($contacts);
        foreach ($ids as $contact) {
            $member->memberToContactPrint()->detach($contact);
        }

        //Reset check all checkbox member
        $member->check_all_print_admin = 0;
        $member->update();

        return $contacts;
    }
}
