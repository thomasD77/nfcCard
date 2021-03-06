<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

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
            'city',
            'postalCode',
            'country',
            'jobTitle',
            'customField',
            'customText',
            'shortDescription',
            'notes',
            'facebook',
            'instagram',
            'linkedIn',
            'twitter',
            'youTube',
            'tikTok',
            'whatsApp',
            'website',
            'archived',
            'memberURL',
            'memberQRcode',
            'avatar',
            'print',
            'titleMessage',
            'message',
            'business'
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

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function state()
    {
        return $this->hasOne(State::class);
    }

}
