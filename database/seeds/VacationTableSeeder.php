<?php

use Illuminate\Database\Seeder;

class VacationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vacations = array(
            array('destination'=>'Thailand','start_date'=>'2019-12-21','end_date'=>'2019-12-28','adults'=>2,'childrens'=>0,'status'=>'Going','activities'=> serialize(array('Culture', 'Outdours','Relaxing','Romantic','Beaches','Historic Sites','Museums','Shopping','Wildlife')),'cost'=>'30000','user_id'=>1),
            array('destination'=>'Mauritius','start_date'=>'2019-05-03','end_date'=>'2019-05-06','adults'=>2,'childrens'=>1,'status'=>'New','activities'=> serialize(array('Culture', 'Outdours','Relaxing','Romantic','Beaches','Wildlife')),'cost'=>'20000','user_id'=>1),
            array('destination'=>'Durban','start_date'=>'2019-11-04','end_date'=>'2019-11-06','adults'=>2,'childrens'=>1,'status'=>'New','activities'=> serialize(array('Culture', 'Outdours','Relaxing','Romantic','Beaches','Wildlife','Museums')),'cost'=>'15000','user_id'=>1),
            array('destination'=>'Cape Town','start_date'=>'2019-08-19','end_date'=>'2019-08-19','adults'=>2,'childrens'=>1,'status'=>'New','activities'=> serialize(array('Culture', 'Outdours','Relaxing','Romantic','Beaches','Wildlife','Museums')),'cost'=>'20000','user_id'=>1),
        );

        foreach ($vacations as $vacation){
            \App\Vacation::create($vacation);
        }
    }
}
