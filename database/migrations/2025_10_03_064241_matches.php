<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*Table: matches
- id (Primary Key, Auto-increment)
- mkeka_id (Foreign Key → mkekas.id) - Links match to a mkeka
- team_a (Varchar, Not Null)
- team_b (Varchar, Not Null)
- match_date (DateTime)
- sport_category_id (Foreign Key → sports_categories.id)
- prediction (Enum: '1', '2', 'X', '1X', '2X', 'Over 1.5', 'Under 2.5', 'BTTS', etc.)
- odds (Decimal(5,2))
- analysis (Text, Nullable) - Specific analysis for this match
- status (Enum: 'pending', 'won', 'lost', 'cancelled') - Default: 'pending'
- created_at (DateTime, Default: CURRENT_TIMESTAMP)*/
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mkeka_id')->constrained('mkekas');
            $table->string('team_a');
            $table->string('team_b');
            $table->dateTime('match_date');
            $table->foreignId('sport_category_id')->constrained('sports_categories');
            $table->enum('prediction', ['1', '2', 'X', '1X', '2X', 'Over 1.5', 'Under 2.5', 'BTTS']);
            $table->decimal('odds', 5, 2);
            $table->text('analysis')->nullable();
            $table->enum('status', ['pending', 'won', 'lost', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
