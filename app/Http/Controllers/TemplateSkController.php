<?php

namespace App\Http\Controllers;

use App\Models\TemplateSk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class TemplateSkController extends Controller
{
    // Menampilkan daftar template
    public function index()
    {
        $templates = TemplateSk::latest()->get();
        return view('admin.daftar-template', compact('templates'));
    }

    // Menampilkan halaman form upload
    public function create()
    {
        return view('admin.upload-template');
    }

    // Memproses upload file dan menyimpan ke database
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_template' => 'required|string|max:255', // Typo 'requiread' sudah diperbaiki
            'file_template' => 'required|file|mimes:doc,docx,pdf|max:5120',
            'keterangan'    => 'required|string', 
        ]);

        try {
            // 2. Proses penyimpanan file
            if ($request->hasFile('file_template')) {
                $file = $request->file('file_template');
                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Simpan ke 'storage/app/public/templates'
                $path = $file->storeAs('templates', $filename, 'public');

                // 3. Simpan ke database
                TemplateSk::create([
                    'nama_template' => $request->nama_template,
                    'file_template' => $path,
                    'keterangan'    => $request->keterangan,
                ]);

                return redirect('/daftar-template')->with('success', 'Template berhasil diunggah!');
            }
        } catch (\Exception $e) {
            // Jika ada error sistem (misal: folder tidak bisa ditulis)
            Log::error('Upload gagal: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan sistem saat mengunggah file.']);
        }

        return back()->withErrors(['file_template' => 'File tidak valid atau gagal diunggah.']);
    }

    // Menampilkan halaman form edit
    public function edit($id)
    {
        $template = TemplateSk::findOrFail($id);
        return view('admin.edit-template', compact('template'));
    }

    // Memproses update data dan file ke database
    public function update(Request $request, $id)
    {
        $template = TemplateSk::findOrFail($id);

        // Validasi input edit
        $request->validate([
            'nama_template' => 'required|string|max:255',
            'keterangan'    => 'required|string',
            // file_template menjadi nullable karena user mungkin hanya ingin mengedit namanya saja
            'file_template' => 'nullable|file|mimes:doc,docx,pdf|max:5120', 
        ]);

        // Path default menggunakan file yang sudah ada
        $path = $template->file_template;

        // Jika user memilih file dokumen baru
        if ($request->hasFile('file_template')) {
            // Hapus file lama dari folder storage
            if (Storage::disk('public')->exists($template->file_template)) {
                Storage::disk('public')->delete($template->file_template);
            }
            
            // Simpan file baru
            $file = $request->file('file_template');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('templates', $filename, 'public');
        }

        // Update data di database
        $template->update([
            'nama_template' => $request->nama_template,
            'file_template' => $path,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect('/daftar-template')->with('success', 'Template berhasil diperbarui!');
    }

    // Memproses hapus data dan hapus file fisiknya
    public function destroy($id)
    {
        $template = TemplateSk::findOrFail($id);

        // Hapus file fisik dari storage
        if ($template->file_template && Storage::disk('public')->exists($template->file_template)) {
            Storage::disk('public')->delete($template->file_template);
        }

        $template->delete();

        return redirect('/daftar-template')->with('success', 'Template berhasil dihapus!');
    }
}