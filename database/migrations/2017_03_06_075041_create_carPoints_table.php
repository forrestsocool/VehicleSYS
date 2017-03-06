<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create car table
        Schema::create('carsPts',function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('carID');
            $table->datetime('locatetime')->default('1991-11-22 00:00:00');
            $table->decimal('latitude',13,10);
            $table->decimal('longitude',13,10);
            $table->unsignedSmallInteger('speed');
            $table->unsignedSmallInteger('angle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
