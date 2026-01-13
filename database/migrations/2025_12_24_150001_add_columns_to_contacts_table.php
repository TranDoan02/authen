<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (!Schema::hasColumn('contacts', 'name')) {
                $table->string('name')->after('id');
            }
            if (!Schema::hasColumn('contacts', 'email')) {
                $table->string('email')->after('name');
            }
            if (!Schema::hasColumn('contacts', 'phone')) {
                $table->string('phone')->after('email');
            }
            if (!Schema::hasColumn('contacts', 'message')) {
                $table->text('message')->after('phone');
            }
            if (!Schema::hasColumn('contacts', 'is_read')) {
                $table->boolean('is_read')->default(false)->after('message');
            }
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (Schema::hasColumn('contacts', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('contacts', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('contacts', 'phone')) {
                $table->dropColumn('phone');
            }
            if (Schema::hasColumn('contacts', 'message')) {
                $table->dropColumn('message');
            }
            if (Schema::hasColumn('contacts', 'is_read')) {
                $table->dropColumn('is_read');
            }
        });
    }
};

