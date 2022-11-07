<?php

namespace App\Swap\Filter;

use App\Models\Contact;
use App\Models\Member;

class AllCleanPrintAdmin
{

    public function cleanPrint($user)
    {
        $member = Member::where('id', $user->member_id)->first();
        $member->check_all_print_admin = 0;
        $member->update();

        foreach ($member->memberToContactPrint as $print){
            $print->delete();
        }
    }
}
