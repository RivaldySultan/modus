<?php

namespace App\Http\Controllers;

use App\Models\KegiatanTeknis;
use Illuminate\Http\Request;

class KegiatanTeknisController extends Controller
{
    public function index()
    {
        $kegiatan = KegiatanTeknis::latest()->get();
        return view('admin.kegiatan-teknis', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.tambah-kegiatan-teknis');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_teknis' => 'required|string|max:255',
            'nama_survei' => 'required|string|max:255',
            'periode'     => 'required|string|max:255',
        ]);

        KegiatanTeknis::create($request->all());

        return redirect('/kegiatan-teknis')->with('success', 'Data Kegiatan Teknis berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kegiatan = KegiatanTeknis::findOrFail($id);
        return view('admin.edit-kegiatan-teknis', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_teknis' => 'required|string|max:255',
            'nama_survei' => 'required|string|max:255',
            'periode'     => 'required|string|max:255',
        ]);

        $kegiatan = KegiatanTeknis::findOrFail($id);
        $kegiatan->update($request->all());

        return redirect('/kegiatan-teknis')->with('success', 'Data Kegiatan Teknis berhasil diperbarui!');
    }

    public function destroy($id)
    {
        KegiatanTeknis::findOrFail($id)->delete();
        return redirect('/kegiatan-teknis')->with('success', 'Data Kegiatan Teknis berhasil dihapus!');
    }
}