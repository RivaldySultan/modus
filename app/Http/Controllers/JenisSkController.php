<?php

namespace App\Http\Controllers;

use App\Models\JenisSk;
use Illuminate\Http\Request;

class JenisSkController extends Controller
{
    // 1. Menampilkan Halaman Tabel Utama Data Jenis SK
    public function index()
    {
        $jenisSk = JenisSk::latest()->get();
        return view('admin.data-jenis-sk', compact('jenisSk'));
    }

    // 2. Menampilkan Form Tambah Jenis SK
    public function create()
    {
        return view('admin.tambah-jenis-sk');
    }

    // 3. Menyimpan Data Jenis SK Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'kelompok_sk'   => 'required|string|max:50',
            'nama_jenis_sk' => 'required|string|max:255',
            'periode'       => 'nullable|string|max:100',
        ]);

        JenisSk::create([
            'kelompok_sk'   => $request->kelompok_sk,
            'nama_jenis_sk' => $request->nama_jenis_sk,
            'periode'       => $request->periode,
        ]);

        return redirect('/data-jenis-sk')->with('success', 'Data Jenis SK berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit Jenis SK
    public function edit($id)
    {
        $jenis = JenisSk::findOrFail($id);
        return view('admin.edit-jenis-sk', compact('jenis'));
    }

    // 5. Menyimpan Perubahan Data Jenis SK
    public function update(Request $request, $id)
    {
        $jenis = JenisSk::findOrFail($id);

        $request->validate([
            'kelompok_sk'   => 'required|string|max:50',
            'nama_jenis_sk' => 'required|string|max:255',
            'periode'       => 'nullable|string|max:100',
        ]);

        $jenis->update([
            'kelompok_sk'   => $request->kelompok_sk,
            'nama_jenis_sk' => $request->nama_jenis_sk,
            'periode'       => $request->periode,
        ]);

        return redirect('/data-jenis-sk')->with('success', 'Data Jenis SK berhasil diperbarui!');
    }

    // 6. Menghapus Data Jenis SK
    public function destroy($id)
    {
        $jenis = JenisSk::findOrFail($id);
        $jenis->delete();

        return redirect('/data-jenis-sk')->with('success', 'Data Jenis SK berhasil dihapus!');
    }
}