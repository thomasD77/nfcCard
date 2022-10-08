<?php

namespace App\Swap\Filter;
use App\Models\Contact;

class FilterContactsClient
{
    public function filterWithDate($member, $month, $year, $pagination)
    {
        return Contact::with(['member'])
            ->where('archived', 0)
            ->where('member_id', $member->id)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->simplePaginate($pagination);
    }

    public function filterWithDateDay($member, $month, $year, $day, $pagination)
    {
        return Contact::with(['member', 'contactStatus'])
            ->where('archived', 0)
            ->where('member_id', $member->id)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereDay('created_at', $day)
            ->simplePaginate($pagination);
    }

    public function filterNoDate($member, $name, $pagination)
    {
        return Contact::with(['member', 'contactStatus'])
            ->where('archived', 0)
            ->where('member_id', $member)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->simplePaginate($pagination);
    }
}
