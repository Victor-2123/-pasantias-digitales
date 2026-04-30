<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('challenges', function (Blueprint $table) {
            $table->foreignId('learning_path_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedInteger('order')->default(0); // position within the path
        });
    }

    public function down(): void
    {
        Schema::table('challenges', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\LearningPath::class);
            $table->dropColumn(['learning_path_id', 'order']);
        });
    }
};
