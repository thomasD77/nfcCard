<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use phpDocumentor\Reflection\Types\Collection;

class MemberListExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $landingpageDefault;
    protected $landingpageCustom;
    protected $vCard;
    protected $QRcode;

    function __construct($checkboxValidation)
    {
        $this->landingpageDefault = $checkboxValidation['landingpageDefault'];
        $this->landingpageCustom = $checkboxValidation['landingpageCustom'];
        $this->vCard = $checkboxValidation['vCard'];
        $this->QRcode = $checkboxValidation['QRcode'];
    }


    public function collection()
    {
        //
        $pages = ['id'];

        if($this->landingpageDefault == "1" ){
            $pages [] = 'memberURL';
        }

        if($this->landingpageCustom == "1" ){
            $pages [] = 'memberCustomURL';
        }

        if($this->vCard == "1" ){
            $pages [] = 'membervCard';
        }

        if($this->QRcode == "1" ){
            $pages [] = 'memberQRcode';
        }

        $members = Member::query()
            ->where('archived', 0)
            ->where('id', '!=', 1)
            ->select($pages)
            ->get();
        return $members;
    }

}
