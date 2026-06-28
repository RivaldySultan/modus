<?php

namespace App\Http\Controllers;

use App\Models\JabatanPeserta;
use Illuminate\Http\Request;

class JabatanPesertaController extends Controller
{
    // 1. Menampilkan Halaman Tabel Utama Data Jabatan Peserta
    public function index()
    {
        $jabatan = JabatanPeserta::latest()->get();
        return view('admin.data-jabatan', compact('jabatan'));
    }

    // 2. Menampilkan Form Tambah Jabatan Peserta
    public function create()
    {
        return view('admin.tambah-jabatan');
    }

    // 3. Menyimpan Data Jabatan Peserta Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
        ]);

        JabatanPeserta::create([
            'nama_jabatan' => $request->nama_jabatan,
        ]);

        return redirect('/data-jabatan')->with('success', 'Data Jabatan Peserta berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit Jabatan Peserta
    public function edit($id)
    {
        $jabatan = JabatanPeserta::findOrFail($id);
        return view('admin.edit-jabatan', compact('jabatan'));
    }

    // 5. Menyimpan Perubahan Data Jabatan Peserta
    public function update(Request $request, $id)
    {
        $jabatan = JabatanPeserta::findOrFail($id);

        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
        ]);

        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
        ]);

        return redirect('/data-jabatan')->with('success', 'Data Jabatan Peserta berhasil diperbarui!');
    }

    // 6. Menghapus Data Jabatan Peserta
    public function destroy($id)
    {
        $jabatan = JabatanPeserta::findOrFail($id);
        $jabatan->delete();

        return redirect('/data-jabatan')->with('success', 'Data Jabatan Peserta berhasil dihapus!');
    }
}