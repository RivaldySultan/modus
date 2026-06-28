<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPegawai extends Model
{
    use HasFactory;

    // Menentukan nama tabel agar Laravel tidak kebingungan
    protected $table = 'data_pegawais';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'status_pegawai',
    ];
}