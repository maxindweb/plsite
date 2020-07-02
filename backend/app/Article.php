<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = 
    [
        'title',
        'slug',
        'thumbnail'
        ,'content',
        'attachment',
        'user_id',
        'category_id',
        'tag_id',
        'published',
        'publsihed_at'
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
}
