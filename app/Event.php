<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    public $table = 'events';
    protected $fillable = [
    	'user_id','task','date_of_event','disc',
    ];
}
