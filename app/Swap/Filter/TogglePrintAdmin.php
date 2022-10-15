<?php

namespace App\Swap\Filter;

use App\Models\Contact;
use App\Models\User;

class TogglePrintAdmin
{
    public function togglePrintAdminStatus(Contact $contact, User $user)
    {
        if($contact->print_admin == $user->id) {
            $contact->print_admin = 0;
        } else {
            $contact->print_admin = $user->id;
        }
        $contact->update();
    }
}
