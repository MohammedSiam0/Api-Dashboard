<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_information', function (Blueprint $table) {
            $table->id();
            $table->string('bar_code', 20);
            $table->float('purchasing_price'); // سعر الشراء purchasing_price  - price
            $table->mediumInteger('purchased_count');  //تم شراؤها  purchased_count  - stock

            // $table->unsignedBigInteger('product_id')->unique();
            $table->foreignId('product_id');
            $table->foreign('product_id')->on('products')->references('id');

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
        Schema::dropIfExists('product_information');
    }
}
