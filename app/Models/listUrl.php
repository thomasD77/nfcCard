<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listUrl extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'memberURL',
        'memberQRcode',
        'material_id',
        'package_id',
        'custom_QR_url',
        'print',
        'reservation',
        'image'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}
