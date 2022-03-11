<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listUrl extends Model
{
    use HasFactory;

    protected $fillable = [
        'memberURL',
        'memberQRcode',
        'material_id',
        'package_id'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }



}
