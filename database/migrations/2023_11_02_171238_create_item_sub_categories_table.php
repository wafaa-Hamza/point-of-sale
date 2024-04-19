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
        Schema::create('item_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pos_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('category_id')->unsigned();
            $table->string('name', 50);
            $table->string('name_loc', 50);
            $table->string('color')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('item_categories')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_sub_categories');
    }
};
