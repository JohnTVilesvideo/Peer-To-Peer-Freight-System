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
        
        User::create(array(
            'name' => 'ben',
            'email'=> 'ben@gmail.com',
            'password'=> Hash::make('l19911227'),
            'type' => 0,
        ));
        User::create(array(
            'name' => 'mick',
            'email'=> 'mick@gmail.com',
            'password'=> Hash::make('l19911227'),
            'type' => 1,
        ));
        User::create(array(
            'name' => 'anna',
            'email'=> 'anna@gmail.com',
            'password'=> Hash::make('l19911227'),
            'type' => 2,
        ));
    }
}
