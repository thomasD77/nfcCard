<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vCard extends Model
{
    use HasFactory;

    public function vCard($id)
    {
        // define vcard
        $vcard = new \JeroenDesloovere\VCard\VCard();

        $member = Member::findOrfail($id);

        // define variables
        $lastname = $member->lastname;
        $firstname = $member->firstname;
        $additional = '';
        $prefix = '';
        $suffix = '';

        // add personal data
        $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);
        $vcard->addBirthday($member->age);

        // add work data
        $vcard->addCompany($member->company);
        $vcard->addJobtitle($member->jobTitle);
        $vcard->addEmail($member->email);
        $vcard->addPhoneNumber($member->mobile );
        $vcard->addAddress(null, null, $member->addressLine1, $member->city, null, $member->postalCode, $member->country);
        $vcard->addURL($member->website);
        //$vcard->addPhoto($member->avatar);
        $vcard->addPhoto($member->avatar ? asset('card/avatars/' . $member->avatar) : asset('assets/front/img/avatar-2.svg'));
        $vcard->addNote($member->notes);


        // return vcard as a download
        return $vcard->download();
    }
}
