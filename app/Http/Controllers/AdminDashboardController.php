<?php

namespace App\Http\Controllers;

use App\Models\TemplateSk;
use App\Models\PengajuanSk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Menghitung total data
        $jumlahTemplate = TemplateSk::count();
        $totalSk = PengajuanSk::count();
        
        // Menghitung SK khusus bulan ini
        $skBulanIni = PengajuanSk::whereMonth('created_at', Carbon::now()->month)
                                 ->whereYear('created_at', Carbon::now()->year)
                                 ->count();

        // Mengambil 5 aktivitas/pengajuan terbaru
        $aktivitasTerakhir = PengajuanSk::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'jumlahTemplate', 
            'totalSk', 
            'skBulanIni', 
            'aktivitasTerakhir'
        ));
    }
}