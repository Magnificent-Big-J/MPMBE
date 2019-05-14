<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ExpenseData;
class Expense extends Model
{
    protected $guarded = [];
    use ExpenseData;
    public function category(){
        return $this->belongsTo(\App\Category::class,'category_id');
    }
    public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }
}
