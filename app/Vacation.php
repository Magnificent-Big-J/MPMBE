<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }
}
