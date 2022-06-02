<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ListUrlExportView;
use App\Http\Controllers\Controller;
use App\Models\listUrl;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SheetGenerator extends Controller
{
    //Generate the URLS for the MEBER ID's & export EXCEL file
    public function sheetGenerator()
    {
        return Excel::download(new ListUrlExportView(), 'card-list.xlsx');
    }

    //Generate the URLS for the MEBER ID's & export PDF file
    public function sheetQRcodeGenerator()
    {
        $members = listUrl::all();
        $pdf = PDF::loadView('admin.members.code', compact('members'));
        return $pdf->download('card-details.pdf');
    }
}
