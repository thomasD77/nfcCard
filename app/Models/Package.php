<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
       'vCard',
       'landingpageDefault',
       'landingpageCustom' ,
    ];

    public function listurls()
    {
        return $this->hasMany(listUrl::class);
    }
}
