<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // MENGHITUNG STATISTIK (Sementara diset 0 sebelum tabel Pengajuan SK dibuat di tahap selanjutnya)
        $totalPengajuan = 0; 
        $sedangDiproses = 0;
        $selesai = 0;

        // DATA RIWAYAT PENGAJUAN (Sementara array kosong)
        $riwayatPengajuan = [];

        return view('user.dashboard', compact(
            'user', 
            'totalPengajuan', 
            'sedangDiproses', 
            'selesai', 
            'riwayatPengajuan'
        ));
    }
}