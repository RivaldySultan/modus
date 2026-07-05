<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Mengambil semua data pengajuan milik user tersebut, diurutkan dari yang terbaru
        $riwayatPengajuan = PengajuanSk::where('user_id', $user->id)->latest()->get();

        // MENGHITUNG STATISTIK ASLI DARI DATABASE
        $totalPengajuan = $riwayatPengajuan->count(); 
        $sedangDiproses = $riwayatPengajuan->where('status_pengajuan', 'Diproses')->count();
        $selesai        = $riwayatPengajuan->where('status_pengajuan', 'Selesai')->count();

        return view('user.dashboard', compact(
            'user', 
            'totalPengajuan', 
            'sedangDiproses', 
            'selesai', 
            'riwayatPengajuan'
        ));
    }
}