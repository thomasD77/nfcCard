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

    protected $package;


    function __construct($package)
    {
        $this->package = $package;
    }


    public function collection()
    {
        //
        if($this->package == "landingpageDefault" ){
            $package = 'memberURL';
        }

        if($this->package == "landingpageCustom" ){
            $package = 'memberCustomURL';
        }

        if($this->package == "vCard" ){
            $package = 'membervCard';
        }

        if($this->package == "No package selected" ){
            $package = 'id';
        }


        $members = Member::query()
            ->where('archived', 0)
            ->where('id', '!=', 1)
            ->select($package)
            ->get();

        return $members;
    }

}
