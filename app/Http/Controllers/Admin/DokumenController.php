<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.dokumen.index', compact('dokumens'));
    }

    public function create()
    {
        return view('admin.dokumen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:kurikulum,panduan,jadwal,lainnya',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240', // Max 10MB
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('dokumen', $fileName, 'public');

        Dokumen::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'nama_file' => $fileName,
            'path_file' => $filePath,
            'ukuran_file' => $file->getSize(),
            'kategori' => $request->kategori,
            'uploaded_by' => Auth::guard('admin')->id(),
        ]);

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('admin.dokumen.edit', compact('dokumen'));
    }

    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:kurikulum,panduan,jadwal,lainnya',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
        ]);

        $dokumen->judul = $request->judul;
        $dokumen->deskripsi = $request->deskripsi;
        $dokumen->kategori = $request->kategori;

        // Handle file update
        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($dokumen->path_file && Storage::disk('public')->exists($dokumen->path_file)) {
                Storage::disk('public')->delete($dokumen->path_file);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('dokumen', $fileName, 'public');

            $dokumen->nama_file = $fileName;
            $dokumen->path_file = $filePath;
            $dokumen->ukuran_file = $file->getSize();
        }

        $dokumen->save();

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // Hapus file
        if ($dokumen->path_file && Storage::disk('public')->exists($dokumen->path_file)) {
            Storage::disk('public')->delete($dokumen->path_file);
        }

        $dokumen->delete();

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil dihapus!');
    }

    public function download($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $filePath = storage_path('app/public/' . $dokumen->path_file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath, $dokumen->nama_file);
    }
}
