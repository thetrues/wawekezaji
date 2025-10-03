<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*Table: notifications
- id (Primary Key, Auto-increment)
- user_id (Foreign Key → users.id)
- title (Varchar)
- message (Text)
- notification_type (Enum: 'new_mkeka', 'subscription', 'payment', 'system')
- is_read (Boolean, Default: false)
- related_entity_type (Enum: 'mkeka', 'payment', 'subscription')
- related_entity_id (Int)
- created_at (DateTime, Default: CURRENT_TIMESTAMP)*/
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('title');
            $table->text('message');
            $table->enum('notification_type', ['new_mkeka', 'subscription', 'payment', 'system']);
            $table->boolean('is_read')->default(false);
            $table->enum('related_entity_type', ['mkeka', 'payment', 'subscription']);
            $table->integer('related_entity_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
