<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    protected $table = 'exchange_rate';
    protected $guarded = ['_token'];
    protected $with = ["from_gateway", "to_gateway"];

    public function from_gateway(){
        return $this->hasOne(Gateway::class, "id", "from_id");
    }

    public function to_gateway(){
        return $this->hasOne(Gateway::class, "id", "to_id");
    }
}
