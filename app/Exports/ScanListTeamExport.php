<?php

namespace App\Exports;

use App\Models\listUrl;
use App\Models\Member;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;


class ScanListTeamExport implements FromView
{
    public function view(): View
    {
        $users = User::where('team_id', Auth()->user()->team_id)->pluck('id');
        $members = Member::whereIn('user_id', $users)->pluck('id');

        $contacts = \App\Models\Contact::with(['member'])
            ->whereIn('member_id', $members)
            ->where('archived', 0)
            ->get();

        return view('admin.members.excel-contacts', [
            'contacts' => $contacts
        ]);
    }
}
