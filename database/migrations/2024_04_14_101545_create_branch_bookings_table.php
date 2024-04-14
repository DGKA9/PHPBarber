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
        Schema::create('branch_bookings', function (Blueprint $table) {
            $table->uuid('bookingID');
            $table->uuid('branchID');
            $table->timestamps();

            $table->foreign('bookingID')->references('bookingID')->on('bookings')->onDelete('cascade');
            $table->foreign('branchID')->references('branchID')->on('branches')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_bookings');
    }
};
