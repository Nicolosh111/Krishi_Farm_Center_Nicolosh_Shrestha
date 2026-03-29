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
        Schema::create('disease_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plant_image_id'); // link to uploaded image
            $table->unsignedBigInteger('expert_id')->nullable();
            $table->foreign('plant_image_id')->references('id')->on('plant_images')->onDelete('cascade');
            $table->foreign('expert_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('disease_id');
            $table->foreign('disease_id')->references('id')->on('diseases')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disease_diagnoses');
    }
};
