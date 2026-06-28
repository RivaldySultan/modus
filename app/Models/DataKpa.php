<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKpa extends Model
{
    use HasFactory;

    protected $table = 'data_kpas';

    protected $fillable = [
        'nama_kpa',
        'nip_kpa',
        'nomor_dipa',
        'tanggal_dipa',
    ];
}