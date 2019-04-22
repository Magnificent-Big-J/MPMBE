<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create(
            [
                'name'=>'Princess Fiona Khanyisa Mnisi',
                'email'=>'fionaprincesj@gmail.com',
                'password'=>bcrypt('secret')
            ]
        );
    }
}
