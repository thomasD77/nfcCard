<?php

namespace App\Swap\Filter;

class getIds
{
    public function getArrayIds($values)
    {
        $ids = [];
        foreach ($values as $item) {
            $ids [] = $item->id;
        }
        return $ids;
    }
}
