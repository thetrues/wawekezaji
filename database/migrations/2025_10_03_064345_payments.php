<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*Table: payments
- id (Primary Key, Auto-increment)
- user_id (Foreign Key → users.id)
- payment_type (Enum: 'subscription', 'pay_per_view')
- amount (Decimal(10,2))
- currency (Varchar, Default: 'USD')
- payment_gateway (Varchar: 'stripe', 'mpesa', 'paypal')
- gateway_transaction_id (Varchar, Unique)
- status (Enum: 'pending', 'completed', 'failed', 'refunded')
- subscription_plan_id (Foreign Key → subscription_plans.id, Nullable)
- mkeka_id (Foreign Key → mkekas.id, Nullable) - For pay-per-view
- expires_at (DateTime)
- created_at (DateTime, Default: CURRENT_TIMESTAMP)*/
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('payment_type', ['subscription', 'pay_per_view']);
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('USD');
            $table->string('payment_gateway')->enum('stripe', 'mpesa', 'paypal', 'flutterwave', 'mixbyyass', 'airtelmoney', 'halopesa', 'visa', 'credit');
            $table->string('gateway_transaction_id')->unique();
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded']);
            $table->foreignId('subscription_plan_id')->nullable()->constrained('subscription_plans');
            $table->foreignId('mkeka_id')->nullable()->constrained('mkekas');
            $table->dateTime('expires_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
