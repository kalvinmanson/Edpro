<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('contacts', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('email');
        $table->string('country')->nullable();
        $table->string('city')->nullable();
        $table->string('address')->nullable();
        $table->string('phone')->nullable();
        $table->date('birthdate')->nullable();
        $table->string('document')->nullable();
        $table->string('subject')->nullable();
        $table->text('content')->nullable();
        $table->string('location')->nullable();
        $table->string('referer')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
