<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSk;
use App\Models\PesertaSk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuatSkController extends Controller
{
    // Menampilkan halaman form Buat SK
    public function create()
    {
        return view('user.buat-sk');
    }

    // Memproses data yang dikirim dari form
    public function store(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'jenis_sk'           => 'required|string',
            'kelompok_sk'        => 'required|string',
            'judul_sk'           => 'required|string|max:255',
            'nomor_sk'           => 'required|string|max:255|unique:pengajuan_sks,nomor_sk',
            'tahun_anggaran'     => 'required|digits:4',
            'tanggal_ditetapkan' => 'required|date',
            'nomor_dipa'         => 'required|string|max:255',
            'tanggal_dipa'       => 'required|date',
            'kpa_nama'           => 'required|string|max:255',
            'kpa_nip'            => 'required|string|max:255',
            // Validasi array peserta
            'peserta_nama'       => 'required|array|min:1',
            'peserta_nama.*'     => 'required|string|max:255',
            'peserta_nip.*'      => 'required|string|max:255',
            'peserta_jab.*'      => 'required|string|max:255',
            'peserta_hnr.*'      => 'required|string|max:255',
        ]);

        // 2. Simpan Data ke Tabel pengajuan_sks
        $pengajuan = PengajuanSk::create([
            'user_id'            => Auth::id(), // ID user yang sedang login
            'jenis_sk'           => $request->jenis_sk,
            'kelompok_sk'        => $request->kelompok_sk,
            'judul_sk'           => $request->judul_sk,
            'nomor_sk'           => $request->nomor_sk,
            'tahun_anggaran'     => $request->tahun_anggaran,
            'tanggal_ditetapkan' => $request->tanggal_ditetapkan,
            'nomor_dipa'         => $request->nomor_dipa,
            'tanggal_dipa'       => $request->tanggal_dipa,
            'kpa_nama'           => $request->kpa_nama,
            'kpa_nip'            => $request->kpa_nip,
            'status_pengajuan'   => 'Diproses',
        ]);

        // 3. Simpan Data Dinamis Peserta ke Tabel peserta_sks
        foreach ($request->peserta_nama as $index => $nama) {
            PesertaSk::create([
                'pengajuan_sk_id' => $pengajuan->id,
                'nama_pegawai'    => $nama,
                'nip_pegawai'     => $request->peserta_nip[$index],
                'jabatan'         => $request->peserta_jab[$index],
                'honor'           => $request->peserta_hnr[$index],
            ]);
        }

        // 4. Redirect ke Dashboard User dengan pesan sukses
        return redirect('/user/dashboard')->with('success', 'Pengajuan SK berhasil dikirim dan sedang diproses!');
    }
}