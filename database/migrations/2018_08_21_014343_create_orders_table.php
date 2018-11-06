<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('orders', function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users');
        $table->text('books')->nullable();
        $table->string('shipping_method')->nullable();
        $table->string('shipping_name')->nullable();
        $table->string('shipping_country')->nullable();
        $table->string('shipping_city')->nullable();
        $table->string('shipping_address')->nullable();
        $table->string('shipping_phone')->nullable();
        $table->string('shipping_code')->nullable();
        $table->integer('subtotal')->default(0);
        $table->integer('discount')->default(0);
        $table->integer('taxes')->default(0);
        $table->integer('shipping')->default(0);
        $table->integer('total')->default(0);
        $table->string('pay_method')->nullable();
        $table->string('pay_status')->default('Pending');
        $table->string('pay_response')->nullable();
        $table->datetime('pay_date')->nullable();
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
      Schema::dropIfExists('orders');
    }
}
