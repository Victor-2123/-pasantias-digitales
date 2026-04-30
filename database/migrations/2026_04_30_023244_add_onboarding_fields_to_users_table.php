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
        Schema::table('users', function (Blueprint $table) {
            $table->string('school')->nullable();
            $table->integer('age')->nullable();
            $table->text('bio')->nullable();
            // is_profile_complete to easily check if onboarding is done
            $table->boolean('is_profile_complete')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['school', 'age', 'bio', 'is_profile_complete']);
        });
    }
};
