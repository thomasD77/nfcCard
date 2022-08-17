<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
      'file'
    ];

    protected $uploads = '/media/banners/';

    public function getFileAttribute($banner)
    {
        return $this->uploads . $banner;
    }
}
