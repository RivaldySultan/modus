<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSk;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    // Menampilkan halaman arsip
    public function index()
    {
        $arsip = PengajuanSk::with('user')->latest()->get();
        return view('admin.arsip', compact('arsip'));
    }

    // Mengubah status pengajuan (Selesai / Diproses / Ditolak)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pengajuan' => 'required|in:Diproses,Selesai,Ditolak',
        ]);

        $arsip = PengajuanSk::findOrFail($id);
        $arsip->update([
            'status_pengajuan' => $request->status_pengajuan
        ]);

        return redirect('/arsip')->with('success', 'Status SK berhasil diubah menjadi ' . $request->status_pengajuan);
    }
}