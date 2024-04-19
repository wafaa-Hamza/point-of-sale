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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pos_id')->constrained()->cascadeOnDelete();
            $table->string('name',50);
            $table->string('name_loc',50);
            $table->string('item_img')->nullable();
            $table->decimal('cost')->default(0.00);
            $table->string('inv_store_code')->nullable();
            $table->string('inv_item_code')->nullable();
            $table->string('kitchen_printer')->nullable();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('sub_category_id')->unsigned()->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('item_categories')->cascadeOnDelete();
            $table->foreign('sub_category_id')->references('id')->on('item_sub_categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};