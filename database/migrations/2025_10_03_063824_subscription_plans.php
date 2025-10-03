<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     */
    /*Table: subscription_plans
- id (Primary Key, Auto-increment)
- name (Varchar: 'weekly', 'monthly')
- duration_days (Int: 7, 30)
- price (Decimal(10,2))
- is_active (Boolean, Default: true)
- created_at (DateTime, Default: CURRENT_TIMESTAMP)*/
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ['weekly', 'monthly']);
            $table->integer('duration_days');
            $table->decimal('price', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
