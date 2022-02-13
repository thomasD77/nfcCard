<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'streetAddress1',
        'streetAddress2',
        'city',
        'postalCode',
        'VAT',
    ];

    public function clients()
    {
        return $this->HasMany(Client::class);
    }
}
