<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
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
        // Set Timezone Indonesia (WIB)
        date_default_timezone_set('Asia/Jakarta');

        // Set locale Carbon ke Bahasa Indonesia
        \Carbon\Carbon::setLocale('id');

        // Set Tailwind untuk pagination
        Paginator::useTailwind();

        // Share konfigurasi ke semua view
        View::composer('*', function ($view) {
            $konfigurasi = Konfigurasi::first();
            $mediaSosial = MediaSosial::orderBy('created_at', 'asc')->get();

            $view->with([
                'globalKonfigurasi' => $konfigurasi,
                'globalMediaSosial' => $mediaSosial
            ]);
        });
    }
}
