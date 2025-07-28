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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->string('billing_email');
            $table->enum('subscription_plan', ['basic', 'premium', 'enterprise', 'standard'])->nullable();
            $table->enum('billing_cycle', ['monthly', 'quarterly', 'annually', '1_month', '3_months', 'annual'])->nullable();
            $table->date('start_date');
            $table->date('renewal_date');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['Active', 'Suspended', 'Cancelled'])->default('Active');
            $table->enum('payment_method', ['credit_card', 'debit_card', 'bank_transfer', 'gcash', 'paymaya']);
            $table->text('notes')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
