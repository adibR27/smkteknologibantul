<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Guru;
use App\Models\Alumni;
use App\Models\Prestasi;
use App\Models\Jurusan;
use App\Models\Galeri;
use App\Models\Carousel;
use App\Models\Dokumen;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $stats = [
            'artikel' => Artikel::count(),
            'guru' => Guru::count(),
            'alumni' => Alumni::count(),
            'prestasi' => Prestasi::count(),
            'jurusan' => Jurusan::count(),
            'galeri' => Galeri::count(),
            'carousel' => Carousel::count(),
            'dokumen' => Dokumen::count(),
        ];

        // Get recent articles
        $recentArticles = Artikel::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get articles by month (last 6 months)
        $artikelPerBulan = Artikel::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
            DB::raw('COUNT(*) as jumlah')
        )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        // Get recent activities (last 10 articles created/updated)
        $recentActivities = Artikel::select('judul', 'created_at', 'updated_at')
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($artikel) {
                return [
                    'action' => $artikel->created_at->eq($artikel->updated_at) ? 'Artikel baru dibuat' : 'Artikel diupdate',
                    'description' => $artikel->judul,
                    'time' => $artikel->updated_at->diffForHumans(),
                ];
            });

        return view('admin.dashboard', compact('stats', 'recentArticles', 'artikelPerBulan', 'recentActivities'));
    }
}
