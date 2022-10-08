<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable =
        [
          'member_id',
          'name',
          'email',
          'phone',
          'message',
          'archived',
          'notes',
          'print'
        ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function contactStatus()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_contact');
    }

    public function sector()
    {
        return $this->belongsTo(JobFunction::class, 'sector_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function events()
    {
        return $this->hasMany(Location::class, 'contact_id');
    }

}
