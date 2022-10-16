<?php

namespace App\Swap\Filter;
use App\Models\Contact;

class FilterContactsClient
{
    public function filterNoDate($member, $name)
    {
        return Contact::with(['member', 'contactStatus'])
            ->where('archived', 0)
            ->where('member_id', $member->id)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->get();
    }

    public function filterWithDate($member, $month, $year, $name)
    {
        return Contact::with(['member'])
            ->where('archived', 0)
            ->where('member_id', $member->id)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->get();
    }

    public function filterWithDateDay($member, $month, $year, $day, $name)
    {
        return Contact::with(['member', 'contactStatus'])
            ->where('archived', 0)
            ->where('member_id', $member->id)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereDay('created_at', $day)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->get();
    }

    public function filterNoDatePaginate($member, $name, $pagination)
    {
        return Contact::with(['member', 'contactStatus'])
            ->where('archived', 0)
            ->where('member_id', $member->id)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->simplePaginate($pagination);
    }

    public function filterWithDatePaginate($member, $month, $year, $pagination, $name)
    {
        return Contact::with(['member'])
            ->where('archived', 0)
            ->where('member_id', $member->id)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->simplePaginate($pagination);
    }

    public function filterWithDateDayPaginate($member, $month, $year, $day, $pagination, $name)
    {
        return Contact::with(['member', 'contactStatus'])
            ->where('archived', 0)
            ->where('member_id', $member->id)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereDay('created_at', $day)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->simplePaginate($pagination);
    }
}
