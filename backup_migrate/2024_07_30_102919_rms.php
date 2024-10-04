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
        //
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        
        Schema::create('employee', function (Blueprint $table) {
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
            $table->char('phone_nember', length: 10);
            $table->string('position', length: 15);
            $table->timestamps();
            $table->boolean('is_active');
        });

        Schema::create('member', function (Blueprint $table) {
            $table->id('member_id');
            $table->string('prefix', length: 20);
            $table->string('frist_name', length: 100);
            $table->string('last_name', length: 100);
            $table->text('address');
            $table->string('email', length: 100)->unique();
            $table->string('gender', length: 30);
            $table->char('phone_nember', length: 10);
            $table->timestamps();
            $table->boolean('is_active');
        });

        Schema::create('stock_type', function (Blueprint $table) {
            $table->id('s_type_id');
            $table->string('name', length: 100);
        });

        Schema::create('stock_unit', function (Blueprint $table) {
            $table->id('s_unit_id');
            $table->string('name', length: 100);
        });

        Schema::create('table', function (Blueprint $table) {
            $table->id('table_id');
            $table->integer('count');
            $table->boolean('is_active');
        });

        Schema::create('food_type', function (Blueprint $table) {
            $table->id('f_type_id');
            $table->string('name', length: 100);
        });

        Schema::create('account_type', function (Blueprint $table) {
            $table->id('ac_type_id');
            $table->string('name', length: 100);
        });

        Schema::create('stock', function (Blueprint $table) {
            $table->id('stock_id');
            $table->string('name', length: 100);
            $table->unsignedBigInteger('s_unit_id');
            $table->float('amount', precision: 53);
            $table->unsignedBigInteger('s_type_id');
            $table->timestamps();
            $table->foreign('s_unit_id')->references('s_unit_id')->on('stock_unit');
            $table->foreign('s_type_id')->references('s_type_id')->on('stock_type');
        });

        Schema::create('stock_detail', function (Blueprint $table) {
            $table->id('stock_detail_id');
            $table->unsignedBigInteger('stock_id');
            $table->float('amount', precision: 53);
            $table->timestamps();
            $table->foreign('stock_id')->references('stock_id')->on('stock');
        });

        Schema::create('account', function (Blueprint $table) {
            $table->id('account_id');
            $table->string('name', length: 100);
            $table->float('price', precision: 53);
            $table->integer('month');
            $table->unsignedBigInteger('ac_type_id');
            $table->timestamps();
            $table->boolean('is_active');
            $table->foreign('ac_type_id')->references('ac_type_id')->on('account_type');
        });

        Schema::create('receipt', function (Blueprint $table) {
            $table->id('receipt_id');
            $table->unsignedBigInteger('em_id');
            $table->float('all_price', precision: 53);
            $table->integer('count');
            $table->unsignedBigInteger('table_id');
            $table->timestamps();
            $table->unsignedBigInteger('member_id');
            $table->boolean('is_active');
            $table->foreign('em_id')->references('em_id')->on('employee');
            $table->foreign('table_id')->references('table_id')->on('table');
            $table->foreign('member_id')->references('member_id')->on('member');
        });

        Schema::create('report', function (Blueprint $table) {
            $table->id('report_id');
            $table->unsignedBigInteger('receipt_id');
            $table->integer('score');
            $table->text('detail');
            $table->timestamps();
            $table->foreign('receipt_id')->references('receipt_id')->on('receipt');
        });

        Schema::create('food', function (Blueprint $table) {
            $table->id('food_id');
            $table->unsignedBigInteger('stock_id');
            $table->string('name', length: 100);
            $table->string('img_file', length: 100);
            $table->unsignedBigInteger('f_type_id');
            $table->float('amount', precision: 53);
            $table->timestamps();
            $table->boolean('is_active');
            $table->foreign('stock_id')->references('stock_id')->on('stock');
            $table->foreign('f_type_id')->references('f_type_id')->on('food_type');
        });

        Schema::create('order', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('receipt_id');
            $table->unsignedBigInteger('table_id');
            $table->integer('count');
            $table->timestamps();
            $table->boolean('is_active');
            $table->foreign('food_id')->references('food_id')->on('food');
            $table->foreign('receipt_id')->references('receipt_id')->on('receipt');
            $table->foreign('table_id')->references('table_id')->on('table');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('employee');
        Schema::dropIfExists('member');
        Schema::dropIfExists('stock_type');
        Schema::dropIfExists('stock_unit');
        Schema::dropIfExists('table');
        Schema::dropIfExists('food_type');
        Schema::dropIfExists('account_type');
        Schema::dropIfExists('stock');
        Schema::dropIfExists('stock_detail');
        Schema::dropIfExists('account');
        Schema::dropIfExists('receipt');
        Schema::dropIfExists('report');
        Schema::dropIfExists('food');
        Schema::dropIfExists('order');
    }
};
