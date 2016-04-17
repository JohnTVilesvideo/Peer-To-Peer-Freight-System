<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("userid")->unsigned();
            $table->foreign("userid")->references("id")->on('users');
            $table->integer("driverrouteid")->unsigned();
            $table->foreign("driverrouteid")->references("id")->on('driverroutes');
            $table->float("posterprice");
            $table->integer("status");
            $table->longText("feedback");
            $table->date("requestdate");
            $table->date("startdate");
            $table->date("enddate");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trips');
    }
}
