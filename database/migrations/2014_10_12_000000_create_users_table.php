<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create user table
//        Schema::create('users', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('username',32);
//            $table->string('account',32);
//            $table->string('password',60);
//            $table->rememberToken();
//            $table->unsignedInteger('addtime');
//            $table->tinyInteger('state')->unsigned()->default(1);
//        });
//
//        //create category table
//        Schema::create('tb_category', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name',32);
//            $table->unsignedInteger('count')->default(0);
//            $table->integer('uid'); //user id
//            $table->tinyInteger('state')->unsigned()->default(1);  // 1 stands for normal state 0 for deleted state
//        });
//
//        //create note content
//        Schema::create('tb_records', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('title',64);
//            $table->text('content')->nullable();
//            $table->integer('cid');   //note category id
//            $table->integer('uid');  //user id
//            $table->unsignedInteger('addtime')->default(0);
//            $table->tinyInteger('state')->unsigned()->default(1);  // 1 stands for normal state 0 for deleted state
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_category');
        Schema::dropIfExists('tb_records');
        Schema::dropIfExists('users');
    }
}
