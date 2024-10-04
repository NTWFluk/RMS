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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('stock_id');
            $table->string('name', length: 100);
            $table->unsignedBigInteger('s_unit_id');
            $table->float('amount', precision: 53);
            $table->unsignedBigInteger('s_type_id');
            $table->timestamps();
            $table->foreign('s_unit_id')->references('s_unit_id')->on('stock_units');
            $table->foreign('s_type_id')->references('s_type_id')->on('stock_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
