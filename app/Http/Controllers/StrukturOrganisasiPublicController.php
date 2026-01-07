<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiPublicController extends Controller
{
    private $gambarPath = 'struktur-organisasi/struktur.jpg';

    /**
     * Display struktur organisasi for public
     */
    public function index()
    {
        $gambarExists = Storage::disk('public')->exists($this->gambarPath);

        if (!$gambarExists) {
            abort(404, 'Struktur Organisasi belum tersedia');
        }

        $gambarUrl = asset('storage/' . $this->gambarPath);

        return view('struktur-organisasi.index', compact('gambarUrl'));
    }
}
