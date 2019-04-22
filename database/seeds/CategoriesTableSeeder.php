<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            array('name'=>'Emergency Fund','status'=>'Active'),
            array('name'=>'Black Tax','status'=>'Active'),
            array('name'=>'Housing','status'=>'Active'),
            array('name'=>'Utilities','status'=>'Active'),
            array('name'=>'Health Care','status'=>'Active'),
            array('name'=>'Consumer Debt','status'=>'Active'),
            array('name'=>'Food and Groceries','status'=>'Active'),
            array('name'=>'Personal Care','status'=>'Active'),
            array('name'=>'Entertainment','status'=>'Active'),
            array('name'=>'Installment','status'=>'Active'),
        );

        foreach ($categories as $category){
            \App\Category::create($category);
        }
    }
}
