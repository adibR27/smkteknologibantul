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
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\GuruPublicController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\StrukturOrganisasiPublicController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\VisiMisiPublicController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\AlumniPublicController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\PrestasiPublicController;
use App\Http\Controllers\Admin\KepalaSekolahController;

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Visi Misi Routes
Route::get('/visi-misi', [VisiMisiPublicController::class, 'index'])->name('visi-misi');

// Struktur Organisasi Routes
Route::get('/struktur-organisasi', [StrukturOrganisasiPublicController::class, 'index'])
    ->name('struktur-organisasi');

// Jurusan Routes
Route::prefix('jurusan')->name('jurusan.')->group(function () {
    Route::get('/', [JurusanPublicController::class, 'index'])->name('index');
    Route::get('/{id}', [JurusanPublicController::class, 'show'])->name('show');
});
// Prestasi Routes
Route::prefix('prestasi')->name('prestasi.')->group(function () {
    Route::get('/', [PrestasiPublicController::class, 'index'])->name('index');
    Route::get('/{id}', [PrestasiPublicController::class, 'show'])->name('show');
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
    Route::get('/', [GuruPublicController::class, 'index'])->name('index');
});

// Alumni Routes
Route::prefix('alumni')->name('alumni.')->group(function () {
    Route::get('/', [AlumniPublicController::class, 'index'])->name('index');
    Route::get('/{id}', [AlumniPublicController::class, 'show'])->name('show');
});

// Galeri Routes 
Route::prefix('galeri')->name('galeri.')->group(function () {
    Route::get('/', [GaleriPublicController::class, 'index'])->name('index');
});

// Pengaduan Routes
Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
    Route::get('/', [App\Http\Controllers\PengaduanPublicController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\PengaduanPublicController::class, 'store'])->name('store');
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

        // Prestasi Routes 
        Route::resource('prestasi', PrestasiController::class)->names([
            'index' => 'admin.prestasi.index',
            'create' => 'admin.prestasi.create',
            'store' => 'admin.prestasi.store',
            'edit' => 'admin.prestasi.edit',
            'update' => 'admin.prestasi.update',
            'destroy' => 'admin.prestasi.destroy',
        ]);

        // Guru Routes
        Route::resource('guru', GuruController::class)->names([
            'index' => 'admin.guru.index',
            'create' => 'admin.guru.create',
            'store' => 'admin.guru.store',
            'edit' => 'admin.guru.edit',
            'update' => 'admin.guru.update',
            'destroy' => 'admin.guru.destroy',
        ]);

        // Alumni Routes
        Route::resource('alumni', AlumniController::class)->names([
            'index' => 'admin.alumni.index',
            'create' => 'admin.alumni.create',
            'store' => 'admin.alumni.store',
            'edit' => 'admin.alumni.edit',
            'update' => 'admin.alumni.update',
            'destroy' => 'admin.alumni.destroy',
        ]);

        // Galeri Routes 
        Route::resource('galeri', GaleriController::class)->except(['show'])->names([
            'index' => 'admin.galeri.index',
            'create' => 'admin.galeri.create',
            'store' => 'admin.galeri.store',
            'edit' => 'admin.galeri.edit',
            'update' => 'admin.galeri.update',
            'destroy' => 'admin.galeri.destroy',
        ]);
        // Dokumen Routes
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

        // Visi Misi Routes
        Route::controller(VisiMisiController::class)->prefix('visi-misi')->group(function () {
            Route::get('/', 'index')->name('admin.visi-misi.index');
            Route::get('/edit', 'edit')->name('admin.visi-misi.edit');
            Route::put('/', 'update')->name('admin.visi-misi.update');
        });

        // Kepala Sekolah Routes
        Route::controller(KepalaSekolahController::class)->prefix('kepala-sekolah')->group(function () {
            Route::get('/', 'index')->name('admin.kepala-sekolah.index');
            Route::get('/create', 'create')->name('admin.kepala-sekolah.create');
            Route::post('/', 'store')->name('admin.kepala-sekolah.store');
            Route::get('/edit', 'edit')->name('admin.kepala-sekolah.edit');
            Route::put('/', 'update')->name('admin.kepala-sekolah.update');
            Route::delete('/', 'destroy')->name('admin.kepala-sekolah.destroy');
            Route::delete('/foto', 'deleteFoto')->name('admin.kepala-sekolah.delete-foto');
        });

        // Konfigurasi Routes
        Route::get('/konfigurasi', [KonfigurasiController::class, 'index'])->name('admin.konfigurasi.index');
        Route::put('/konfigurasi', [KonfigurasiController::class, 'update'])->name('admin.konfigurasi.update');
        Route::delete('/konfigurasi/logo', [KonfigurasiController::class, 'deleteLogo'])->name('admin.konfigurasi.deleteLogo');
        Route::delete('/konfigurasi/favicon', [KonfigurasiController::class, 'deleteFavicon'])->name('admin.konfigurasi.deleteFavicon');

        // Media Sosial Routes (dalam konfigurasi)
        Route::post('/konfigurasi/media-sosial', [KonfigurasiController::class, 'storeMediaSosial'])->name('admin.konfigurasi.media-sosial.store');
        Route::put('/konfigurasi/media-sosial/{id}', [KonfigurasiController::class, 'updateMediaSosial'])->name('admin.konfigurasi.media-sosial.update');
        Route::delete('/konfigurasi/media-sosial/{id}', [KonfigurasiController::class, 'deleteMediaSosial'])->name('admin.konfigurasi.media-sosial.delete');

        Route::resource('pengaduan', App\Http\Controllers\Admin\PengaduanController::class)
            ->only(['index', 'show', 'destroy'])
            ->names([
                'index' => 'admin.pengaduan.index',
                'show' => 'admin.pengaduan.show',
                'destroy' => 'admin.pengaduan.destroy',
            ]);

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

        // Struktur Organisasi Routes
        Route::controller(StrukturOrganisasiController::class)->prefix('struktur-organisasi')->group(function () {
            Route::get('/', 'index')->name('admin.struktur-organisasi.index');
            Route::get('/create', 'create')->name('admin.struktur-organisasi.create');
            Route::post('/', 'store')->name('admin.struktur-organisasi.store');
            Route::get('/edit', 'edit')->name('admin.struktur-organisasi.edit');
            Route::put('/', 'update')->name('admin.struktur-organisasi.update');
            Route::delete('/', 'destroy')->name('admin.struktur-organisasi.destroy');
        });
    });
});
