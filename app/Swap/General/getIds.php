<?php

namespace App\Swap\General;

class getIds
{
    public function idArray($data, $var)
    {
        $ids = [];
        foreach ($data as $item){
            $ids [] = $item->$var;
        }

        return $ids;
    }
}
