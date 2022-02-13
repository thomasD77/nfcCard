<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use HasFactory;

    protected $fillable =  [
        'name',
        'email',
        'phone',
        'date',
        'approval',
        'archived',
        'description',
        ];
}
