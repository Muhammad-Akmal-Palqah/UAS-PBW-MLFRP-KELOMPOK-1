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
            // Menambahkan kolom jabatan_id yang terhubung ke tabel jabatans
            // nullable() artinya user boleh tidak punya jabatan dulu
            // onDelete('set null') artinya jika jabatan dihapus, kolom di user jadi kosong (bukan error)
            $table->foreignId('jabatan_id')->after('id')->nullable()->constrained('jabatans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus hubungan (foreign key) dan kolom jabatan_id jika migration di-rollback
            $table->dropForeign(['jabatan_id']);
            $table->dropColumn('jabatan_id');
        });
    }
};