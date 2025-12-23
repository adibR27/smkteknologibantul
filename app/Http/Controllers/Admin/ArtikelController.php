<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::with('penulis')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:berita,pengumuman,kegiatan,lainnya',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_publish' => 'nullable|date',
        ]);

        $artikel = new Artikel();
        $artikel->judul = $request->judul;
        $artikel->slug = Str::slug($request->judul);
        $artikel->konten = Purifier::clean($request->konten);
        $artikel->kategori = $request->kategori;
        $artikel->penulis_id = Auth::guard('admin')->id();
        $artikel->tanggal_publish = $request->tanggal_publish ?? now();

        // Handle gambar upload
        if ($request->hasFile('gambar_utama')) {
            $artikel->gambar_utama = $request->file('gambar_utama')->store('artikel', 'public');
        }

        $artikel->save();

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:berita,pengumuman,kegiatan,lainnya',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_publish' => 'nullable|date',
        ]);

        $artikel->judul = $request->judul;
        $artikel->slug = Str::slug($request->judul);
        $artikel->konten = Purifier::clean($request->konten);
        $artikel->kategori = $request->kategori;
        $artikel->tanggal_publish = $request->tanggal_publish;

        // Handle gambar upload
        if ($request->hasFile('gambar_utama')) {
            // Hapus gambar lama
            if ($artikel->gambar_utama && Storage::disk('public')->exists($artikel->gambar_utama)) {
                Storage::disk('public')->delete($artikel->gambar_utama);
            }
            $artikel->gambar_utama = $request->file('gambar_utama')->store('artikel', 'public');
        }

        $artikel->save();

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        // Hapus gambar jika ada
        if ($artikel->gambar_utama && Storage::disk('public')->exists($artikel->gambar_utama)) {
            Storage::disk('public')->delete($artikel->gambar_utama);
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }
    
    /**
     * Upload gambar dari TinyMCE Editor
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $path = $request->file('file')->store('artikel/images', 'public');

            return response()->json([
                'location' => asset('storage/' . $path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Upload gagal: ' . $e->getMessage()
            ], 500);
        }
    }
}
