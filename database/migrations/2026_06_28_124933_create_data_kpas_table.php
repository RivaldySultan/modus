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
    Schema::create('data_kpas', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kpa');
        $table->string('nip_kpa')->nullable();
        $table->string('nomor_dipa');
        $table->date('tanggal_dipa')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kpas');
    }
};
