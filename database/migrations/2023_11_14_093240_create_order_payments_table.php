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
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pos_id')->unsigned();
            $table->dateTime('order_date');
            $table->bigInteger('order_master_id')->unsigned();
            $table->bigInteger('payment_type_id')->unsigned();
            $table->float('amount');
            $table->boolean('is_cash');
            $table->string('room_no')->nullable();
            $table->bigInteger('guest_id')->unsigned()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_payments');
    }
};
