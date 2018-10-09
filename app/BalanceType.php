<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalanceType extends Model
{
    protected $table = 'balance_type';
    protected $guarded = ['_token'];
}
