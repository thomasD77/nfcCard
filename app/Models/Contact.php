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
            'notes'
        ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function contactStatus()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

}
