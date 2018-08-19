<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    protected $fillable = [
        'mount',
        'type',
        'user_id',
    ];
}
