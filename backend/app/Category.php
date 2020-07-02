<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category', 'slug'];

    public function Article()
    {
        return $this->hasMany(Article::class); 
    }
}
