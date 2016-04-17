<?php

use Illuminate\Database\Seeder;

class TripsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trips')->delete();

        DB::table('trips')->insert(array(
            'userid' => '3',
            'driverrouteid' => '1',
            'status' => '0',//requested
            'posterprice' => '40.0',
            'feedback' => "this is feedback",
            'requestdate' => \Carbon\Carbon::now(),
        ));

        DB::table('trips')->insert(array(
            'userid' => '3',
            'driverrouteid' => '2',
            'status' => '1',//accepted
            'posterprice' => '40.0',
            'feedback' => "this is feedback",
            'requestdate' => \Carbon\Carbon::now(),
            'startdate' => \Carbon\Carbon::now(),
        ));

        DB::table('trips')->insert(array(
            'userid' => '3',
            'driverrouteid' => '3',
            'status' => '2',//done
            'posterprice' => '40.0',
            'feedback' => "this is feedback",
            'requestdate' => \Carbon\Carbon::now(),
            'startdate' => \Carbon\Carbon::now(),
            'enddate' => \Carbon\Carbon::now(),
        ));

        DB::table('trips')->insert(array(
            'userid' => '3',
            'driverrouteid' => '4',
            'status' => '0',//requested
            'feedback' => "this is feedback",
            'posterprice' => '40.0',
            'requestdate' => \Carbon\Carbon::now(),
        ));

    }
}
