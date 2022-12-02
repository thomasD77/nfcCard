<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Salfade\LoginTracker\Traits\HasLoginAttempts;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, HasLoginAttempts;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'billing_id',
        'avatar_id',
        'remarks',
        'testimonial_send',
        'loyal_id',
        'source_id',
        'archived',
        'member_id',
        'business',
        'reset_message'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }

    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function permissions()
    {
        return $this->roles->map->permissions->flatten()->pluck('name')->unique();
    }

    public function loyal()
    {
        return $this->belongsTo(Loyal::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function userToUrlImport(){
        return $this->belongsToMany(listUrl::class, 'user_listurl');
    }

}
