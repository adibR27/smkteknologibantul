<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Konfigurasi;
use App\Models\MediaSosial;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share konfigurasi dan media sosial ke semua view
        View::composer('*', function ($view) {
            // Ambil konfigurasi pertama (biasanya hanya ada 1 record)
            $konfigurasi = Konfigurasi::first();

            // Ambil semua media sosial, urutkan berdasarkan created_at
            $mediaSosial = MediaSosial::orderBy('created_at', 'asc')->get();

            // Share ke semua view
            $view->with([
                'globalKonfigurasi' => $konfigurasi,
                'globalMediaSosial' => $mediaSosial
            ]);
        });
    }
}
