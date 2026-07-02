<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_prayer_timings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('timezone')->nullable();
            $table->string('method')->nullable();
            $table->json('timings');
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->unique(['date', 'city', 'country', 'timezone'], 'daily_prayer_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_prayer_timings');
    }
};
