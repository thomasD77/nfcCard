<?php

namespace App\Exports;


use App\Models\listUrl;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ListUrlExportView implements FromView
{
    public function view(): View
    {
        return view('admin.members.excel', [
            'members' => listUrl::all()
        ]);
    }
}
