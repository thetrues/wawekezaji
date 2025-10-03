<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*Table: user_mkeka_access
- id (Primary Key, Auto-increment)
- user_id (Foreign Key → users.id)
- mkeka_id (Foreign Key → mkekas.id)
- access_type (Enum: 'subscription', 'pay_per_view')
- payment_id (Foreign Key → payments.id)
- expires_at (DateTime)
- created_at (DateTime, Default: CURRENT_TIMESTAMP)
- Unique Key: (user_id, mkeka_id)*/
    public function up(): void
    {
        Schema::create('user_mkeka_access', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('mkeka_id')->constrained('mkekas');
            $table->enum('access_type', ['subscription', 'pay_per_view']);
            $table->foreignId('payment_id')->constrained('payments');
            $table->dateTime('expires_at');
            $table->timestamps();
            $table->unique(['user_id', 'mkeka_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_mkeka_access');
    }
};
