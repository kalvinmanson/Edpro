<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTopicPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('book_topic', function (Blueprint $table) {
        $table->integer('book_id')->unsigned()->index();
        $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        $table->integer('topic_id')->unsigned()->index();
        $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        $table->primary(['book_id', 'topic_id']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('book_topic');
    }
}
