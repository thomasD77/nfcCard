<?php

namespace App\Exports;


use App\Models\listUrl;
use App\Models\Member;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ScanListStats implements FromView
{
    public function view(): View
    {
        $list_members = listUrl::query()
            ->where('print', 1)
            ->pluck('member_id');

        $members = Member::whereIn('id', $list_members)->get();

        $settings = listUrl::select(['id', 'print'])->get();
        foreach ($settings as $member){
            $member->print = 0;
            $member->update();
        }

        return view('admin.members.stats', [
            'members' => $members
        ]);
    }
}
