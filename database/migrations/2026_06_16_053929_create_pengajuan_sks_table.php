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
        Schema::create('pengajuan_sks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke pembuat SK
            $table->string('jenis_sk'); // SK Umum / SK Teknis
            $table->string('kelompok_sk'); // Kepanitiaan, Lapangan, dll
            $table->string('judul_sk');
            $table->string('nomor_sk')->unique();
            $table->string('tahun_anggaran', 4);
            $table->date('tanggal_ditetapkan');
            // Data DIPA & KPA (Bisa direlasikan, tapi disederhanakan jadi string dulu sesuai form)
            $table->string('nomor_dipa');
            $table->date('tanggal_dipa');
            $table->string('kpa_nama');
            $table->string('kpa_nip');
            
            $table->enum('status_pengajuan', ['Diproses', 'Selesai'])->default('Diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_sks');
    }
};
