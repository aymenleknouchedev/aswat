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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title', 68);
            $table->string('long_title', 210);
            $table->string('mobile_title', 50);
            $table->text('summary')->nullable();
            $table->longText('body')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->text('author_notes')->nullable();
            $table->string('language', 5)->default('en');
            $table->integer('priority')->default(0);
            $table->string('image')->nullable();
            $table->string('image_alt_text')->nullable();
            $table->enum('type_of_content', ['normal_news', 'secondary_news'])->default('normal_news');
            $table->datetime('published_at')->nullable();
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            $table->foreignId('writer_id')->constrained('writers')->onDelete('cascade');
            $table->foreignId('writer_location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('media_id')->constrained('media')->onDelete('cascade');
            $table->foreignId('tags_id')->constrained('tags')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
