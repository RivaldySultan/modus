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
    Schema::create('jabatan_pesertas', function (Blueprint $table) {
        $table->id();
        $table->string('nama_jabatan'); // Menampung nama jabatan seperti PML, PCL, dll.
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_pesertas');
    }
};
