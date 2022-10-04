<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = [
        'file'
    ];

    protected $uploads = '/media/logos/';

    public function getFileAttribute($avatar)
    {
        return $this->uploads . $avatar;
    }
}
