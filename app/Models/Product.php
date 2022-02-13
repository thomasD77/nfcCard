<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'value',
        'PID',
        'description',
        'short_description',
        'category_id',
        'stock',
        'condition',
        'published',
    ];
}
