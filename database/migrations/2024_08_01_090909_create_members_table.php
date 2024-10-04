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
        Schema::create('members', function (Blueprint $table) {
            $table->id('member_id');
            $table->string('prefix', length: 20);
            $table->string('frist_name', length: 100);
            $table->string('last_name', length: 100);
            $table->text('address');
            $table->string('email', length: 100)->unique();
            $table->string('gender', length: 30);
            $table->char('phone_number', length: 10);
            $table->timestamps();
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
