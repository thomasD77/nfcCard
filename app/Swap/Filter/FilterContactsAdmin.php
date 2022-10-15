<?php

namespace App\Swap\Filter;
use App\Models\Contact;

class FilterContactsAdmin
{
    public function filterNoDate($member, $name, $pagination)
    {
        return Contact::with(['member', 'contactStatus'])
            ->where('archived', 0)
            ->where('member_id', $member->id)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->simplePaginate($pagination);
    }

    public function filterWithDate($member, $month, $year, $pagination, $name)
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

    public function filterWithDateDay($member, $month, $year, $day, $pagination, $name)
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

    public function filterNoDatePaginate($members, $name, $pagination)
    {
        return Contact::with(['member', 'contactStatus'])
            ->where('archived', 0)
            ->whereIn('member_id', $members)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->simplePaginate($pagination);
    }

    public function filterWithDatePaginate($members, $month, $year, $pagination, $name)
    {
        return Contact::with(['member'])
            ->where('archived', 0)
            ->whereIn('member_id', $members)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->simplePaginate($pagination);
    }

    public function filterWithDateDayPaginate($members, $month, $year, $day, $pagination, $name)
    {
        return Contact::with(['member', 'contactStatus'])
            ->where('archived', 0)
            ->whereIn('member_id', $members)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereDay('created_at', $day)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->simplePaginate($pagination);
    }

    public function filterNoDateArray($members, $name)
    {
        return Contact::with(['member', 'contactStatus'])
            ->where('archived', 0)
            ->whereIn('member_id', $members)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->get();
    }

    public function filterWithDateArray($members, $month, $year, $name)
    {
        return Contact::with(['member'])
            ->where('archived', 0)
            ->whereIn('member_id', $members)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->get();
    }

    public function filterWithDateDayArray($members, $month, $year, $day, $name)
    {
        return Contact::with(['member', 'contactStatus'])
            ->where('archived', 0)
            ->whereIn('member_id', $members)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereDay('created_at', $day)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->latest()
            ->get();
    }
}
