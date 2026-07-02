<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['super_admin', 'admin', 'organization', 'donor', 'receiver', 'user'])
                  ->default('user')->after('email');
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active')->after('role');
            $table->integer('trust_score')->default(0)->after('status');
            $table->string('avatar')->nullable()->after('trust_score');
            $table->string('phone')->nullable()->after('avatar');
            $table->string('theme')->default('light')->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'status', 'trust_score', 'avatar', 'phone', 'theme']);
        });
    }
};
