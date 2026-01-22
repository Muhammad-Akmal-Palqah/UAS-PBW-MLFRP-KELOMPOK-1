<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('kalenders', function (Blueprint $table) {
        $table->id();
        $table->string('nama_peminjam');
        $table->string('prodi');
        $table->string('item_pinjam');
        $table->string('waktu_pinjam');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kalenders');
    }
};
