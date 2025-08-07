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
        Schema::create('affiliate_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Program name');
            $table->string('type')->comment('online, offline, group, branch');
            $table->string('category')->nullable()->comment('Program category');
            $table->string('location')->nullable()->comment('City for branch programs');
            $table->text('description')->nullable();
            $table->decimal('base_price', 10, 2)->comment('Base price for commission calculation');
            $table->decimal('commission_rate', 5, 2)->default(10.00)->comment('Commission percentage');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['type', 'is_active']);
            $table->index('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_programs');
    }
};