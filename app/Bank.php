<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'name' ,
        'description' ,
        'hash' ,
        'user_id' ,
    ];
}
