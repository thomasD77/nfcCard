<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable =
        [
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
            'avatar',
            'titleMessage',
            'message',
            'youtube_video',
            'banner_id',
            'video_id',
            'logo_id',
        ];

    protected $with = ['state'];

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }
    public function logo()
    {
        return $this->belongsTo(Logo::class);
    }
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
    public function state()
    {
        return $this->hasOne(State::class);
    }
}
