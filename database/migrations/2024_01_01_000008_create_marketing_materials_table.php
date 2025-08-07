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
        Schema::create('marketing_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->comment('banner, caption, poster, video, landing_page');
            $table->string('format')->nullable()->comment('jpg, png, mp4, html, etc');
            $table->text('content')->nullable()->comment('Text content for captions');
            $table->string('file_path')->nullable()->comment('Path to media file');
            $table->string('preview_image')->nullable()->comment('Preview image for videos');
            $table->json('dimensions')->nullable()->comment('Width/height for images');
            $table->json('program_types')->nullable()->comment('Applicable program types');
            $table->text('description')->nullable();
            $table->integer('download_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['type', 'is_active']);
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_materials');
    }
};