<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CarouselController;

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
    Route::get('/', function () {
        return view('jurusan.index');
    })->name('index');
    Route::get('/{id}', function ($id) {
        return view('jurusan.show', ['id' => $id]);
    })->name('show');
});

// Artikel Routes
Route::prefix('artikel')->name('artikel.')->group(function () {
    Route::get('/', function () {
        return view('artikel.index');
    })->name('index');
    Route::get('/{slug}', function ($slug) {
        return view('artikel.show', ['slug' => $slug]);
    })->name('show');
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
    Route::get('/', function () {
        return view('galeri.index');
    })->name('index');
});

// Kontak Routes
Route::prefix('kontak')->name('kontak.')->group(function () {
    Route::get('/', function () {
        return view('kontak.index');
    })->name('index');
});

Route::prefix('admin')->group(function () {
    // Route login (guest only)
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
        Route::get('/artikel', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.artikel.index');
        Route::get('/artikel/create', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.artikel.create');

        Route::get('/jurusan', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.jurusan.index');
        Route::get('/jurusan/create', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.jurusan.create');

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

        Route::get('/galeri', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.galeri.index');

        Route::get('/dokumen', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.dokumen.index');

        Route::get('/visi-misi', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.visi-misi.index');

        Route::get('/kepala-sekolah', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.kepala-sekolah.index');

        Route::get('/konfigurasi', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.konfigurasi.index');

        Route::get('/pengaduan', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.pengaduan.index');

        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    });
});
