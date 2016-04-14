<?php

use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('routs')->delete();

        DB::table('routs')->insert(array(
            'start' => 'Nelson',
            'end' => 'Christchurch',
        ));
        DB::table('routs')->insert(array(
            'start' => 'Christchurch',
            'end' => 'Invercargile',
        ));
        DB::table('routs')->insert(array(
            'start' => 'Christchurch',
            'end' => 'Wanaka',
        ));
        DB::table('routs')->insert(array(
            'start' => 'Wanaka',
            'end' => 'Queenstown',
        ));
    }
}
