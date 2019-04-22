<?php

use Illuminate\Database\Seeder;

class ExpenseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expenses = array(
            array('expense'=>'Car Insurance','amount'=>'1523','status'=>'Paid','user_id'=>1,'category_id'=>10,'expense_date'=>\Carbon\Carbon::now()),
            array('expense'=>'House Holds Families','amount'=>'2000','status'=>'Paid','user_id'=>1,'category_id'=>2,'expense_date'=>\Carbon\Carbon::now()),
            array('expense'=>'Food and Groceries','amount'=>'1500','status'=>'Outstanding','user_id'=>1,'category_id'=>7,'expense_date'=>\Carbon\Carbon::now()),
            array('expense'=>'Helper','amount'=>'800','status'=>'Onprogress','user_id'=>1,'category_id'=>10,'expense_date'=>\Carbon\Carbon::now()),
            array('expense'=>'Car','amount'=>'5000','status'=>'Paid','user_id'=>1,'category_id'=>10,'expense_date'=>\Carbon\Carbon::now()),
            array('expense'=>'Petrol','amount'=>'3000','status'=>'Paid','user_id'=>1,'category_id'=>6,'expense_date'=>\Carbon\Carbon::now()),
            array('expense'=>'Medical Aid','amount'=>'5000','status'=>'','user_id'=>1,'category_id'=>5,'expense_date'=>\Carbon\Carbon::now()),
            array('expense'=>'Pension Fund','amount'=>'2000','status'=>'','user_id'=>1,'category_id'=>8,'expense_date'=>\Carbon\Carbon::now()),
        );

        foreach ($expenses as $expense){
            \App\Expense::create($expense);
        }
    }
}
