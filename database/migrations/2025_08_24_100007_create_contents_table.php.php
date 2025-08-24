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

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->foreignId('display_method_id')->nullable()->constrained('display_methods')->nullOnDelete();


            // Titles
            $table->string('title', 75);
            $table->string('long_title', 210)->nullable();
            $table->string('mobile_title', 40)->nullable();

            // Foreign keys
            $table->foreignId('section_id')->nullable()->constrained('sections')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('location_id')->nullable()->constrained('locations')->nullOnDelete();
            $table->foreignId('trend_id')->nullable()->constrained('trends')->nullOnDelete();
            $table->foreignId('window_id')->nullable()->constrained('windows')->nullOnDelete();
            $table->foreignId('writer_id')->nullable()->constrained('writers')->nullOnDelete();
            $table->foreignId('writer_location_id')->nullable()->constrained('locations')->nullOnDelete();
            

            // Body
            $table->string('summary', 130);
            $table->longText('body');

            // SEO
            $table->string('seo_keyword')->nullable();

            // Content type
            $table->enum('content_type', ['image', 'video', 'podcast', 'album', 'none'])->default('image');

            // Status
            $table->enum('status', ['draft', 'published'])->default('draft');

            $table->timestamps();
            $table->softDeletes();
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
