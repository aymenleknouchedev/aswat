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
        Schema::create('display_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);      // اسم طريقة العرض (مثلاً: standard, featured, slider...)
            $table->string('description')->nullable(); // وصف اختياري
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('display_methods');
    }
};
