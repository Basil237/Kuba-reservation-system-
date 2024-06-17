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
        Schema::create('fleet_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('seat_layout', 40)->nullable();
            $table->unsignedBigInteger('deck')->default(0);
            $table->string('deck_seats', 40)->nullable();
            $table->string('facilities', 255)->nullable();
            $table->unsignedBigInteger('has_ac')->default(0);
            $table->unsignedBigInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleet_types');
    }
};
