<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add category, icon color, and area fields to careers table.
     */
    public function up(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            // Category/area grouping (A, B, C, D or label)
            $table->string('category')->default('general')->after('slug');
            // Short tagline displayed on the card
            $table->string('tagline')->nullable()->after('category');
            // Color identifier used for UI accents: blue, emerald, amber, violet
            $table->string('color')->default('blue')->after('tagline');
            // Emoji icon
            $table->string('icon')->default('🎓')->after('color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            $table->dropColumn(['category', 'tagline', 'color', 'icon']);
        });
    }
};
