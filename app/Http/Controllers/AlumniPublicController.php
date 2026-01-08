<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class AlumniPublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumni::with('jurusan')->orderBy('tahun_lulus', 'desc');

        // Filter by jurusan
        if ($request->has('jurusan') && $request->jurusan != '') {
            $query->where('jurusan_id', $request->jurusan);
        }

        // Filter by tahun lulus
        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun_lulus', $request->tahun);
        }

        // Search by nama
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
        }

        $alumni = $query->paginate(12);

        // Get unique tahun lulus untuk filter
        $tahunLulus = Alumni::select('tahun_lulus')
            ->distinct()
            ->orderBy('tahun_lulus', 'desc')
            ->pluck('tahun_lulus');

        // Get jurusan untuk filter
        $jurusan = Jurusan::all();

        return view('alumni.index', compact('alumni', 'tahunLulus', 'jurusan'));
    }

    public function show($id)
    {
        $alumni = Alumni::with('jurusan')->findOrFail($id);

        // Get alumni lainnya dari jurusan yang sama
        $alumniLainnya = Alumni::with('jurusan')
            ->where('id', '!=', $id)
            ->when($alumni->jurusan_id, function ($query) use ($alumni) {
                return $query->where('jurusan_id', $alumni->jurusan_id);
            })
            ->orderBy('tahun_lulus', 'desc')
            ->take(4)
            ->get();

        return view('alumni.show', compact('alumni', 'alumniLainnya'));
    }
}
