<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'streetAddress',
        'city',
        'postalCode',
        'mobile',
        'email',
        'VAT',
        'google_calendar_id',
        'archived',
    ];
}
