<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\KonfigurasiController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\ArtikelPublicController;
use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\DokumenPublicController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\GaleriPublicController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\JurusanPublicController;

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/visi-misi', function () {
    return view('profil.visi-misi');
})->name('visi-misi');
Route::get('/sambutan', function () {
    return view('profil.sambutan');
})->name('sambutan');



// Jurusan Routes
Route::prefix('jurusan')->name('jurusan.')->group(function () {
    Route::get('/', [JurusanPublicController::class, 'index'])->name('index');
    Route::get('/{id}', [JurusanPublicController::class, 'show'])->name('show');
});

// Artikel Routes
Route::prefix('artikel')->name('artikel.')->group(function () {
    Route::get('/', [ArtikelPublicController::class, 'index'])->name('index');
    Route::get('/{slug}', [ArtikelPublicController::class, 'show'])->name('show');
});

// Dokumen Routes 
Route::prefix('dokumen')->name('dokumen.')->group(function () {
    Route::get('/', [DokumenPublicController::class, 'index'])->name('index');
    Route::get('/{id}', [DokumenPublicController::class, 'show'])->name('show');
    Route::get('/{id}/download', [DokumenPublicController::class, 'download'])->name('download');
});

// Guru Routes
Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('/', function () {
        return view('guru.index');
    })->name('index');
});

// Alumni Routes
Route::prefix('alumni')->name('alumni.')->group(function () {
    Route::get('/', function () {
        return view('alumni.index');
    })->name('index');
});

// Galeri Routes 
Route::prefix('galeri')->name('galeri.')->group(function () {
    Route::get('/', [GaleriPublicController::class, 'index'])->name('index');
});

// Kontak Routes
Route::prefix('kontak')->name('kontak.')->group(function () {
    Route::get('/', function () {
        return view('kontak.index');
    })->name('index');
});

Route::prefix('admin')->group(function () {
    // Route login admin
    Route::middleware('guest:admin')->group(function () {
        Route::get('/', [AuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
    });

    // Route yang memerlukan autentikasi admin
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('carousel', CarouselController::class)->names([
            'index' => 'admin.carousel.index',
            'create' => 'admin.carousel.create',
            'store' => 'admin.carousel.store',
            'edit' => 'admin.carousel.edit',
            'update' => 'admin.carousel.update',
            'destroy' => 'admin.carousel.destroy',
        ]);
        Route::resource('artikel', ArtikelController::class)->names([
            'index' => 'admin.artikel.index',
            'create' => 'admin.artikel.create',
            'store' => 'admin.artikel.store',
            'edit' => 'admin.artikel.edit',
            'update' => 'admin.artikel.update',
            'destroy' => 'admin.artikel.destroy',
        ]);
        // Upload Image dari TinyMCE
        Route::post('/upload-image', [ArtikelController::class, 'uploadImage'])
            ->name('admin.upload.image');
        // Jurusan Routes
        Route::resource('jurusan', JurusanController::class)->names([
            'index' => 'admin.jurusan.index',
            'create' => 'admin.jurusan.create',
            'store' => 'admin.jurusan.store',
            'edit' => 'admin.jurusan.edit',
            'update' => 'admin.jurusan.update',
            'destroy' => 'admin.jurusan.destroy',
        ]);

        Route::get('/prestasi', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.prestasi.index');
        Route::get('/prestasi/create', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.prestasi.create');

        Route::get('/guru', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.guru.index');
        Route::get('/guru/create', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.guru.create');

        Route::get('/alumni', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.alumni.index');

        // Galeri Routes 
        Route::resource('galeri', GaleriController::class)->except(['show'])->names([
            'index' => 'admin.galeri.index',
            'create' => 'admin.galeri.create',
            'store' => 'admin.galeri.store',
            'edit' => 'admin.galeri.edit',
            'update' => 'admin.galeri.update',
            'destroy' => 'admin.galeri.destroy',
        ]);

        Route::resource('dokumen', DokumenController::class)->names([
            'index' => 'admin.dokumen.index',
            'create' => 'admin.dokumen.create',
            'store' => 'admin.dokumen.store',
            'edit' => 'admin.dokumen.edit',
            'update' => 'admin.dokumen.update',
            'destroy' => 'admin.dokumen.destroy',
        ]);

        // Route download dokumen
        Route::get('/dokumen/{id}/download', [DokumenController::class, 'download'])
            ->name('admin.dokumen.download');

        Route::get('/visi-misi', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.visi-misi.index');

        Route::get('/kepala-sekolah', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.kepala-sekolah.index');

        // Konfigurasi Routes
        Route::get('/konfigurasi', [KonfigurasiController::class, 'index'])->name('admin.konfigurasi.index');
        Route::put('/konfigurasi', [KonfigurasiController::class, 'update'])->name('admin.konfigurasi.update');
        Route::delete('/konfigurasi/logo', [KonfigurasiController::class, 'deleteLogo'])->name('admin.konfigurasi.deleteLogo');
        Route::delete('/konfigurasi/favicon', [KonfigurasiController::class, 'deleteFavicon'])->name('admin.konfigurasi.deleteFavicon');

        // Media Sosial Routes (dalam konfigurasi)
        Route::post('/konfigurasi/media-sosial', [KonfigurasiController::class, 'storeMediaSosial'])->name('admin.konfigurasi.media-sosial.store');
        Route::put('/konfigurasi/media-sosial/{id}', [KonfigurasiController::class, 'updateMediaSosial'])->name('admin.konfigurasi.media-sosial.update');
        Route::delete('/konfigurasi/media-sosial/{id}', [KonfigurasiController::class, 'deleteMediaSosial'])->name('admin.konfigurasi.media-sosial.delete');

        Route::get('/pengaduan', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.pengaduan.index');

        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::get('/test-timezone', function () {
            return [
                'config_timezone' => config('app.timezone'),
                'php_timezone' => date_default_timezone_get(),
                'current_time' => now(),
                'carbon_now' => \Carbon\Carbon::now(),
                'formatted' => now()->format('Y-m-d H:i:s T'),
            ];
        });
    });
});
