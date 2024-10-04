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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id('receipt_id');
            $table->unsignedBigInteger('em_id');
            $table->float('all_price', precision: 53);
            $table->integer('count');
            $table->unsignedBigInteger('table_id');
            $table->timestamps();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->boolean('is_active');
            $table->foreign('em_id')->references('em_id')->on('employees');
            $table->foreign('table_id')->references('table_id')->on('tables');
            $table->foreign('member_id')->references('member_id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
