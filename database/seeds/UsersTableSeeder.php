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
        DB::table('users')->delete();

        DB::table('users')->insert(array(
            'name' => 'ben',
            'email'=> 'ben@gmail.com',
            'password'=> bcrypt('123456'),
            'type' => 0,
        ));
        DB::table('users')->insert(array(
            'name' => 'mick',
            'email'=> 'mick@gmail.com',
            'password'=> bcrypt('123456'),
            'type' => 1,
        ));
        DB::table('users')->insert(array(
            'name' => 'anna',
            'email'=> 'anna@gmail.com',
            'password'=> bcrypt('123456'),
            'type' => 2,
        ));
    }
}
