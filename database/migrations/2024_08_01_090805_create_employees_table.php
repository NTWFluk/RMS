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
        Schema::create('employees', function (Blueprint $table) {
            $table->id('em_id');
            $table->string('prefix', length: 20);
            $table->string('frist_name', length: 100);
            $table->string('last_name', length: 100);
            $table->string('username', length: 100)->unique();
            $table->string('password', length: 100)->unique();
            $table->text('address');
            $table->string('line_id', length: 50);
            $table->string('facebook', length: 50);
            $table->string('email', length: 100)->unique();
            $table->date('birthday');
            $table->string('gender', length: 30);
            $table->string('img_file', length: 100);
            $table->char('phone_number', length: 10);
            $table->string('position', length: 15);
            $table->timestamps();
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
