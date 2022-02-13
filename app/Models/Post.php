<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'postcategory_id',
        'user_id',
        'title',
        'slug',
        'body',
        'book',
        'archived',

        'seo_description',
        'seo_alternativeTitle',
        'seo_keywords',
        'seo_url',
        'seo_wordCount',
    ];

    public function postcategory()
    {
        return $this->belongsTo(PostCategory::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
