<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruPublicController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua guru yang aktif, diurutkan berdasarkan nama
        $guru = Guru::with('jurusan')
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        // Ambil mode view dari query string (default: grid)
        $viewMode = $request->get('view', 'grid');

        return view('guru.index', compact('guru', 'viewMode'));
    }
}
