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
        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Disease name
            $table->foreignId('crop_id')->constrained()->onDelete('cascade');
            $table->string('image')->nullable();
            $table->text('symptoms');
            $table->text('cause')->nullable();
            $table->text('prevention')->nullable();
            $table->text('treatment')->nullable();
            $table->string('type')->nullable();
            $table->enum('severity', ['low', 'medium', 'high'])->default('low');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diseases');
    }
};
