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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('jenis_sk');
            $table->string('kelompok_sk');
            $table->string('judul_sk');
            $table->string('nomor_sk')->unique();
            $table->string('tahun_anggaran', 4);
            $table->date('tanggal_ditetapkan');
            $table->string('nomor_dipa');
            $table->date('tanggal_dipa');
            $table->string('kpa_nama');
            $table->string('kpa_nip');
            
            // PERUBAHAN DI SINI:
            $table->string('status_pengajuan')->default('Diproses'); // Diproses, Selesai, Ditolak, Revisi
            $table->text('catatan')->nullable(); // Tempat Admin memberi tanggapan
            $table->string('file_sk')->nullable(); // Tempat menyimpan file docx
            
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
