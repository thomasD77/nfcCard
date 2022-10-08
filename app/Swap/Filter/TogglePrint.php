<?php

namespace App\Swap\Filter;

use App\Models\Contact;

class TogglePrint
{
    public function togglePrintStatus(Contact $contact)
    {
        if($contact->print == 1) {
            $contact->print = 0;
        } else {
            $contact->print = 1;
        }
        $contact->update();
    }
}
