<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanTeknis extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_teknis';

    protected $fillable = [
        'nama_teknis',
        'nama_survei',
        'periode'
    ];
}