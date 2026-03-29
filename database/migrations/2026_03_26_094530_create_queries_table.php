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
        Schema::create('queries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crop_id')->nullable()->constrained()->onDelete('cascade');   // NEW
            $table->foreignId('disease_id')->nullable()->constrained()->onDelete('cascade'); // make nullable
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // farmer who asked
            $table->text('question'); // the query text
            $table->string('status')->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queries');
    }
};
