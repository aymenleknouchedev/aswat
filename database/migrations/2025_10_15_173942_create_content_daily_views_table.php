<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('content_daily_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained('contents')->onDelete('cascade');
            $table->date('date');
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();

            $table->unique(['content_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_daily_views');
    }
};
