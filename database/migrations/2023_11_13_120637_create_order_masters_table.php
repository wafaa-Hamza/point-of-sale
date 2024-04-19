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
                                                                                                            
        Schema::create('order_masters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pos_id')->constrained()->cascadeOnDelete();
            $table->dateTime('order_date');
            $table->string('order_no',60);
            $table->string('prefix',20);
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('table_no')->unsigned()->nullable();
            $table->string('room_no',10)->nullable();
            $table->bigInteger('guest_id')->nullable();
            $table->double('gross_amount')->defaault('0.00');
            $table->double('discount_amount')->defaault('0.00');
            $table->double('service_charge')->defaault('0.00');
            $table->double('taxes_amount')->defaault('0.00');
            $table->double('paid_amount')->defaault('0.00');
            $table->boolean('is_multi_payment')->defaault(false);
            $table->boolean('is_cancel')->defaault(false);
            $table->bigInteger('cancel_by')->unsigned()->nullable();
            $table->dateTime('cancel_at')->nullable();
            $table->boolean('fo_post')->default(false);
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->nullable();
            $table->bigInteger('finish_by')->unsigned()->nullable();
            $table->string('sys_ip',70)->nullable();
            $table->string('guest_name',50)->nullable();
            $table->integer('no_of_guest')->default(1);
            $table->foreignId('waiter_id')->constrained()->cascadeOnDelete()->nullable();
            $table->string('qr_code')->nullable();
            $table->timestamps();

            $table->foreign('table_no')->references('id')->on('tables')->cascadeOnDelete();
            $table->foreign('cancel_by')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('finish_by')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('last_updated_by')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_masters');
    }
};
