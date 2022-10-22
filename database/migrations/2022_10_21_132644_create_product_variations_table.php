<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id('product_variation_id');
            $table->unsignedBigInteger('product_id');
            $table->string('title');
            $table->longText('description');
            $table->float('price');
            $table->integer('discount_percent')->nullable();
            $table->string('currency_code', 3);
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('category_id')
            ->constrained()
            ->references('id')
            ->on('categories')
            ->onDelete('cascade');

            $table->foreign('product_id')
            ->constrained()
            ->references('id')
            ->on('products')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variations');
    }
};