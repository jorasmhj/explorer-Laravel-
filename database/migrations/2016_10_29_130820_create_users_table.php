<?php

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
        Schema::create('users',function(Blueprint $table){
          $table->increments('id');
          $table->timestamps();
          $table->string('email')->unique();
          $table->string('first_name');
          $table->string('last_name');
          $table->string('username');
          $table->string('password');
          $table->string('avatar')->default('default.jpg');
		  $table->string('cover_pic')->default('default-cover.jpg');
          $table->boolean('first_login')->default(1);
          $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
