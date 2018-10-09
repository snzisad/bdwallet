<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeHistory extends Model
{
    protected $table = 'exchange_history';

    protected $guarded = ['_token'];
}
