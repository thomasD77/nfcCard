<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loyal extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'archived',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
