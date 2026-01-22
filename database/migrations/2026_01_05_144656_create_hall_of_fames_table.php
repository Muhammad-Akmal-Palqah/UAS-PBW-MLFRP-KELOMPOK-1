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
        Schema::create('hall_of_fames', function (Blueprint $table) {
            $table->id();
            // TAMBAHKAN 3 BARIS DI BAWAH INI:
            $table->string('nama_tokoh');
            $table->string('foto');
            $table->text('deskripsi')->nullable(); 
            // ---------------------------
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_of_fames');
    }
};