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
        $keys = [
            'section_id'   => 'sections',
            'category_id'  => 'categories',
            'trend_id'     => 'trends',
            'window_id'    => 'windows',
            'continent_id' => 'locations',
            'country_id'   => 'locations',
            'city_id'      => 'locations',
        ];

        Schema::table('contents', function (Blueprint $table) use ($keys) {
            foreach ($keys as $column => $referencedTable) {
                $table->dropForeign([$column]);
            }
        });

        Schema::table('contents', function (Blueprint $table) use ($keys) {
            foreach ($keys as $column => $referencedTable) {
                $table->foreign($column)->references('id')->on($referencedTable)->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $keys = [
            'section_id'   => 'sections',
            'category_id'  => 'categories',
            'trend_id'     => 'trends',
            'window_id'    => 'windows',
            'continent_id' => 'locations',
            'country_id'   => 'locations',
            'city_id'      => 'locations',
        ];

        Schema::table('contents', function (Blueprint $table) use ($keys) {
            foreach ($keys as $column => $referencedTable) {
                $table->dropForeign([$column]);
            }
        });

        Schema::table('contents', function (Blueprint $table) use ($keys) {
            foreach ($keys as $column => $referencedTable) {
                $table->foreign($column)->references('id')->on($referencedTable)->restrictOnDelete();
            }
        });
    }
};
