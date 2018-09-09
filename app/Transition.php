<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    protected $fillable = [
        'mount',
        'type',
        'user_id',
        'from_bank_id',
        'from_account_id',
        'to_bank_id',
        'to_account_id'
    ];

}
