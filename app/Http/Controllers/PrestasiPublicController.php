<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiPublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestasi::query()->orderBy('tanggal_perolehan', 'desc');

        // Filter berdasarkan tingkat jika ada
        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }

        // Search jika ada
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul_prestasi', 'like', '%' . $request->search . '%')
                    ->orWhere('peraih', 'like', '%' . $request->search . '%')
                    ->orWhere('penyelenggara', 'like', '%' . $request->search . '%');
            });
        }

        $prestasi = $query->paginate(12);

        // Statistik prestasi per tingkat
        $stats = [
            'total' => Prestasi::count(),
            'internasional' => Prestasi::where('tingkat', 'internasional')->count(),
            'nasional' => Prestasi::where('tingkat', 'nasional')->count(),
            'provinsi' => Prestasi::where('tingkat', 'provinsi')->count(),
            'kabupaten' => Prestasi::where('tingkat', 'kabupaten')->count(),
            'kecamatan' => Prestasi::where('tingkat', 'kecamatan')->count(),
            'sekolah' => Prestasi::where('tingkat', 'sekolah')->count(),
        ];

        return view('prestasi.index', compact('prestasi', 'stats'));
    }

    public function show($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        // Prestasi lainnya (random 3)
        $prestasiLainnya = Prestasi::where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('prestasi.show', compact('prestasi', 'prestasiLainnya'));
    }
}
