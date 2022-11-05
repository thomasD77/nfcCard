<?php

namespace App\Swap\Filter;

use App\Models\Member;
use Illuminate\Support\Facades\DB;

class ToggleStatusAdmin
{
    public function toggleStatus(Member $member, $contacts)
    {
        $ids = new getIds();

        if($member->check_all_print_admin == true) {
            $member->check_all_print_admin = 0;

            $ids = $ids->getArrayIds($member->memberToContactPrint);
            foreach ($ids as $contact) {
                $member->memberToContactPrint()->detach($contact);
            }
        } else {
            $member->check_all_print_admin = 1;

            $ids = $ids->getArrayIds($contacts);
            foreach ($ids as $contact) {
                $member->memberToContactPrint()->sync($contact, false);
            }
        }
        $member->update();
    }
}
