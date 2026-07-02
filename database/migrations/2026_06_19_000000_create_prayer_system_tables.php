<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('city');
            $table->string('country');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('timezone')->nullable();
            $table->string('method')->nullable();
            $table->boolean('preferred')->default(true);
            $table->timestamps();
        });

        Schema::create('prayer_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('prayer_name');
            $table->enum('status', ['prayed', 'jamaat', 'late', 'qaza']);
            $table->date('date');
            $table->dateTime('logged_at')->useCurrent();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('timezone')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('qaza_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('prayer_name');
            $table->unsignedInteger('completed_count')->default(0);
            $table->unsignedInteger('remaining_count')->default(0);
            $table->date('completed_at')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('prayer_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('notification_type');
            $table->dateTime('scheduled_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->enum('status', ['pending', 'sent', 'missed'])->default('pending');
            $table->json('payload')->nullable();
            $table->timestamps();
        });

        Schema::create('prayer_streaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedInteger('daily_streak')->default(0);
            $table->unsignedInteger('weekly_streak')->default(0);
            $table->unsignedInteger('monthly_streak')->default(0);
            $table->unsignedInteger('yearly_streak')->default(0);
            $table->date('last_prayed_date')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('notification_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedInteger('before_prayer_minutes')->default(15);
            $table->boolean('reminders_enabled')->default(true);
            $table->boolean('friday_reminder')->default(true);
            $table->boolean('ramadan_reminder')->default(true);
            $table->boolean('special_occasions')->default(true);
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_preferences');
        Schema::dropIfExists('prayer_streaks');
        Schema::dropIfExists('prayer_notifications');
        Schema::dropIfExists('qaza_logs');
        Schema::dropIfExists('prayer_logs');
        Schema::dropIfExists('user_locations');
    }
};
