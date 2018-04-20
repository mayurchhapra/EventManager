<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public $table = 'user';

    protected $fillable = [
        'name', 'email', 'password','contact','gender','date_of_birth','DP',
    ];
}
