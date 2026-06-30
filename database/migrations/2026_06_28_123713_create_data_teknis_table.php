<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('data_teknis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_teknis');
            $table->string('kode_teknis')->nullable(); // Boleh kosong jika tidak ada kode
            $table->text('keterangan')->nullable();    // Boleh kosong
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_teknis');
    }
};
