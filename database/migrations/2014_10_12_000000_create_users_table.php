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
      Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('role')->default('User');
        $table->string('avatar')->nullable();
        $table->string('provider')->default('web');
        $table->string('country')->nullable();
        $table->string('city')->nullable();
        $table->string('address')->nullable();
        $table->string('phone')->nullable();
        $table->string('gender')->default('Male');
        $table->boolean('subscribed')->default(true);
        $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
