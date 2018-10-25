<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineStatus extends Model
{
    protected $table = 'online_status';
    protected $guarded = ['_token'];

    public function user(){
        $this->hasOne(User::class, "id", "user_id");
    }
}
