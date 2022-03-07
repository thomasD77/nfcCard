<?php

namespace App\Exports;

use App\Models\listUrl;
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
        $members = listUrl::query()
            ->select('id', 'memberURL')
            ->get();

        return $members;
    }

}
