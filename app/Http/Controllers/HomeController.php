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
        $artikel = Artikel::orderBy('tanggal_publish', 'desc')->get();

        return view('home', compact('carousel', 'kepalaSekolah', 'jurusan', 'artikel'));
    }
}
