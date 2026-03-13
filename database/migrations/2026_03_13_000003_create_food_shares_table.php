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
        Schema::create('food_shares', function (Blueprint $table) {
            $table->id();
            $table->string('food_name');
            $table->string('slug')->unique();
            $table->string('provider_name');
            $table->integer('servings');
            $table->enum('status', ['Available', 'Booked', 'Collected'])->default('Available');
            $table->string('image_url');
            $table->dateTime('pickup_limit');
            $table->string('location_detail');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_shares');
    }
};