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
    Schema::table('data_pegawais', function (Blueprint $table) {
        $table->string('alamat')->nullable()->after('nip');
        $table->string('no_telepon')->nullable()->after('alamat');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_pegawais', function (Blueprint $table) {
            //
        });
    }
};
