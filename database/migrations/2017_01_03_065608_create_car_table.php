<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create car table
        Schema::create('cars',function (Blueprint $table)
        {
            $table->increments('uid');
            $table->string('sim',15);
            $table->string('license',15);
            $table->string('type',32);
            $table->smallInteger('busload')->unsighed()->default(10);
            $table->datetime('locatetime')->default('1991-11-22 00:00:00');
            $table->datetime('recordtime')->default('1991-11-22 00:00:00');
            $table->decimal('latitude',9,6);
            $table->decimal('longitude',9,6);
            $table->unsignedSmallInteger('speed');
            $table->unsignedSmallInteger('angle');
            $table->float('mile');
            $table->char('state',1)->default('0');
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
        Schema::drop('cars');
    }
}
