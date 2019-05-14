<?php

namespace App\Traits;


trait ExpenseData {



    public function scopeBudget(){
        $start = \Carbon\Carbon::now()->endOfMonth()->subMonth()->toDateString();
        $end =  \Carbon\Carbon::now()->endOfMonth()->toDateString();
        return $this->whereBetween('budget_date',[$start,$end]);
    }
    public function scopeTotalExpense(){
        $start = \Carbon\Carbon::now()->endOfMonth()->subMonth()->toDateString();
        $end =  \Carbon\Carbon::now()->endOfMonth()->toDateString();
        return $this->whereBetween('expense_date',[$start,$end]);
    }
    public function scopePreviousMonth(){
        $start =  \Carbon\Carbon::now()->startOfMonth()->subMonth()->toDateTimeString();
        $end =  \Carbon\Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateTimeString();
        return $this->whereBetween('expense_date',[$start,$end]);
    }

}