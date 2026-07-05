<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSk;
use App\Models\PesertaSk;
use App\Models\JenisSk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// WAJIB IMPORT LIBRARY PHPWORD
use PhpOffice\PhpWord\TemplateProcessor; 

class BuatSkController extends Controller
{
    // Menampilkan Form
    public function create()
    {
        $jenisSks = JenisSk::all();
        $dataKelompok = [];
        foreach ($jenisSks as $jenis) {
            $dataKelompok[$jenis->kelompok_sk][] = [
                'nama' => $jenis->nama_jenis_sk,
                'icon' => 'fa-file-signature',
                'desc' => 'Periode: ' . ($jenis->periode ?? 'Umum'),
            ];
        }

        return view('user.buat-sk', compact('dataKelompok'));
    }

    // Memproses Data & Membuat File Word
    public function store(Request $request)
    {
        // 1. Validasi Input Form
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
            'peserta_nama'       => 'required|array|min:1',
        ]);

        // 2. Simpan Data ke Database
        $pengajuan = PengajuanSk::create([
            'user_id'            => Auth::id(),
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
            'status_pengajuan'   => 'Diproses', // Status awal
        ]);

        foreach ($request->peserta_nama as $index => $nama) {
            PesertaSk::create([
                'pengajuan_sk_id' => $pengajuan->id,
                'nama_pegawai'    => $nama,
                'nip_pegawai'     => $request->peserta_nip[$index] ?? '-',
                'jabatan'         => $request->peserta_jab[$index] ?? '-',
                'honor'           => $request->peserta_hnr[$index] ?? '0',
            ]);
        }

        // =========================================================
        // 3. PROSES "SIHIR" GENERATE DOKUMEN WORD (.docx)
        // =========================================================
        
        // Cari template yang cocok berdasarkan Jenis SK yang dipilih
        $jenisData = JenisSk::where('kelompok_sk', $request->jenis_sk)
                            ->where('nama_jenis_sk', $request->kelompok_sk)
                            ->first();

        if ($jenisData && $jenisData->file_template) {
            $templatePath = storage_path('app/public/' . $jenisData->file_template);
            
            if (file_exists($templatePath)) {
                // Panggil PHPWord TemplateProcessor
                $templateProcessor = new TemplateProcessor($templatePath);
                
                // Ganti variabel teks biasa
                $templateProcessor->setValue('judul', strtoupper($request->judul_sk));
                $templateProcessor->setValue('no', $request->nomor_sk);
                $templateProcessor->setValue('thn', $request->tahun_anggaran);
                $templateProcessor->setValue('tgl_sk', \Carbon\Carbon::parse($request->tanggal_ditetapkan)->translatedFormat('d F Y'));
                $templateProcessor->setValue('kpa', $request->kpa_nama);
                $templateProcessor->setValue('nip_kpa', $request->kpa_nip);

                // Ganti variabel di dalam tabel (Peserta/Lampiran)
                $pesertaCount = count($request->peserta_nama);
                
                try {
                    // Fitur cloneRow akan menggandakan baris tabel sesuai jumlah peserta
                    // WAJIB ADA variabel ${nama} di dalam tabel template Word-nya
                    $templateProcessor->cloneRow('nama', $pesertaCount);

                    for ($i = 0; $i < $pesertaCount; $i++) {
                        $rowNum = $i + 1;
                        $templateProcessor->setValue('no_urut#' . $rowNum, $rowNum);
                        $templateProcessor->setValue('nama#' . $rowNum, $request->peserta_nama[$i]);
                        $templateProcessor->setValue('nip#' . $rowNum, $request->peserta_nip[$i]);
                        $templateProcessor->setValue('jab#' . $rowNum, $request->peserta_jab[$i]);
                        $templateProcessor->setValue('hnr#' . $rowNum, $request->peserta_hnr[$i]);
                    }
                } catch (\Exception $e) {
                    // Abaikan jika template tidak memiliki tabel peserta
                }

                // Buat nama file unik & siapkan folder
                $outputFileName = 'SK_' . time() . '_' . str_replace(['/', '\\'], '_', $request->nomor_sk) . '.docx';
                $arsipDir = storage_path('app/public/arsip_sk');
                if (!file_exists($arsipDir)) {
                    mkdir($arsipDir, 0777, true);
                }

                // Simpan file hasil generate
                $outputPath = $arsipDir . '/' . $outputFileName;
                $templateProcessor->saveAs($outputPath);

                // Update path dokumen ke dalam database
                $pengajuan->update(['file_sk' => 'arsip_sk/' . $outputFileName]);
            }
        }

        return redirect('/user/dashboard')->with('success', 'Pengajuan SK berhasil dikirim dan dokumen selesai digenerate otomatis!');
    }
}