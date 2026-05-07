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
        Schema::create('issue_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issue_id')->constrained('issues')->onDelete('cascade');
            $table->string('photo_path');
            $table->enum('priority', ['low', 'medium', 'high'])->default('low');
            $table->text('analysis_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_images');
    }
};
