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
        Schema::create('join_teams', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email');
            $table->text('message');
            $table->string('cv')->nullable();
            $table->enum('status', ['pending', 'checked', 'accepted', 'rejected'])->default('pending');
            $table->enum('reason', ['journalist', 'infographic', 'voiceover', 'audiovisual', 'translator', 'proofreader'])->default('journalist');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('join_teams');
    }
};
