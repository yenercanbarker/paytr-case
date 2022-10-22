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
        Schema::create('cart_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('product_variation_id');
            $table->integer('count');

            $table->foreign('cart_id')
            ->constrained()
            ->references('id')
            ->on('carts')
            ->onDelete('cascade');

            $table->foreign('product_variation_id')
            ->constrained()
            ->references('product_variation_id')
            ->on('product_variations')
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
        Schema::dropIfExists('cart_products');
    }
};