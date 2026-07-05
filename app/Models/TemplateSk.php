<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSk extends Model
{
    use HasFactory;

    protected $table = 'template_sks';

    protected $fillable = [
        'nama_template',
        'jenis_sk_id', 
        'file_template',
        'keterangan',
    ];

    // Fungsi Relasi ke Jenis SK
    public function jenisSk()
    {
        return $this->belongsTo(JenisSk::class, 'jenis_sk_id');
    }
}