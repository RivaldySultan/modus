<?php

namespace App\Http\Controllers;

use App\Models\DataKpa;
use Illuminate\Http\Request;

class DataKpaController extends Controller
{
    // 1. Menampilkan Halaman Data KPA
    public function index()
    {
        $dataKpa = DataKpa::latest()->get();
        return view('admin.data-kpa', compact('dataKpa'));
    }

    // 2. Menampilkan Form Tambah KPA
    public function create()
    {
        return view('admin.tambah-kpa');
    }

    // 3. Menyimpan Data KPA Baru
    public function store(Request $request)
    {
        // Validasi input dari form tambah
        $request->validate([
            'tahun_anggaran' => 'required|integer', 
            'nama_kpa'     => 'required|string|max:255',
            'nip_kpa'      => 'nullable|string|max:50',
            'nomor_dipa'   => 'required|string|max:255',
            'tanggal_dipa' => 'nullable|date',
        ]);

        // Menyimpan ke database
        DataKpa::create([
            'tahun_anggaran' => $request->tahun_anggaran,
            'nama_kpa'     => $request->nama_kpa,
            'nip_kpa'      => $request->nip_kpa,
            'nomor_dipa'   => $request->nomor_dipa,
            'tanggal_dipa' => $request->tanggal_dipa,
        ]);

        return redirect('/data-kpa')->with('success', 'Data KPA & DIPA berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit KPA
    public function edit($id)
    {
        $kpa = DataKpa::findOrFail($id);
        return view('admin.edit-kpa', compact('kpa'));
    }

    // 5. Menyimpan Perubahan Data KPA
    public function update(Request $request, $id)
    {
        $kpa = DataKpa::findOrFail($id);

        // Validasi input dari form edit (Pastikan tahun_anggaran ikut divalidasi)
        $request->validate([
            'tahun_anggaran' => 'required|integer',
            'nama_kpa'     => 'required|string|max:255',
            'nip_kpa'      => 'nullable|string|max:50',
            'nomor_dipa'   => 'required|string|max:255',
            'tanggal_dipa' => 'nullable|date',
        ]);

        // Mengupdate data di database
        $kpa->update([
            'tahun_anggaran' => $request->tahun_anggaran,
            'nama_kpa'     => $request->nama_kpa,
            'nip_kpa'      => $request->nip_kpa,
            'nomor_dipa'   => $request->nomor_dipa,
            'tanggal_dipa' => $request->tanggal_dipa,
        ]);

        return redirect('/data-kpa')->with('success', 'Data KPA & DIPA berhasil diperbarui!');
    }

    // 6. Menghapus Data KPA
    public function destroy($id)
    {
        $kpa = DataKpa::findOrFail($id);
        $kpa->delete();

        return redirect('/data-kpa')->with('success', 'Data KPA & DIPA berhasil dihapus!');
    }
}