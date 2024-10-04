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
        Schema::create('food', function (Blueprint $table) {
            $table->id('food_id');
            $table->unsignedBigInteger('stock_id');
            $table->string('name', length: 100);
            $table->string('img_file', length: 100);
            $table->unsignedBigInteger('f_type_id');
            $table->float('amount', precision: 53);
            $table->timestamps();
            $table->boolean('is_active');
            $table->foreign('stock_id')->references('stock_id')->on('stocks');
            $table->foreign('f_type_id')->references('f_type_id')->on('food_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
