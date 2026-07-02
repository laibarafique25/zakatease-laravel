<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zakat_rules', function (Blueprint $table) {
            $table->id();
            $table->enum('asset_type', ['gold', 'silver', 'cash', 'property', 'agricultural', 'livestock', 'crypto', 'stocks', 'general']);
            $table->string('title');
            $table->longText('content');
            $table->text('islamic_references')->nullable();
            $table->text('scholarly_explanations')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('nisab_values', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['gold', 'silver']);
            $table->decimal('weight_grams', 10, 3); // gold=87.48g, silver=612.36g
            $table->decimal('value_pkr', 15, 2);
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('zakat_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->string('category')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('ai_knowledge_base', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->text('question');
            $table->longText('answer');
            $table->text('islamic_reference')->nullable();
            $table->string('suggested_prompt')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('action'); // login, create, update, delete
            $table->string('module'); // user, campaign, hadith, etc.
            $table->text('description')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->string('group')->default('general'); // site, email, api, prayer, security
            $table->string('type')->default('text'); // text, textarea, boolean, json
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('to_user_id')->constrained('users')->onDelete('cascade');
            $table->string('subject')->nullable();
            $table->text('body');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        Schema::create('broadcasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->enum('type', ['info', 'warning', 'success', 'prayer', 'zakat'])->default('info');
            $table->enum('target', ['all', 'users', 'organizations', 'donors'])->default('all');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('broadcasts');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('ai_knowledge_base');
        Schema::dropIfExists('zakat_faqs');
        Schema::dropIfExists('nisab_values');
        Schema::dropIfExists('zakat_rules');
    }
};
