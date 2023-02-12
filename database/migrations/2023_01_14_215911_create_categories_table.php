<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            // $table->uuid('id');
            $table->id();
            // $table->bigInteger('id')->autoIncrement()->unsigned()->unique()->primary();
            $table->string('title', 45);
            $table->string('description', 100);
            $table->enum('status', ['Visible', 'InVisible'])->default('Visible');
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
        Schema::dropIfExists('categories');
    }
}
