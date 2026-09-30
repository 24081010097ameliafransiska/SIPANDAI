<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom untuk menyimpan tipe submit dan waktu pengumpulan.
     */
    public function up(): void
    {
        Schema::table('exam_results', function (Blueprint $table) {
            $table->string('submit_type')->default('submit')->after('nilai');
            $table->dateTime('submitted_at')->nullable()->after('submit_type');
        });
    }

    /**
     * Hapus kolom jika migration di-rollback.
     */
    public function down(): void
    {
        Schema::table('exam_results', function (Blueprint $table) {
            $table->dropColumn([
                'submit_type',
                'submitted_at',
            ]);
        });
    }
};