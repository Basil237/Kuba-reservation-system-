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
        Schema::create('booked_tickets', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id')->default(0);
            $table->unsignedInteger('gender')->default(0);
            $table->unsignedBigInteger('trip_id')->default(0);
            $table->string('source_destination', 40)->nullable();
            $table->unsignedInteger('pickup_point')->default(0);
            $table->unsignedInteger('dropping_point')->default(0);
            $table->string('seats', 255)->nullable();
            $table->unsignedInteger('ticket_count')->default(0);
            $table->decimal('unit_price', 28,8)->default(0);
            $table->decimal('sub_total', 28,8)->default(0);
            $table->date('date_of_journey')->nullable();
            $table->string('pnr_number', 40)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booked_tickets');
    }
};
