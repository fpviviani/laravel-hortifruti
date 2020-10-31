<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuyProductTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buy_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('product_quantity');
            $table->integer('product_price');
            $table->foreign('buy_id')->references('id')->on('buys');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('buy_product');
    }
}
