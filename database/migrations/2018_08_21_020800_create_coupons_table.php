<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('coupons', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('coupon')->unique();
        $table->datetime('valid_to_date')->nullable();
        $table->integer('valid_to_price')->nullable();
        $table->integer('discount_price')->nullable();
        $table->integer('discount_percent')->nullable();
        $table->boolean('free_shipping')->default(false);
        $table->boolean('active')->defaul(false);
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
        Schema::dropIfExists('coupons');
    }
}
