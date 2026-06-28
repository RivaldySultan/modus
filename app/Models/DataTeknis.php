<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTeknis extends Model
{
    use HasFactory;

    protected $table = 'data_teknis';

    protected $fillable = [
        'nama_teknis',
        'kode_teknis',
        'keterangan',
    ];
}