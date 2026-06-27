<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaSk extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_sk_id',
        'nama_pegawai',
        'nip_pegawai',
        'jabatan',
        'honor_per_bulan',
    ];

    // Kebalikan relasi ke SK induk
    public function pengajuanSk()
    {
        return $this->belongsTo(PengajuanSk::class, 'pengajuan_sk_id');
    }
}