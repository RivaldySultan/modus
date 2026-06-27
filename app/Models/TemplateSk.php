<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSk extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional tapi sangat disarankan agar tidak salah baca)
    protected $table = 'template_sks';

    // Mengizinkan kolom-kolom ini diisi data dari form
    protected $fillable = [
        'nama_template',
        'file_template',
        'keterangan',
    ];
}