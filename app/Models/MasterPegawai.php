<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'status_pegawai',
        'nip_nik',
        'alamat',
        'no_telepon',
    ];
}