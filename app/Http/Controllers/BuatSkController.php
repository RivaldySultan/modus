<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSk;
use App\Models\PesertaSk;
use App\Models\TemplateSk;
// IMPORT SEMUA MASTER DATA
use App\Models\KegiatanTeknis;
use App\Models\DataTeknis;
use App\Models\DataKpa;
use App\Models\DataPegawai;
use App\Models\JabatanPeserta;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor; 

class BuatSkController extends Controller
{
    // =====================================================================
    // 1. TAMPILAN BUAT SK BARU
    // =====================================================================
    public function create()
    {
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

        // MENGAMBIL SEMUA MASTER DATA UNTUK AUTO-FILL
        $kegiatanTeknis = KegiatanTeknis::latest()->get();
        $dataDipa = DataKpa::latest()->get();
        $dataKpa = DataKpa::latest()->get();
        $dataPegawai = DataPegawai::orderBy('nama', 'asc')->get();
        $dataJabatan = JabatanPeserta::orderBy('nama_jabatan', 'asc')->get();

        return view('user.buat-sk', compact(
            'dataKelompok', 
            'kegiatanTeknis', 
            'dataDipa', 
            'dataKpa', 
            'dataPegawai', 
            'dataJabatan'
        ));
    }

    // =====================================================================
    // 2. SIMPAN PENGAJUAN SK BARU
    // =====================================================================
    public function store(Request $request)
    {
        // Validasi input
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
            'peserta_nama.*'     => 'required|string', 
        ]);

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
            'status_pengajuan'   => 'Diproses',
        ]);

        // Simpan Data Pegawai/Peserta
        foreach ($request->peserta_nama as $index => $nama) {
            if (empty($nama)) continue; 

            PesertaSk::create([
                'pengajuan_sk_id' => $pengajuan->id,
                'nama_pegawai'    => $nama,
                'nip_pegawai'     => $request->peserta_nip[$index] ?? '-',
                'jabatan'         => $request->peserta_jab[$index] ?? '-',
                'honor'           => $request->peserta_hnr[$index] ?? '0',
            ]);
        }

        // PROSES GENERATE WORD
        $templateData = TemplateSk::where('nama_template', $request->kelompok_sk)->first();

        if ($templateData && $templateData->file_template) {
            $templatePath = storage_path('app/public/' . $templateData->file_template);
            
            if (file_exists($templatePath)) {
                $templateProcessor = new TemplateProcessor($templatePath);
                
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
                    $templateProcessor->cloneRow('no_urut', $pesertaCount);
                    for ($i = 0; $i < $pesertaCount; $i++) {
                        $rowNum = $i + 1;
                        $templateProcessor->setValue('no_urut#' . $rowNum, $rowNum);
                        $templateProcessor->setValue('peserta_nama#' . $rowNum, $request->peserta_nama[$i]);
                        $templateProcessor->setValue('peserta_nip#' . $rowNum, $request->peserta_nip[$i] ?? '-');
                        $templateProcessor->setValue('peserta_jab#' . $rowNum, $request->peserta_jab[$i] ?? '-');
                        $templateProcessor->setValue('peserta_hnr#' . $rowNum, $request->peserta_hnr[$i] ?? '0');
                    }
                } catch (\Exception $e) {}

                $outputFileName = 'SK_' . time() . '_' . str_replace(['/', '\\'], '_', $request->nomor_sk) . '.docx';
                $arsipDir = storage_path('app/public/arsip_sk');
                if (!file_exists($arsipDir)) {
                    mkdir($arsipDir, 0777, true);
                }

                $outputPath = $arsipDir . '/' . $outputFileName;
                $templateProcessor->saveAs($outputPath);

                $pengajuan->update(['file_sk' => 'arsip_sk/' . $outputFileName]);
            }
        }

        return redirect('/user/dashboard')->with('success', 'Pengajuan SK berhasil dikirim dan dokumen selesai digenerate!');
    }

    // =====================================================================
    // 3. TAMPILAN FORM EDIT SK (REVISI)
    // =====================================================================
    public function edit($id)
    {
        // Cari data SK dan pastikan itu milik user yang sedang login
        $sk = PengajuanSk::with('peserta_sks')->where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

        // Regenerate Data Template untuk modal
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

        // AMBIL ULANG SEMUA MASTER DATA UNTUK DROPDOWN DI HALAMAN EDIT
        $kegiatanTeknis = KegiatanTeknis::latest()->get();
        $dataDipa = DataKpa::latest()->get();
        $dataKpa = DataKpa::latest()->get();
        $dataPegawai = DataPegawai::orderBy('nama', 'asc')->get();
        $dataJabatan = JabatanPeserta::orderBy('nama_jabatan', 'asc')->get();

        return view('user.edit-sk', compact(
            'sk', 
            'dataKelompok', 
            'kegiatanTeknis', 
            'dataDipa', 
            'dataKpa', 
            'dataPegawai', 
            'dataJabatan'
        ));
    }

    // =====================================================================
    // 4. SIMPAN HASIL REVISI DAN GENERATE ULANG DOKUMEN
    // =====================================================================
    public function update(Request $request, $id)
    {
        // Validasi: pastikan nomor_sk unik, tapi abaikan ID milik dokumen ini
        $request->validate([
            'jenis_sk'           => 'required|string',
            'kelompok_sk'        => 'required|string',
            'judul_sk'           => 'required|string|max:255',
            'nomor_sk'           => 'required|string|max:255|unique:pengajuan_sks,nomor_sk,' . $id,
            'tahun_anggaran'     => 'required|digits:4',
            'tanggal_ditetapkan' => 'required|date',
            'nomor_dipa'         => 'required|string|max:255',
            'tanggal_dipa'       => 'required|date',
            'kpa_nama'           => 'required|string|max:255',
            'kpa_nip'            => 'required|string|max:255',
            'peserta_nama'       => 'required|array|min:1',
            'peserta_nama.*'     => 'required|string',
        ]);

        $sk = PengajuanSk::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // 1. Update data utama
        $sk->jenis_sk = $request->jenis_sk;
        $sk->kelompok_sk = $request->kelompok_sk;
        $sk->judul_sk = $request->judul_sk;
        $sk->nomor_sk = $request->nomor_sk;
        $sk->tahun_anggaran = $request->tahun_anggaran;
        $sk->tanggal_ditetapkan = $request->tanggal_ditetapkan;
        $sk->nomor_dipa = $request->nomor_dipa;
        $sk->tanggal_dipa = $request->tanggal_dipa;
        $sk->kpa_nama = $request->kpa_nama;
        $sk->kpa_nip = $request->kpa_nip;
        $sk->status_pengajuan = 'Diproses'; // Reset status kembali masuk antrean admin
        $sk->catatan = null; // Hapus catatan revisi
        $sk->save();

        // 2. Update Pegawai/Peserta (Hapus semua yang lama, simpan ulang yang baru)
        PesertaSk::where('pengajuan_sk_id', $sk->id)->delete();
        
        foreach ($request->peserta_nama as $index => $nama) {
            if (empty($nama)) continue; 

            PesertaSk::create([
                'pengajuan_sk_id' => $sk->id,
                'nama_pegawai'    => $nama,
                'nip_pegawai'     => $request->peserta_nip[$index] ?? '-',
                'jabatan'         => $request->peserta_jab[$index] ?? '-',
                'honor'           => $request->peserta_hnr[$index] ?? '0',
            ]);
        }

        // 3. GENERATE ULANG DOKUMEN WORD KARENA DATA BERUBAH
        $templateData = TemplateSk::where('nama_template', $request->kelompok_sk)->first();

        if ($templateData && $templateData->file_template) {
            $templatePath = storage_path('app/public/' . $templateData->file_template);
            
            if (file_exists($templatePath)) {
                $templateProcessor = new TemplateProcessor($templatePath);
                
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
                    $templateProcessor->cloneRow('no_urut', $pesertaCount);
                    for ($i = 0; $i < $pesertaCount; $i++) {
                        $rowNum = $i + 1;
                        $templateProcessor->setValue('no_urut#' . $rowNum, $rowNum);
                        $templateProcessor->setValue('peserta_nama#' . $rowNum, $request->peserta_nama[$i]);
                        $templateProcessor->setValue('peserta_nip#' . $rowNum, $request->peserta_nip[$i] ?? '-');
                        $templateProcessor->setValue('peserta_jab#' . $rowNum, $request->peserta_jab[$i] ?? '-');
                        $templateProcessor->setValue('peserta_hnr#' . $rowNum, $request->peserta_hnr[$i] ?? '0');
                    }
                } catch (\Exception $e) {}

                // (Opsional tapi direkomendasikan) Hapus file fisik word yang lama agar tidak menumpuk
                if ($sk->file_sk && file_exists(storage_path('app/public/' . $sk->file_sk))) {
                    @unlink(storage_path('app/public/' . $sk->file_sk));
                }

                $outputFileName = 'SK_REVISI_' . time() . '_' . str_replace(['/', '\\'], '_', $request->nomor_sk) . '.docx';
                $arsipDir = storage_path('app/public/arsip_sk');
                if (!file_exists($arsipDir)) {
                    mkdir($arsipDir, 0777, true);
                }

                $outputPath = $arsipDir . '/' . $outputFileName;
                $templateProcessor->saveAs($outputPath);

                // Update path database dengan file word yang baru digenerate
                $sk->update(['file_sk' => 'arsip_sk/' . $outputFileName]);
            }
        }

        return redirect('/user/dashboard')->with('success', 'Dokumen berhasil direvisi dan telah diajukan ulang!');
    }
}