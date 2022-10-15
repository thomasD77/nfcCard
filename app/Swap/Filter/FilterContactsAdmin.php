<?php

namespace App\Swap\Filter;
use App\Models\Contact;

class FilterContactsAdmin
{
    public function filterNoDate($members, $name, $pagination)
    {
        return Contact::with(['member', 'contactStatus'])
            ->where('archived', 0)
            ->whereIn('member_id', $members)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->simplePaginate($pagination);
    }

    public function filterWithDate($members, $month, $year, $pagination)
    {
        return Contact::with(['member'])
            ->where('archived', 0)
            ->whereIn('member_id', $members)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->simplePaginate($pagination);
    }

    public function filterWithDateDay($members, $month, $year, $day, $pagination)
    {
        return Contact::with(['member', 'contactStatus'])
            ->where('archived', 0)
            ->whereIn('member_id', $members)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereDay('created_at', $day)
            ->simplePaginate($pagination);
    }
}
