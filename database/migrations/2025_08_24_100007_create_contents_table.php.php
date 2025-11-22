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


            // Titles
            $table->string('title', 75);
            $table->string('long_title', 210)->nullable();
            $table->string('mobile_title', 50)->nullable();
            $table->string('caption', 255)->nullable();

            // template
            $table->enum('display_method', ['simple', 'list', 'file'])->default('simple');

            // Foreign keys
            $table->foreignId('section_id')->nullable()->constrained('sections')->restrictOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->restrictOnDelete();
            $table->foreignId('continent_id')->nullable()->constrained('locations')->restrictOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('locations')->restrictOnDelete();
            $table->foreignId('trend_id')->nullable()->constrained('trends')->restrictOnDelete();
            $table->foreignId('window_id')->nullable()->constrained('windows')->restrictOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('locations')->restrictOnDelete();

            // Body
            $table->string('summary', 130);
            $table->longText('content');

            $table->longText('review_description')->nullable();
            $table->longText('share_description')->nullable();
            $table->string('share_title')->nullable();
            $table->longText('share_image')->nullable();

            // SEO
            $table->string('seo_keyword')->nullable();

            // Media type
            $table->enum('template', ['normal_image', 'video', 'podcast', 'album', 'no_image'])->default('normal_image');
            // Status
            $table->enum('status', ['draft', 'published', 'scheduled'])->default('draft');

            $table->timestamps();
            $table->timestamp('published_at')->useCurrent();
            $table->unsignedBigInteger('read_count')->default(0);

            $table->boolean('is_latest')->default(false);
            $table->integer('importance')->default(1);
            
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
