<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('windows', function (Blueprint $table) {
            $table->text('social_image')->nullable()->after('image');
            $table->text('description')->nullable()->after('social_image');
        });

        Schema::table('trends', function (Blueprint $table) {
            $table->text('social_image')->nullable()->after('image');
            $table->text('description')->nullable()->after('social_image');
        });
    }

    public function down(): void
    {
        Schema::table('windows', function (Blueprint $table) {
            $table->dropColumn(['social_image', 'description']);
        });

        Schema::table('trends', function (Blueprint $table) {
            $table->dropColumn(['social_image', 'description']);
        });
    }
};
