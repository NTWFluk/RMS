<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('receipt_id');
            $table->unsignedBigInteger('table_id');
            $table->integer('count');
            $table->timestamps();
            $table->boolean('is_active');
            $table->foreign('food_id')->references('food_id')->on('food');
            $table->foreign('receipt_id')->references('receipt_id')->on('receipts');
            $table->foreign('table_id')->references('table_id')->on('tables');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
