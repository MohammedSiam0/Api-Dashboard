<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name', 45);
        $table->string('description', 100);
        $table->float('price');
        $table->integer('stock')->unsigned();
        $table->enum('status', ['Visible', 'InVisible'])->default('Visible');

        // $table->unsignedBigInteger('sub_category_id');
        $table->foreignId('sub_category_id');
        $table->foreign('sub_category_id')->on('sub_categories')->references('id');

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
        Schema::dropIfExists('products');
    }
}
