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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('account_id');
            $table->string('name', length: 100);
            $table->float('price', precision: 53);
            $table->integer('month');
            $table->unsignedBigInteger('ac_type_id');
            $table->timestamps();
            $table->boolean('is_active');
            $table->foreign('ac_type_id')->references('ac_type_id')->on('account_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
