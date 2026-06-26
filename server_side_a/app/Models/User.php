<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'username',
        'password',
    ];

//    casting the password as hashed
    protected function casts()
    {
        return [
            'password' => 'hashed'
        ];
    }
}
