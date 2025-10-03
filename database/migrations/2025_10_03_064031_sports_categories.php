<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*Table: sports_categories
- id (Primary Key, Auto-increment)
- name (Varchar: 'Football', 'Basketball', 'Tennis', etc.)
- icon (Varchar)
- is_active (Boolean, Default: true)
- created_at (DateTime, Default: CURRENT_TIMESTAMP)*/
    public function up(): void
    {
        Schema::create('sports_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sports_categories');
    }
};
