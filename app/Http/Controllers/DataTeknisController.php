<?php

namespace App\Http\Controllers;

use App\Models\DataTeknis;
use Illuminate\Http\Request;

class DataTeknisController extends Controller
{
    // 1. Menampilkan Halaman Daftar Data Teknis
    public function index()
    {
        $dataTeknis = DataTeknis::latest()->get();
        return view('admin.data-teknis', compact('dataTeknis'));
    }

    // 2. Menampilkan Form Tambah Data Teknis
    public function create()
    {
        return view('admin.tambah-teknis');
    }

    // 3. Menyimpan Data Teknis Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'nama_teknis' => 'required|string|max:255',
            'kode_teknis' => 'nullable|string|max:50',
            'keterangan'  => 'nullable|string',
        ]);

        DataTeknis::create([
            'nama_teknis' => $request->nama_teknis,
            'kode_teknis' => $request->kode_teknis,
            'keterangan'  => $request->keterangan,
        ]);

        return redirect('/data-teknis')->with('success', 'Data Teknis berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit Data Teknis
    public function edit($id)
    {
        $teknis = DataTeknis::findOrFail($id);
        return view('admin.edit-teknis', compact('teknis'));
    }

    // 5. Menyimpan Perubahan Data Teknis
    public function update(Request $request, $id)
    {
        $teknis = DataTeknis::findOrFail($id);

        $request->validate([
            'nama_teknis' => 'required|string|max:255',
            'kode_teknis' => 'nullable|string|max:50',
            'keterangan'  => 'nullable|string',
        ]);

        $teknis->update([
            'nama_teknis' => $request->nama_teknis,
            'kode_teknis' => $request->kode_teknis,
            'keterangan'  => $request->keterangan,
        ]);

        return redirect('/data-teknis')->with('success', 'Data Teknis berhasil diperbarui!');
    }

    // 6. Menghapus Data Teknis
    public function destroy($id)
    {
        $teknis = DataTeknis::findOrFail($id);
        $teknis->delete();

        return redirect('/data-teknis')->with('success', 'Data Teknis berhasil dihapus!');
    }
}