<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = ['role'];

    public function User()
    {
        return $this->hasMany(User::class);
    }
}
