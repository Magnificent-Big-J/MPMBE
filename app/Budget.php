<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ExpenseData;
class Budget extends Model
{
    use ExpenseData;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }
}
