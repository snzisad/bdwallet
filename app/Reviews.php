<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = 'reviews';
    protected $guarded = ['_token'];
    protected $with = 'user';

    public function user(){
        return $this->hasOne(User::class, "id", "user_id");
    }
}
