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
        Schema::create('breaking_contents', function (Blueprint $table) {
            $table->id();
            $table->string('text', 255); // نص الخبر العاجل

            // ربط بالمستخدم
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // حالة الخبر (اختياري)
            $table->enum('status', ['draft', 'published'])->default('published');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breaking_contents');
    }
};
