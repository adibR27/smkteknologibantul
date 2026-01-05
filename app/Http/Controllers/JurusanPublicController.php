<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanPublicController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::latest()->paginate(9);

        return view('jurusan.index', compact('jurusans'));
    }

    public function show($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        // Ambil jurusan lain untuk rekomendasi
        $jurusanLainnya = Jurusan::where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('jurusan.show', compact('jurusan', 'jurusanLainnya'));
    }
}
