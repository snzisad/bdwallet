<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeHistory extends Model
{
    protected $table = 'exchange_history';
    protected $guarded = ['_token'];

    protected $with = ['send_from_data', 'send_to_data'];

    public function send_from_data(){
        return $this->hasOne(Gateway::class, "name", "from_id");
    }
    public function send_to_data(){
        return $this->hasOne(Gateway::class, "name", "to_id");
    }
}
