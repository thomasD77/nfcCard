<?php

namespace App\Swap\Filter;

use App\Models\Contact;
use App\Models\Member;
use App\Models\User;

class TogglePrintAdmin
{
    public function togglePrintAdminStatus(Contact $contact, User $user)
    {
        //Check if print connection exist in pivot table
        $hasPrint = $user->member->memberToContactPrint()->where('contact_id', $contact->id)->exists();
        $member = Member::where('id', $user->member_id)->first();

        if($hasPrint) {
            $member->memberToContactPrint()->detach($contact->id);
        } else {
            $member->memberToContactPrint()->sync($contact->id, false);
        }
    }
}
