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
        Schema::create('success_stories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // link to users table
            $table->string('title');
            $table->string('farmer_name');
            $table->string('location');
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending');
            $table->unsignedInteger('likes_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('success_stories');
    }
};
