<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
        'VAT',
        'phone',
        'ambassador',
        'description'
    ];

    public function teamAddress()
    {
        return $this->hasOne(TeamAddress::class);
    }
}
