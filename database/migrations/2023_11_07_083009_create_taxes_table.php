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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pos_id')->constrained()->cascadeOnDelete();
            $table->string('name',50);
            $table->string('name_loc',50);
            $table->double('per')->nullable();
            $table->double('amount')->nullable();
            $table->string('formula')->nullable();
            $table->string('extra')->nullable();
            $table->boolean('accept_per')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};