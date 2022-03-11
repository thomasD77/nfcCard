<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    public function listurls()
    {
        return $this->hasMany(listUrl::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

}
