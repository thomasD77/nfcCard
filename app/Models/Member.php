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
            'business',
            'youtube_video',
            'banner_id',
            'video_id',
            'logo_id',
            'check_all_print_client',
            'check_all_print_admin'
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

    public function listurl()
    {
        return $this->hasOne(listUrl::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function settings()
    {
        return $this->hasOne(Setting::class);
    }

    public function buttons()
    {
        return $this->hasMany(Button::class);
    }

    public function memberToContactPrint(){
        return $this->belongsToMany(Contact::class, 'member_contact');
    }

}
