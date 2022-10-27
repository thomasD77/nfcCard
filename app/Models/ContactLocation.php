<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'location_id'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
