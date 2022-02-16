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


    public function collection()
    {
        //
        $members = Member::query()
            ->where('archived', 0)
            ->where('id', '!=', 1)
            ->select('id', 'memberURL')
            ->get();

        return $members;
    }
}
