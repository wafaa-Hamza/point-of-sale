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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pos_id')->constrained()->cascadeOnDelete();
            $table->dateTime('order_date');
            $table->foreignId('order_master_id')->constrained()->cascadeOnDelete();
            $table->integer('srl_no');
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();
            $table->double('item_price')->default(0.00);
            $table->double('discount')->default(0.00);
            $table->double('qty')->default(1);
            $table->boolean('void')->default(false);
            $table->integer('printed')->default(0);
            $table->boolean('edit_flag')->default(false);
            $table->string('options')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
