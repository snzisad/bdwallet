<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletDeposit extends Model
{
    protected $table = 'wallet_deposit';
    protected $guarded = ['_token'];
    protected $with = ['wallet', 'user'];

    public function wallet()
    {
        return $this->hasOne(Gateway::class, "name", "wallet_id");
    }

    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
}
