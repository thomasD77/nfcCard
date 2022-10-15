<?php

namespace App\Swap\Filter;

use App\Models\Member;

class ToggleStatusAdmin
{
    public function toggleStatus(Member $member)
    {
        if($member->check_all_print_admin == 1) {
            $member->check_all_print_admin = 0;
        } else {
            $member->check_all_print_admin = 1;
        }
        $member->update();
    }
}
