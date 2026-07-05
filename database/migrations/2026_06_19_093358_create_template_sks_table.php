<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('template_sks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_template');
            $table->unsignedBigInteger('jenis_sk_id')->nullable(); // Kolom relasi baru
            $table->string('file_template'); 
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('template_sks');
    }
};