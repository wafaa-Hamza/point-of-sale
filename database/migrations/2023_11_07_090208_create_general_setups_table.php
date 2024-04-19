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
        Schema::create('general_setups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pos_id')->unsigned();
            $table->dateTime('pos_date');
            $table->boolean('is_inventory')->default(0);
            $table->boolean('is_kitchen_printer')->default(0);
            $table->bigInteger('pos_room_id')->unsigned()->nullable();
            $table->string('vat_number')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_setups');
    }
};
