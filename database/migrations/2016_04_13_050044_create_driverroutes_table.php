<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverroutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driverroutes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driverid')->unsigned();
            $table->foreign("driverid")->references('id')->on('users');
            $table->integer("routeid")->unsigned();
            $table->foreign("routeid")->references('id')->on('routs');
            $table->float('price');
            $table->string('capacity');
            $table->boolean("offered");
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
        Schema::drop('driverroutes');
    }
}
