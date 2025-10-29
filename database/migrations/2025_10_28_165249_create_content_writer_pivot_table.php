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
        Schema::create('content_writer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained()->onDelete('cascade');
            $table->foreignId('writer_id')->constrained()->onDelete('cascade');
            $table->string('role')->nullable(); // The role of the writer for this content
            $table->timestamps();

            // Ensure unique combination of content_id and writer_id
            $table->unique(['content_id', 'writer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_writer');
    }
};