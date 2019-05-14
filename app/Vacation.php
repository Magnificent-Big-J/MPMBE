<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ExpenseData;
class Vacation extends Model
{
    protected $guarded = [];
    use ExpenseData;
    public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }
}
