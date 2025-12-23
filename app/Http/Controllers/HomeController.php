<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\KepalaSekolah;
use App\Models\Jurusan;
use App\Models\Artikel;

class HomeController extends Controller
{
    public function index()
    {
        $carousel = Carousel::all();
        $kepalaSekolah = KepalaSekolah::all();
        $jurusan = Jurusan::all();
        
        // Hanya tampilkan artikel yang sudah dipublish
        $artikel = Artikel::with('penulis')
            ->where('tanggal_publish', '<=', now())
            ->orderBy('tanggal_publish', 'desc')
            ->take(3) // Ambil 3 artikel terbaru untuk homepage
            ->get();

        return view('home', compact('carousel', 'kepalaSekolah', 'jurusan', 'artikel'));
    }
}