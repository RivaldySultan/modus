<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanPeserta extends Model
{
    use HasFactory;

    protected $table = 'jabatan_pesertas';

    protected $fillable = [
        'nama_jabatan',
    ];
}