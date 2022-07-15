<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'number',
        'zip',
        'country',
        'city'
    ];
}
