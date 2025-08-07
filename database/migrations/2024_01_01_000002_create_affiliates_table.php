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
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('affiliate_code')->unique()->comment('Unique affiliate identifier');
            $table->string('full_name');
            $table->string('phone');
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_holder')->nullable();
            $table->enum('status', ['pending', 'active', 'inactive', 'suspended'])->default('pending');
            $table->enum('tier', ['bronze', 'silver', 'gold', 'platinum'])->default('bronze');
            $table->decimal('total_commissions_earned', 12, 2)->default(0);
            $table->decimal('total_commissions_paid', 12, 2)->default(0);
            $table->decimal('minimum_payout', 8, 2)->default(100000)->comment('Minimum payout in Rupiah');
            $table->json('marketing_preferences')->nullable()->comment('Preferred marketing materials');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            
            $table->index(['status', 'tier']);
            $table->index('affiliate_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliates');
    }
};