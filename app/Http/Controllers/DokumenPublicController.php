<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenPublicController extends Controller
{
    /**
     * Tampilkan halaman daftar dokumen publik
     */
    public function index(Request $request)
    {
        $kategori = $request->get('kategori');

        $query = Dokumen::orderBy('created_at', 'desc');

        // Filter berdasarkan kategori jika ada
        if ($kategori && in_array($kategori, ['kurikulum', 'panduan', 'jadwal', 'lainnya'])) {
            $query->where('kategori', $kategori);
        }

        $dokumens = $query->paginate(12);

        // Hitung jumlah dokumen per kategori
        $jumlahPerKategori = [
            'semua' => Dokumen::count(),
            'kurikulum' => Dokumen::where('kategori', 'kurikulum')->count(),
            'panduan' => Dokumen::where('kategori', 'panduan')->count(),
            'jadwal' => Dokumen::where('kategori', 'jadwal')->count(),
            'lainnya' => Dokumen::where('kategori', 'lainnya')->count(),
        ];

        return view('dokumen.index', compact('dokumens', 'kategori', 'jumlahPerKategori'));
    }

    /**
     * Download dokumen
     */
    public function download($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $filePath = storage_path('app/public/' . $dokumen->path_file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath, $dokumen->nama_file);
    }

    /**
     * Preview/detail dokumen
     */
    public function show($id)
    {
        $dokumen = Dokumen::with('uploader')->findOrFail($id);

        // Dokumen terkait (sama kategori)
        $dokumenTerkait = Dokumen::where('kategori', $dokumen->kategori)
            ->where('id', '!=', $dokumen->id)
            ->limit(4)
            ->get();

        return view('dokumen.show', compact('dokumen', 'dokumenTerkait'));
    }
}
