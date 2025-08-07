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
        Schema::create('affiliate_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affiliate_id')->constrained()->onDelete('cascade');
            $table->foreignId('affiliate_program_id')->constrained()->onDelete('cascade');
            $table->string('link_code')->unique()->comment('Unique link identifier');
            $table->string('original_url')->comment('Target URL');
            $table->string('campaign')->nullable()->comment('Campaign name');
            $table->integer('clicks')->default(0);
            $table->integer('conversions')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['affiliate_id', 'is_active']);
            $table->index('link_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_links');
    }
};