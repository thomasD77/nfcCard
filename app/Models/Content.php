<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'title',
        'subtitle',
        'text',
        'second_text',
        'number',
        'extra',
        'file',
        'WxH',
    ];

}
