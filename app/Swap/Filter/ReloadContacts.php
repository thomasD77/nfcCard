<?php

namespace App\Swap\Filter;

use App\Models\Contact;
use App\Models\Member;
use App\Models\User;

class ReloadContacts
{
    public function reload(Member $member, Contact $contact)
    {
        $hasPrint = $member->memberToContactPrint()->where('contact_id', $contact->id)->exists();
        if($hasPrint) {
            $member->memberToContactPrint()->detach($contact->id);
        }
    }
}
