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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->unsignedInteger('fleet_type_id')->default(0);
            $table->unsignedInteger('vehicle_route_id')->default(0);
            $table->unsignedInteger('schedule_id')->default(0);
            $table->unsignedInteger('start_from')->default(0);
            $table->unsignedInteger('end_to')->default(0);
            $table->string('day_off', 255)->nullable();
            $table->unsignedInteger('booking_time')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
