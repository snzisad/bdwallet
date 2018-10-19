<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletWithdraw extends Model
{
    protected $table = 'wallet_withdraw';
    protected $guarded = ['_token'];
    protected $with = ['sent_wallet', 'receive_wallet', 'user'];

    public function sent_wallet()
    {
        return $this->hasOne(Gateway::class, "id", "from_id");
    }

    public function receive_wallet()
    {
        return $this->hasOne(Gateway::class, "id", "to_id");
    }

    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
}
