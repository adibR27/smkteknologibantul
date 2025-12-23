<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelPublicController extends Controller
{
    /**
     * Menampilkan daftar artikel publik
     */
    public function index(Request $request)
    {
        $query = Artikel::with('penulis')
            ->where('tanggal_publish', '<=', now())
            ->orderBy('tanggal_publish', 'desc');

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Search berdasarkan judul
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'LIKE', '%' . $request->search . '%');
        }

        $artikels = $query->paginate(9);
        
        // Artikel terpopuler (berdasarkan views)
        $popularArtikels = Artikel::where('tanggal_publish', '<=', now())
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        // Kategori untuk filter
        $kategoris = ['berita', 'pengumuman', 'kegiatan', 'lainnya'];

        return view('artikel.index', compact('artikels', 'popularArtikels', 'kategoris'));
    }

    /**
     * Menampilkan detail artikel
     */
    public function show($slug)
    {
        $artikel = Artikel::with('penulis')
            ->where('slug', $slug)
            ->where('tanggal_publish', '<=', now())
            ->firstOrFail();

        // Increment views
        $artikel->increment('views');

        // Artikel terkait (kategori yang sama)
        $relatedArtikels = Artikel::where('kategori', $artikel->kategori)
            ->where('id', '!=', $artikel->id)
            ->where('tanggal_publish', '<=', now())
            ->orderBy('tanggal_publish', 'desc')
            ->take(3)
            ->get();

        return view('artikel.show', compact('artikel', 'relatedArtikels'));
    }
}