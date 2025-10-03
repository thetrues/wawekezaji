<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*Table: mkekas
- id (Primary Key, Auto-increment)
- title (Varchar, Not Null) - e.g., "Weekend Sure Bets", "Monday Specials"
- description (Text, Nullable) - Optional description of the mkeka
- total_odds (Decimal(10,2)) - Calculated combined odds for all matches
- sport_category_id (Foreign Key → sports_categories.id)
- visibility_type (Enum: 'free', 'premium', 'pay_per_view')
- pay_per_view_price (Decimal(10,2), Nullable)
- status (Enum: 'draft', 'published', 'expired', 'cancelled')
- created_by (Foreign Key → users.id)
- created_at (DateTime, Default: CURRENT_TIMESTAMP)
- updated_at (DateTime, Default: CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)*/
    public function up(): void
    {
        Schema::create('mkekas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('total_odds', 10, 2);
            $table->foreignId('sport_category_id')->constrained('sports_categories');
            $table->enum('visibility_type', ['free', 'premium', 'pay_per_view']);
            $table->decimal('pay_per_view_price', 10, 2)->nullable();
            $table->enum('status', ['draft', 'published', 'expired', 'cancelled']);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mkekas');
    }
};
