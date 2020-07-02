<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag', 'slug'];

    public function Article()
    {
        return $this->belongsToMany(Article::class);
    }
}
