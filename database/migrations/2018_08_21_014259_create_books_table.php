<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('books', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('publisher_id');
      $table->foreign('publisher_id')->references('id')->on('publishers');
      $table->string('name');
      $table->string('slug')->unique();
      $table->string('picture')->nullable();
      $table->string('isbn')->nullable();
      $table->string('lang')->default('es');
      $table->integer('pages')->nullable();
      $table->integer('year')->nullable();
      $table->string('tags')->nullable();
      $table->string('format')->nullable();
      $table->integer('size_w')->default(0);
      $table->integer('size_h')->default(0);
      $table->integer('size_d')->default(0);
      $table->string('weight')->nullable();
      $table->text('description')->nullable();
      $table->longtext('content')->nullable();
      $table->text('content_table')->nullable();
      $table->string('preview')->nullable();
      $table->string('video')->nullable();
      $table->string('attachment')->nullable();
      $table->integer('stock')->default(0);
      $table->integer('price')->default(0);
      $table->integer('old_price')->default(0);
      $table->boolean('promo')->default(false);
      $table->float('rank')->default(4);
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
      Schema::dropIfExists('books');
  }
}
