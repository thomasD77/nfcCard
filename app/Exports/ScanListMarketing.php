<?php

namespace App\Exports;

use App\Models\listUrl;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ScanListMarketing implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $members = listUrl::query()
            ->where('print', 1)
            ->pluck('member_id');

        $users = User::whereIn('member_id', $members)->select('name', 'email')->get();

        $settings = listUrl::select(['id', 'print'])->get();
        foreach ($settings as $member){
            $member->print = 0;
            $member->update();
        }

        return $users;
    }
}
