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
        Schema::create('success_stories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('full_name');
            $table->string('city');
            $table->enum('user_type', ['widow', 'orphan', 'student', 'small_business_owner', 'patient', 'daily_wage_worker', 'flood_victim', 'disabled', 'anonymous']);
            $table->string('title');
            $table->text('story');
            $table->decimal('amount_received', 15, 2)->nullable();
            $table->string('profile_image')->nullable();
            $table->unsignedTinyInteger('rating')->default(5);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('success_stories');
    }
};
