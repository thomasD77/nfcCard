<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'firstname',
        'lastname',
        'email',
        'company',
        'jobTitle',
        'age',
        'shortDescription',
        'notes',
        'website',
        'mobileWork',
        'mobile',
        'addressLine1',
        'city',
        'postalCode',
        'country',
        'facebook',
        'instagram',
        'linkedIn',
        'twitter',
        'youTube',
        'tikTok',
        'whatsApp',
        'avatar',
        'customField',
        'youtube_video'

    ];

    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

}
