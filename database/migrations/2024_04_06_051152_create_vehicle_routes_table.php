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
        Schema::create('vehicle_routes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->unsignedInteger('start_from')->default(0);
            $table->unsignedInteger('end_to')->default(0);
            $table->text('stoppages')->nullable();
            $table->string('distance', 40)->nullable();
            $table->string('time', 40)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_routes');
    }
};