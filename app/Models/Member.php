<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'user_id',
            'card_id',
            'package_id',
            'material_id',
            'firstname',
            'lastname',
            'company',
            'age',
            'email',
            'mobileWork',
            'mobile',
            'addressLine1',
            'addressLine2',
            'city',
            'postalCode',
            'country',
            'jobTitle',
            'shortDescription',
            'notes',
            'facebook',
            'instagram',
            'linkedIn',
            'twitter',
            'youTube',
            'tikTok',
            'whatsApp',
            'facebookMessenger',
            'website',
            'archived',
            'memberURL',
            'memberQRcode',
            'avatar'
        ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function listurl()
    {
        return $this->hasOne(listUrl::class);
    }
}
