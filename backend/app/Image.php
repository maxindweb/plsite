<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'name', 
        'images', 
        'alt', 
        'caption'
    ];

    public function Article()
    {
        return belongsToMany(Article::class);
    }

    public function user()
    {
        //
    }
}
