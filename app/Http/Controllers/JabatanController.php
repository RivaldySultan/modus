<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    // 1. Menampilkan Halaman Data Jabatan
    public function index()
    {
        $jabatans = Jabatan::latest()->get();
        return view('admin.data-jabatan', compact('jabatans'));
    }

    // 2. Menampilkan Form Tambah Jabatan (Opsional jika pakai Modal/Pop-up)
    // Jika nanti kamu pakai halaman terpisah, kita akan buat view 'admin.tambah-jabatan'
    public function create()
    {
        return view('admin.tambah-jabatan');
    }

    // 3. Menyimpan Data Jabatan Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan',
            'keterangan'   => 'nullable|string',
        ],[
            'nama_jabatan.unique' => 'Nama jabatan ini sudah ada di database.'
        ]);

        Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
            'keterangan'   => $request->keterangan,
        ]);

        return redirect('/data-jabatan')->with('success', 'Data Jabatan berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit Jabatan
    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('admin.edit-jabatan', compact('jabatan'));
    }

    // 5. Menyimpan Perubahan Data Jabatan
    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        $request->validate([
            // Pengecualian unique ID agar nama jabatan yang sama untuk ID ini tidak error saat disave ulang
            'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan,' . $id,
            'keterangan'   => 'nullable|string',
        ]);

        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
            'keterangan'   => $request->keterangan,
        ]);

        return redirect('/data-jabatan')->with('success', 'Data Jabatan berhasil diperbarui!');
    }

    // 6. Menghapus Data Jabatan
    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return redirect('/data-jabatan')->with('success', 'Data Jabatan berhasil dihapus!');
    }
}