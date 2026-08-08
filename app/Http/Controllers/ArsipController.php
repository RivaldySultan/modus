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

    public function tanggapi(Request $request, $id)
    {
        // 1. Validasi input (tanggapan wajib diisi)
        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        // 2. Cari data arsipnya di tabel pengajuan_sks
        $arsip = \App\Models\PengajuanSk::findOrFail($id);
        
        // 3. Ubah status dan simpan isi tanggapannya
        $arsip->status = 'selesai'; 
        $arsip->tanggapan = $request->tanggapan;
        $arsip->save();

        // 4. Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Arsip telah diperiksa dan tanggapan berhasil dikirim!');
    }
}