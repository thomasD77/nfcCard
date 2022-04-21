<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;

class ScanListExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $contacts = Contact::where('archived', 0)
            ->select('id', 'name', 'email', 'phone')
            ->get();

        return $contacts;
    }
}
