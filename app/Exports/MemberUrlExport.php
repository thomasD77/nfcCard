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
        $ids = Member::where('print', 1)->select(['id'])->get();
        $members = listUrl::whereIn('member_id', $ids)->select('id', 'memberURL', 'material_id')
            ->get();

        $settings = Member::select(['id', 'print'])->get();
        foreach ($settings as $member){
            $member->print = 0;
            $member->update();
        }

        return view('admin.members.excel', [
            'members' => $members
        ]);
    }
}
