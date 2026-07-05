<?php

namespace App\Http\Controllers;

use App\Models\TemplateSk;
use App\Models\JenisSk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateSkController extends Controller
{
    public function index()
    {
        $templates = TemplateSk::with('jenisSk')->latest()->get();
        return view('admin.daftar-template', compact('templates'));
    }

    public function create()
    {
        $jenisSks = JenisSk::all();
        return view('admin.upload-template', compact('jenisSks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_template' => 'required|string|max:255',
            'jenis_sk_id'   => 'required|exists:jenis_sks,id',
            'file_template' => 'required|file|mimes:docx|max:5120',
        ]);

        $file = $request->file('file_template');
        $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $filePath = $file->storeAs('templates', $fileName, 'public');

        TemplateSk::create([
            'nama_template' => $request->nama_template,
            'jenis_sk_id'   => $request->jenis_sk_id,
            'file_template' => $filePath, // <-- SUDAH DISESUAIKAN DENGAN DATABASE
        ]);

        return redirect('/daftar-template')->with('success', 'Template SK berhasil diunggah!');
    }

    public function edit($id)
    {
        $template = TemplateSk::findOrFail($id);
        $jenisSks = JenisSk::all();
        return view('admin.edit-template', compact('template', 'jenisSks'));
    }

    public function update(Request $request, $id)
    {
        $template = TemplateSk::findOrFail($id);

        $request->validate([
            'nama_template' => 'required|string|max:255',
            'jenis_sk_id'   => 'required|exists:jenis_sks,id',
            'file_template' => 'nullable|file|mimes:docx|max:5120',
        ]);

        $filePath = $template->file_template;

        if ($request->hasFile('file_template')) {
            if ($template->file_template && Storage::disk('public')->exists($template->file_template)) {
                Storage::disk('public')->delete($template->file_template);
            }
            $file = $request->file('file_template');
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $filePath = $file->storeAs('templates', $fileName, 'public');
        }

        $template->update([
            'nama_template' => $request->nama_template,
            'jenis_sk_id'   => $request->jenis_sk_id,
            'file_template' => $filePath, // <-- SUDAH DISESUAIKAN
        ]);

        return redirect('/daftar-template')->with('success', 'Template SK berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $template = TemplateSk::findOrFail($id);
        
        if ($template->file_template && Storage::disk('public')->exists($template->file_template)) {
            Storage::disk('public')->delete($template->file_template);
        }
        
        $template->delete();

        return redirect('/daftar-template')->with('success', 'Template SK berhasil dihapus!');
    }
}