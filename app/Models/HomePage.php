<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'input_1',
        'input_2',
        'input_3',
        'input_4',
        'input_5',
        'input_6',
        'input_7',
        'input_8',
        'input_9',
        'input_10',

        'text_1',
        'text_2',
        'text_3',
        'text_4',
        'text_5',
        'text_6',
        'text_7',
        'text_8',
        'text_9',
        'text_10',
        'text_11',

    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

}
