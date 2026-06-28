<?php

namespace App\Http\Controllers;

use App\Models\DataPegawai;
use Illuminate\Http\Request;

class DataPegawaiController extends Controller
{
    public function index()
    {
        $pegawai = DataPegawai::latest()->get();
        return view('admin.data-pegawai', compact('pegawai'));
    }

    public function create()
    {
        return view('admin.tambah-pegawai');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:255',
            'status_pegawai' => 'required|string|max:50',
            'status_lainnya' => 'nullable|string|max:255', // Validasi input ketikan manual
            'nip'            => 'required|string|max:50',
            'alamat'         => 'nullable|string',
            'no_telepon'     => 'nullable|string|max:20',
        ]);

        // Cek jika pilihannya Mitra Lainnya, gunakan teks yang diketik admin
        $finalStatus = $request->status_pegawai;
        if ($finalStatus === 'Mitra Lainnya' && $request->filled('status_lainnya')) {
            $finalStatus = $request->status_lainnya;
        }

        DataPegawai::create([
            'nama'           => $request->nama,
            'status_pegawai' => $finalStatus,
            'nip'            => $request->nip,
            'alamat'         => $request->alamat,
            'no_telepon'     => $request->no_telepon,
        ]);

        return redirect('/data-pegawai')->with('success', 'Data Pegawai berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pegawai = DataPegawai::findOrFail($id);
        return view('admin.edit-pegawai', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = DataPegawai::findOrFail($id);

        $request->validate([
            'nama'           => 'required|string|max:255',
            'status_pegawai' => 'required|string|max:50',
            'status_lainnya' => 'nullable|string|max:255',
            'nip'            => 'required|string|max:50',
            'alamat'         => 'nullable|string',
            'no_telepon'     => 'nullable|string|max:20',
        ]);

        $finalStatus = $request->status_pegawai;
        if ($finalStatus === 'Mitra Lainnya' && $request->filled('status_lainnya')) {
            $finalStatus = $request->status_lainnya;
        }

        $pegawai->update([
            'nama'           => $request->nama,
            'status_pegawai' => $finalStatus,
            'nip'            => $request->nip,
            'alamat'         => $request->alamat,
            'no_telepon'     => $request->no_telepon,
        ]);

        return redirect('/data-pegawai')->with('success', 'Data Pegawai berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pegawai = DataPegawai::findOrFail($id);
        $pegawai->delete();

        return redirect('/data-pegawai')->with('success', 'Data Pegawai berhasil dihapus!');
    }
}