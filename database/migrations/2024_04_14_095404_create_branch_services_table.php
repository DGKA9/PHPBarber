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
        Schema::create('branch_services', function (Blueprint $table) {
            $table->uuid('branchID');
            $table->uuid('serviceID');
            $table->timestamps();

            $table->foreign('branchID')->references('branchID')->on('branches')->onDelete('cascade');
            $table->foreign('serviceID')->references('serviceID')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_services');
    }
};
