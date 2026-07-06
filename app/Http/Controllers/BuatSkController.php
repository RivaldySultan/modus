<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSk;
use App\Models\PesertaSk;
use App\Models\TemplateSk; // <-- PERBAIKAN 1: Import Model TemplateSk
use App\Models\JenisSk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor; 

class BuatSkController extends Controller
{
    // Menampilkan Form
    public function create()
    {
        // PERBAIKAN 2: Mengambil data template langsung dari tabel TemplateSk
        $templates = TemplateSk::with('jenisSk')->get();
        $dataKelompok = [];
        
        foreach ($templates as $template) {
            $kelompokUtama = $template->jenisSk->kelompok_sk ?? 'SK Umum';
            
            $dataKelompok[$kelompokUtama][] = [
                'nama' => $template->nama_template,
                'icon' => 'fa-file-signature',
                'desc' => 'Kategori: ' . ($template->jenisSk->nama_jenis_sk ?? '-'),
            ];
        }

        return view('user.buat-sk', compact('dataKelompok'));
    }

    // Memproses Data & Membuat File Word
    public function store(Request $request)
    {
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

        $pengajuan = PengajuanSk::create([
            'user_id'            => Auth::id(),
            'jenis_sk'           => $request->jenis_sk,
            'kelompok_sk'        => $request->kelompok_sk, // Menyimpan nama_template
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
        
        // PERBAIKAN 3: Mencari file dari tabel TemplateSk berdasarkan nama template
        $templateData = TemplateSk::where('nama_template', $request->kelompok_sk)->first();

        if ($templateData && $templateData->file_template) {
            $templatePath = storage_path('app/public/' . $templateData->file_template);
            
            if (file_exists($templatePath)) {
                $templateProcessor = new TemplateProcessor($templatePath);
                
                // PERBAIKAN 4: Samakan seluruh variabel ini dengan yang di File Word
                $templateProcessor->setValue('judul_sk', strtoupper($request->judul_sk));
                $templateProcessor->setValue('nomor_sk', $request->nomor_sk);
                $templateProcessor->setValue('tahun_anggaran', $request->tahun_anggaran);
                $templateProcessor->setValue('tanggal_ditetapkan', \Carbon\Carbon::parse($request->tanggal_ditetapkan)->translatedFormat('d F Y'));
                
                $templateProcessor->setValue('nomor_dipa', $request->nomor_dipa);
                $templateProcessor->setValue('tanggal_dipa', \Carbon\Carbon::parse($request->tanggal_dipa)->translatedFormat('d F Y'));
                $templateProcessor->setValue('kpa_nama', $request->kpa_nama);
                $templateProcessor->setValue('kpa_nip', $request->kpa_nip);

                $pesertaCount = count($request->peserta_nama);
                
                try {
                    // PERBAIKAN 5: Target clone baris menggunakan awalan 'no_urut' (karena di word = ${no_urut#1})
                    $templateProcessor->cloneRow('no_urut', $pesertaCount);

                    for ($i = 0; $i < $pesertaCount; $i++) {
                        $rowNum = $i + 1;
                        $templateProcessor->setValue('no_urut#' . $rowNum, $rowNum);
                        $templateProcessor->setValue('peserta_nama#' . $rowNum, $request->peserta_nama[$i]);
                        $templateProcessor->setValue('peserta_nip#' . $rowNum, $request->peserta_nip[$i] ?? '-');
                        $templateProcessor->setValue('peserta_jab#' . $rowNum, $request->peserta_jab[$i] ?? '-');
                        $templateProcessor->setValue('peserta_hnr#' . $rowNum, $request->peserta_hnr[$i] ?? '0');
                    }
                } catch (\Exception $e) {
                    // Abaikan jika error saat mengkloning tabel
                }

                $outputFileName = 'SK_' . time() . '_' . str_replace(['/', '\\'], '_', $request->nomor_sk) . '.docx';
                $arsipDir = storage_path('app/public/arsip_sk');
                if (!file_exists($arsipDir)) {
                    mkdir($arsipDir, 0777, true);
                }

                $outputPath = $arsipDir . '/' . $outputFileName;
                $templateProcessor->saveAs($outputPath);

                // Update database pengajuan agar menyimpan lokasi file hasil jadinya
                $pengajuan->update(['file_sk' => 'arsip_sk/' . $outputFileName]);
            }
        }

        return redirect('/user/dashboard')->with('success', 'Pengajuan SK berhasil dikirim dan dokumen selesai digenerate otomatis!');
    }
}