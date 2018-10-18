<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    protected $table = 'gateway';
    protected $guarded = ['_token'];

    protected $with = 'currency';

    public function currency(){
        return $this->hasOne(BalanceType::class, "id", "type");
    }
}
