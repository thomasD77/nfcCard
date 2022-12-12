<?php

namespace App\Swap\Importer;

class StateImporter
{
    public function profileState($state, $var, $pos, $neg)
    {
        if($pos){
            $state->$var = 1;
        }
        if($neg){
            $state->$var = 0;
        }
    }
}
