@extends('layouts.app')

@section('title', 'Artikel & Berita')

@section('content')
    <!-- Header Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 py-16 text-white">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="mb-4 text-4xl font-bold md:text-5xl">Artikel & Berita</h1>
                <p class="text-xl opacity-90">Informasi terkini dan artikel menarik dari
                    {{ $globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul' }}</p>
            </div>
        </div>
    </section>

    <!-- Filter & Search Section -->
    <section class="bg-white py-8 shadow-sm">
        <div class="container mx-auto px-4">
            <form method="GET" action="{{ route('artikel.index') }}" class="flex flex-col gap-4 md:flex-row">
                <!-- Search Bar -->
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full rounded-lg border border-gray-300 py-3 pl-12 pr-4 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Cari artikel...">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Filter Kategori -->
                <div class="md:w-64">
                    <select name="kategori"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                                {{ ucfirst($kat) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="rounded-lg bg-blue-600 px-8 py-3 font-semibold text-white transition hover:bg-blue-700">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </form>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- Artikel List (Kiri) -->
                <div class="lg:col-span-2">
                    @if ($artikels->count() > 0)
                        <div class="grid grid-cols-1 gap-8">
                            @foreach ($artikels as $artikel)
                                <article
                                    class="group overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 hover:shadow-2xl">
                                    <div class="md:flex">
                                        <!-- Image -->
                                        <div class="md:w-2/5">
                                            @if ($artikel->gambar_utama)
                                                <img src="{{ asset('storage/' . $artikel->gambar_utama) }}"
                                                    alt="{{ $artikel->judul }}"
                                                    class="h-64 w-full object-cover transition-transform duration-300 group-hover:scale-110 md:h-full">
                                            @else
                                                <div
                                                    class="flex h-64 w-full items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200 md:h-full">
                                                    <i class="fas fa-newspaper text-6xl text-blue-400"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Content -->
                                        <div class="flex flex-col justify-between p-6 md:w-3/5">
                                            <!-- Badge Kategori -->
                                            <div>
                                                <span
                                                    class="mb-3 inline-block rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-800">
                                                    <i class="fas fa-tag mr-1"></i>{{ ucfirst($artikel->kategori) }}
                                                </span>

                                                <!-- Judul -->
                                                <h2
                                                    class="mb-3 text-2xl font-bold text-gray-800 transition group-hover:text-blue-600">
                                                    <a href="{{ route('artikel.show', $artikel->slug) }}">
                                                        {{ $artikel->judul }}
                                                    </a>
                                                </h2>

                                                <!-- Excerpt -->
                                                <p class="mb-4 text-gray-600">
                                                    {{ Str::limit(strip_tags($artikel->konten), 150) }}
                                                </p>
                                            </div>

                                            <!-- Meta Info -->
                                            <div class="flex items-center justify-between border-t pt-4">
                                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                                    <span>
                                                        <i class="fas fa-calendar mr-1"></i>
                                                        {{ $artikel->tanggal_publish?->format('d M Y') }}
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-eye mr-1"></i>
                                                        {{ number_format($artikel->views) }} views
                                                    </span>
                                                </div>
                                                <a href="{{ route('artikel.show', $artikel->slug) }}"
                                                    class="font-semibold text-blue-600 transition hover:text-blue-800">
                                                    Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $artikels->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="rounded-xl bg-white p-12 text-center shadow-lg">
                            <i class="fas fa-search mb-4 text-6xl text-gray-300"></i>
                            <h3 class="mb-2 text-2xl font-bold text-gray-800">Artikel Tidak Ditemukan</h3>
                            <p class="mb-6 text-gray-600">
                                Maaf, tidak ada artikel yang sesuai dengan pencarian Anda.
                            </p>
                            <a href="{{ route('artikel.index') }}"
                                class="inline-block rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700">
                                <i class="fas fa-redo mr-2"></i>Lihat Semua Artikel
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Sidebar (Kanan) -->
                <aside class="lg:col-span-1">
                    <!-- Artikel Populer -->
                    <div class="mb-8 rounded-xl bg-white p-6 shadow-lg">
                        <h3 class="mb-4 flex items-center text-xl font-bold text-gray-800">
                            <i class="fas fa-fire mr-2 text-orange-500"></i>
                            Artikel Populer
                        </h3>
                        <div class="space-y-4">
                            @forelse($popularArtikels as $popular)
                                <a href="{{ route('artikel.show', $popular->slug) }}"
                                    class="group flex gap-4 rounded-lg p-2 transition hover:bg-gray-50">
                                    @if ($popular->gambar_utama)
                                        <img src="{{ asset('storage/' . $popular->gambar_utama) }}"
                                            alt="{{ $popular->judul }}" class="h-16 w-16 rounded-lg object-cover">
                                    @else
                                        <div class="flex h-16 w-16 items-center justify-center rounded-lg bg-gray-200">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h4 class="mb-1 font-semibold text-gray-800 transition group-hover:text-blue-600">
                                            {{ Str::limit($popular->judul, 50) }}
                                        </h4>
                                        <div class="flex items-center gap-2 text-xs text-gray-500">
                                            <i class="fas fa-eye"></i>
                                            <span>{{ number_format($popular->views) }}</span>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <p class="text-sm text-gray-500">Belum ada artikel populer</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Kategori Widget -->
                    <div class="rounded-xl bg-white p-6 shadow-lg">
                        <h3 class="mb-4 flex items-center text-xl font-bold text-gray-800">
                            <i class="fas fa-folder mr-2 text-blue-500"></i>
                            Kategori
                        </h3>
                        <div class="space-y-2">
                            <a href="{{ route('artikel.index') }}"
                                class="{{ request('kategori') == '' ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }} flex items-center justify-between rounded-lg p-3 transition hover:bg-blue-50">
                                <span>Semua Kategori</span>
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                            @foreach ($kategoris as $kat)
                                <a href="{{ route('artikel.index', ['kategori' => $kat]) }}"
                                    class="{{ request('kategori') == $kat ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }} flex items-center justify-between rounded-lg p-3 transition hover:bg-blue-50">
                                    <span>{{ ucfirst($kat) }}</span>
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
