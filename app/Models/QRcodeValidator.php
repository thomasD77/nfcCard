<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRcodeValidator extends Model
{
    use HasFactory;

    protected $fillable = [
        'landingpaginaDefault',
        'landingpaginaCustom',
        'vCard'
    ];
}
