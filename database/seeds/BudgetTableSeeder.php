<?php

use Illuminate\Database\Seeder;

class BudgetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $budgets = array(
            array('budget'=>'23000','income'=>'3000','saving'=>'2000','budget_date'=>'2019-01-30','user_id'=>1),
            array('budget'=>'22000','income'=>'35000','saving'=>'50000','budget_date'=>'2019-02-28','user_id'=>1),
            array('budget'=>'21000','income'=>'40000','saving'=>'8000','budget_date'=>'2019-03-30','user_id'=>1),
            array('budget'=>'24000','income'=>'40000','saving'=>'10000','budget_date'=>'2019-04-30','user_id'=>1),
        );

        foreach ($budgets as $budget){
            \App\Budget::create($budget);
        }
    }
}
