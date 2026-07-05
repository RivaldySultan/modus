<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_sk',
        'kelompok_sk',
        'judul_sk',
        'nomor_sk',
        'tahun_anggaran',
        'tanggal_ditetapkan',
        'nomor_dipa',
        'tanggal_dipa',
        'kpa_nama',
        'kpa_nip',
        'status_pengajuan',
        'file_sk'
    ];

    // Relasi: Satu SK punya banyak Peserta/Lampiran
    public function peserta()
    {
        return $this->hasMany(PesertaSk::class, 'pengajuan_sk_id');
    }

    // Relasi ke tabel User (Pembuat SK)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}