@extends('layouts.app')

@section('title', 'Beranda - SMK Teknologi Bantul')

@section('content')
    <!-- 1. Carousel -->
    @include('components.carousel', ['carousel' => $carousel])

    <!-- 2. Sambutan Kepala Sekolah -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            @php
                // Handle jika $kepalaSekolah adalah collection
                $kepalaSekolahData =
                    is_object($kepalaSekolah) && method_exists($kepalaSekolah, 'first')
                        ? $kepalaSekolah->first()
                        : $kepalaSekolah;
            @endphp
            @if ($kepalaSekolahData)
                <div class="mx-auto max-w-6xl">
                    <!-- Card -->
                    <div class="overflow-hidden rounded-2xl bg-white shadow-xl">
                        <div class="grid grid-cols-1 gap-8 p-8 lg:grid-cols-12 lg:p-12">

                            <!-- Photo Section -->
                            <div class="lg:col-span-4">
                                <div class="sticky top-8">
                                    <!-- Photo Container -->
                                    <div class="relative mx-auto w-fit">
                                        <div
                                            class="absolute -inset-2 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 opacity-20 blur">
                                        </div>

                                        <div class="relative overflow-hidden rounded-2xl border-4 border-white shadow-lg">
                                            @if ($kepalaSekolahData->foto)
                                                <img src="{{ asset('storage/' . $kepalaSekolahData->foto) }}"
                                                    alt="{{ $kepalaSekolahData->nama }}" class="h-96 w-96 object-cover">
                                            @else
                                                <div
                                                    class="flex h-96 w-96 items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200">
                                                    <i class="fas fa-user-tie text-9xl text-blue-400"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Info Card -->
                                    <div class="mt-6 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 p-6 text-center">
                                        <h2 class="mb-2 text-2xl font-bold text-gray-800">{{ $kepalaSekolahData->nama }}
                                        </h2>
                                        <div class="mx-auto mb-4 h-1 w-16 rounded-full bg-blue-600"></div>
                                        <p class="mb-4 text-lg font-semibold text-blue-800">Kepala Sekolah</p>
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-graduation-cap mr-2"></i>
                                            {{ $globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Sambutan Section -->
                            <div class="lg:col-span-8">
                                <div class="flex h-full flex-col">
                                    <div class="mb-6">
                                        <h3 class="mb-2 text-3xl font-bold text-gray-800">
                                            Sambutan Kepala Sekolah
                                        </h3>
                                        <div class="h-1 w-20 rounded-full bg-blue-600"></div>
                                    </div>

                                    <div class="prose prose-lg max-w-none flex-1 text-justify">
                                        @if ($kepalaSekolahData->sambutan)
                                            <div class="whitespace-pre-line">{{ $kepalaSekolahData->sambutan }}</div>
                                        @else
                                            <p class="italic text-gray-600">Sambutan kepala sekolah belum tersedia.</p>
                                        @endif
                                    </div>

                                    <div class="mt-8 rounded-xl bg-blue-50 p-6">
                                        <p class="text-center text-lg font-semibold text-blue-800">
                                            <i class="fas fa-quote-left mr-2"></i>
                                            Selamat datang di
                                            {{ $globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul' }}
                                            <i class="fas fa-quote-right ml-2"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="mx-auto max-w-2xl">
                    <div class="rounded-xl border border-gray-200 bg-white p-12 text-center shadow-lg">
                        <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-gray-100">
                            <i class="fas fa-user-tie text-4xl text-gray-400"></i>
                        </div>
                        <h2 class="mb-2 text-2xl font-bold text-gray-800">Data Belum Tersedia</h2>
                        <p class="mb-6 text-gray-600">Sambutan kepala sekolah belum tersedia saat ini.</p>
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700">
                            <i class="fas fa-home"></i>
                            <span>Kembali ke Beranda</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- 3. Jurusan -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-4xl font-bold text-gray-800">Program Jurusan Kami</h2>
                <p class="text-xl text-gray-600">Pilih jurusan yang sesuai dengan minat dan bakat Anda</p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($jurusan as $item)
                    <div
                        class="transform overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="h-64 w-full object-cover"
                                alt="{{ $item->nama_jurusan }}">
                        @else
                            <div class="flex h-64 w-full items-center justify-center bg-gray-300">
                                <i class="fas fa-graduation-cap text-6xl text-gray-500"></i>
                            </div>
                        @endif

                        <div class="p-6">
                            <h5 class="mb-3 text-xl font-bold text-gray-800">{{ $item->nama_jurusan }}</h5>
                            <p class="mb-4 text-gray-600">{{ $item->deskripsi_singkat }}</p>
                            <a href="{{ route('jurusan.show', $item->id) }}"
                                class="bg-primary hover:bg-secondary inline-block rounded-lg px-6 py-2 font-semibold text-white transition-colors duration-300">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="rounded-lg border border-blue-200 bg-blue-50 p-8 text-center">
                            <i class="fas fa-info-circle mb-3 text-4xl text-blue-500"></i>
                            <p class="text-lg text-blue-700">Belum ada data jurusan</p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- 4. Artikel Terbaru -->
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-4">
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-4xl font-bold text-gray-800">Artikel & Berita Terkini</h2>
                <p class="text-xl text-gray-600">Informasi terbaru dari SMK Teknologi Bantul</p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($artikel->take(3) as $item)
                    <div
                        class="transform overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        @if ($item->gambar_utama)
                            <img src="{{ asset('storage/' . $item->gambar_utama) }}" class="h-56 w-full object-cover"
                                alt="{{ $item->judul }}">
                        @else
                            <div class="flex h-56 w-full items-center justify-center bg-gray-300">
                                <i class="fas fa-newspaper text-6xl text-gray-500"></i>
                            </div>
                        @endif

                        <div class="p-6">
                            <span
                                class="bg-primary mb-3 inline-block rounded-full px-3 py-1 text-sm font-semibold text-white">
                                {{ ucfirst($item->kategori) }}
                            </span>
                            <h5 class="mb-3 text-xl font-bold text-gray-800">{{ $item->judul }}</h5>
                            <p class="mb-4 text-gray-600">{{ Str::limit(strip_tags($item->konten), 100) }}</p>
                            <div class="mb-4 flex items-center text-sm text-gray-500">
                                <i class="fas fa-calendar mr-2"></i>
                                {{ $item->tanggal_publish?->format('d M Y') ?? 'Belum dipublikasi' }}
                            </div>
                            <a href="{{ route('artikel.show', $item->slug) }}"
                                class="bg-primary hover:bg-secondary inline-block rounded-lg px-6 py-2 font-semibold text-white transition-colors duration-300">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="rounded-lg border border-blue-200 bg-blue-50 p-8 text-center">
                            <i class="fas fa-info-circle mb-3 text-4xl text-blue-500"></i>
                            <p class="text-lg text-blue-700">Belum ada artikel</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('artikel.index') }}"
                    class="bg-primary hover:bg-secondary inline-block transform rounded-full px-8 py-4 font-bold text-white transition-all duration-300 hover:scale-105">
                    Baca Semua Artikel
                </a>
            </div>
        </div>
    </section>

@endsection
