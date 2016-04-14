<?php

use Illuminate\Database\Seeder;

class DriverroutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('driverroutes')->delete();

        DB::table('driverroutes')->insert(array(
            'driverid' => '2',
            'routeid' => '1',
            'price' => '40.0',
            'capacity' => 'big',
            'offered' => '1',
        ));
        DB::table('driverroutes')->insert(array(
            'driverid' => '2',
            'routeid' => '2',
            'price' => '18.0',
            'capacity' => 'big',
            'offered' => '0',        ));
        DB::table('driverroutes')->insert(array(
            'driverid' => '2',
            'routeid' => '3',
            'price' => '10.0',
            'capacity' => 'big',
            'offered' => '1',        ));
        DB::table('driverroutes')->insert(array(
            'driverid' => '2',
            'routeid' => '4',
            'price' => '102.0',
            'capacity' => 'big',
            'offered' => '0',        ));
    }
}
