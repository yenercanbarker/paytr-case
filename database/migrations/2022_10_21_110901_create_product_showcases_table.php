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
        Schema::create('product_showcases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('showcase_id');

            $table->foreign('product_id')
                ->constrained()
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->foreign('showcase_id')
                ->constrained()
                ->references('id')
                ->on('showcases')
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
        Schema::dropIfExists('product_showcases');
    }
};