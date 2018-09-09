<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'identification',
        'user_id',
        'bank_id',
        'type'
    ];
}
