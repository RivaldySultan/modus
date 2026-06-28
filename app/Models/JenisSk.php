<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSk extends Model
{
    use HasFactory;

    protected $table = 'jenis_sks';

    protected $fillable = [
        'kelompok_sk',
        'nama_jenis_sk',
        'periode',
    ];
}