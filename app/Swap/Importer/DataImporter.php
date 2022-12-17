<?php

namespace App\Swap\Importer;

class DataImporter
{
    public function profile($profile, $choose, $var, $data)
    {
        if($choose){
            if($var != ""){
                $profile->$var = $data;
            } else {
                $profile->$var = "";
            }
        }
    }
}
