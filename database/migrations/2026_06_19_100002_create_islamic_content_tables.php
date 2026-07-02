<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hadith_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('hadiths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('hadith_categories')->onDelete('cascade');
            $table->text('arabic_text');
            $table->text('urdu_translation')->nullable();
            $table->text('english_translation');
            $table->string('source')->nullable(); // e.g. Bukhari, Muslim
            $table->string('hadith_number')->nullable();
            $table->enum('grade', ['sahih', 'hasan', 'daif', 'unknown'])->default('unknown');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('azkar_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('type', ['morning', 'evening', 'prayer', 'general'])->default('general');
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('azkar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('azkar_categories')->onDelete('cascade');
            $table->text('arabic_text');
            $table->text('urdu_translation')->nullable();
            $table->text('english_translation')->nullable();
            $table->string('reference')->nullable();
            $table->text('benefits')->nullable();
            $table->string('audio_path')->nullable();
            $table->integer('repeat_count')->default(1);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('quran_topics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('quran_verses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->nullable()->constrained('quran_topics')->onDelete('set null');
            $table->string('surah_name');
            $table->integer('surah_number');
            $table->integer('ayah_number');
            $table->text('arabic_text');
            $table->text('urdu_translation')->nullable();
            $table->text('english_translation');
            $table->text('reflection')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quran_verses');
        Schema::dropIfExists('quran_topics');
        Schema::dropIfExists('azkar');
        Schema::dropIfExists('azkar_categories');
        Schema::dropIfExists('hadiths');
        Schema::dropIfExists('hadith_categories');
    }
};
