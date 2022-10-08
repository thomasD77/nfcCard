<?php

namespace App\Swap\Filter;

use App\Models\Member;

class ToggleStatusClient
{
    public function toggleStatus(Member $member)
    {
        if($member->check_all_print_client == 1) {
            $member->check_all_print_client = 0;
        } else {
            $member->check_all_print_client = 1;
        }
        $member->update();
    }
}
