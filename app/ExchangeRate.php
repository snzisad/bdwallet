<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    protected $table = 'exchange_rate';

    protected $guarded = ['_token'];

    public function scopeFromGateWayName($query){
    	return $query->join('gateway','exchange_rate.from_id','gateway.id')->select('gateway.name as from_gateway_name');
    }
}
