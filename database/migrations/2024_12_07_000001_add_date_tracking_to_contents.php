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
        Schema::table('contents', function (Blueprint $table) {
            // Add user tracking for updates
            $table->foreignId('updated_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            
            // Make published_at nullable (currently it's using useCurrent which always sets it)
            $table->timestamp('published_at')->nullable()->change();
            
            // Add creation timestamp (will be set when content is published)
            $table->timestamp('published_date')->nullable()->after('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\User::class, 'updated_by_user_id');
            $table->dropColumn('updated_by_user_id');
            $table->dropColumn('published_date');
            // Restore published_at to useCurrent
            $table->timestamp('published_at')->useCurrent()->change();
        });
    }
};
