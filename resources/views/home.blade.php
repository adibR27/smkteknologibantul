@extends('layouts.app')

@section('title', 'Beranda - SMK Teknologi Bantul')

@section('content')
    <!-- 1. Carousel -->
    @include('components.carousel', ['carousel' => $carousel])

    <!-- 2. Sambutan Kepala Sekolah -->
    @include('components.sambutan-kepala-sekolah', ['kepalaSekolah' => $kepalaSekolah])

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
