<?php

namespace App\Exports;


use App\Models\listUrl;
use App\Models\Member;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MemberUrlExport implements FromView
{
    public function view(): View
    {
        $members = listUrl::query()
            ->where('print', 1)
            ->select([
                'card_id',
                'memberURL',
                'material_id',
                'role_id',
                'business',
                'image',
                'reservation'
            ])
            ->get();

        $settings = listUrl::select(['id', 'print'])->get();
        foreach ($settings as $member){
            $member->print = 0;
            $member->update();
        }

        return view('admin.members.excel', [
            'members' => $members
        ]);
    }
}
