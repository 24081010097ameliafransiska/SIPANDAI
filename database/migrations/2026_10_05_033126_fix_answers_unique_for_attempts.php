<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeign(['exam_id']);
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['question_id']);
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->dropUnique('answers_exam_id_siswa_id_question_id_unique');

            $table->unique(
                ['attempt_id', 'question_id'],
                'answers_attempt_id_question_id_unique'
            );
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->foreign('exam_id')
                ->references('id')
                ->on('exams')
                ->cascadeOnDelete();

            $table->foreign('siswa_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeign(['exam_id']);
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['question_id']);
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->dropUnique('answers_attempt_id_question_id_unique');

            $table->unique(
                ['exam_id', 'siswa_id', 'question_id'],
                'answers_exam_id_siswa_id_question_id_unique'
            );
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->foreign('exam_id')
                ->references('id')
                ->on('exams')
                ->cascadeOnDelete();

            $table->foreign('siswa_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->cascadeOnDelete();
        });
    }
};