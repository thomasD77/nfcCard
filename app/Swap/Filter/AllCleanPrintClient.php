<?php

namespace App\Swap\Filter;

use App\Models\Contact;
use App\Models\Member;

class AllCleanPrintClient
{
    public function cleanPrint(Member $member)
    {
        $coll_member = Member::findOrFail($member->id)->first();
        $coll_member->check_all_print_client = 0;
        $coll_member->update();
    }
}
