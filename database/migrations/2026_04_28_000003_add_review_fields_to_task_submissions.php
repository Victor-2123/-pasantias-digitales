<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add review/grading fields to task_submissions.
     */
    public function up(): void
    {
        Schema::table('task_submissions', function (Blueprint $table) {
            // 'pending' | 'approved' | 'rejected'
            $table->string('status')->default('pending')->after('original_name');
            // Numeric score 0-100
            $table->unsignedTinyInteger('score')->nullable()->after('status');
            // Mentor feedback text
            $table->text('feedback')->nullable()->after('score');
            // Who reviewed it
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete()->after('feedback');
            // When it was reviewed
            $table->timestamp('reviewed_at')->nullable()->after('reviewed_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_submissions', function (Blueprint $table) {
            $table->dropForeign(['reviewed_by']);
            $table->dropColumn(['status', 'score', 'feedback', 'reviewed_by', 'reviewed_at']);
        });
    }
};
