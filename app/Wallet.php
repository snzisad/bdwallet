<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallet';

    protected $fillable = [
        'user_id',
        'wallet_id', 
        'balance'
    ];

    protected $with = ['wallet', 'user'];

    public function wallet()
    {
        return $this->hasOne(Gateway::class, "id", "wallet_id");
    }

    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
}
