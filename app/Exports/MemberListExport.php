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

    protected $landingpage;
    protected $vCard;

    function __construct($checkboxValidation) {

        $this->landingpage = $checkboxValidation['landingpage'];
        $this->vCard = $checkboxValidation['vCard'];

    }


    public function collection()
    {
        //

        if($this->landingpage == "1" && $this->vCard == "0"){
            $members = Member::query()
                ->where('archived', 0)
                ->where('id', '!=', 1)
                ->select('id', 'memberURL')
                ->get();
            return $members;
        }

        if($this->landingpage == "0" && $this->vCard == "1"){
            $members = Member::query()
                ->where('archived', 0)
                ->where('id', '!=', 1)
                ->select('id','memberVcard')
                ->get();
            return $members;
        }

        if($this->landingpage == "1" && $this->vCard == "1"){
            $members = Member::query()
                ->where('archived', 0)
                ->where('id', '!=', 1)
                ->select('id', 'memberURL', 'memberVcard')
                ->get();
            return $members;
        }

        if($this->landingpage == "0" && $this->vCard == "0"){
            $members = Member::query()
                ->where('archived', 0)
                ->where('id', '!=', 1)
                ->select('id',)
                ->get();
            return $members;
        }

    }
}
