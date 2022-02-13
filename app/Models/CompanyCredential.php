<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCredential extends Model
{
    use HasFactory;

    protected $fillable = [
          'firstname',
          'lastname',
          'companyName',
          'address',
          'zip',
          'city',
          'country',
          'phone',
          'email',
          'mobile',
          'tagline',
          'url',
          'remarks',
          'facebook',
          'instagram',
          'twitter',
          'linkedin',
          'VAT',
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
