@extends('layouts.app')

@section('title', $prestasi->judul_prestasi)

@section('content')
    <!-- BREADCRUMB -->
    <section class="bg-gray-100 py-4">
        <div class="mx-auto max-w-7xl px-4">
            <nav class="flex items-center gap-2 text-sm text-gray-600">
                <a href="{{ route('home') }}" class="transition hover:text-blue-600">
                    <i class="fas fa-home"></i>
                </a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="{{ route('prestasi.index') }}" class="transition hover:text-blue-600">
                    Prestasi
                </a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-gray-800">{{ $prestasi->judul_prestasi }}</span>
            </nav>
        </div>
    </section>

    <!-- DETAIL SECTION -->
    <section class="bg-white py-12">
        <div class="mx-auto max-w-5xl px-4">
            <div class="overflow-hidden rounded-lg bg-white shadow-lg">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-800 to-blue-900 px-8 py-6 text-white">
                    <div class="mb-4 flex items-center justify-between">
                        <span
                            class="@if ($prestasi->tingkat == 'internasional') bg-purple-600
                            @elseif($prestasi->tingkat == 'nasional') bg-red-600
                            @elseif($prestasi->tingkat == 'provinsi') bg-blue-600
                            @elseif($prestasi->tingkat == 'kabupaten') bg-green-600
                            @elseif($prestasi->tingkat == 'kecamatan') bg-yellow-600
                            @else bg-gray-600 @endif inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold shadow-md">
                            <i class="fas fa-trophy"></i>
                            Tingkat {{ ucfirst($prestasi->tingkat) }}
                        </span>

                        @if ($prestasi->tanggal_perolehan)
                            <div class="flex items-center gap-2 text-sm text-blue-100">
                                <i class="fas fa-calendar"></i>
                                {{ $prestasi->tanggal_perolehan->format('d F Y') }}
                            </div>
                        @endif
                    </div>

                    <h1 class="text-3xl font-bold leading-tight">{{ $prestasi->judul_prestasi }}</h1>
                </div>

                <!-- Image -->
                @if ($prestasi->gambar)
                    <div class="relative h-96 bg-gray-100">
                        <img src="{{ asset('storage/' . $prestasi->gambar) }}" alt="{{ $prestasi->judul_prestasi }}"
                            class="h-full w-full object-contain">
                    </div>
                @endif

                <!-- Content -->
                <div class="p-8">
                    <!-- Info Cards -->
                    <div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2">
                        @if ($prestasi->peraih)
                            <div class="rounded-lg border border-gray-200 bg-blue-50 p-4">
                                <div class="mb-1 flex items-center gap-2 text-sm font-semibold text-gray-600">
                                    <i class="fas fa-user text-blue-600"></i>
                                    Peraih
                                </div>
                                <div class="text-lg font-bold text-gray-800">{{ $prestasi->peraih }}</div>
                            </div>
                        @endif

                        @if ($prestasi->penyelenggara)
                            <div class="rounded-lg border border-gray-200 bg-green-50 p-4">
                                <div class="mb-1 flex items-center gap-2 text-sm font-semibold text-gray-600">
                                    <i class="fas fa-building text-green-600"></i>
                                    Penyelenggara
                                </div>
                                <div class="text-lg font-bold text-gray-800">{{ $prestasi->penyelenggara }}</div>
                            </div>
                        @endif
                    </div>

                    <!-- Description -->
                    @if ($prestasi->deskripsi)
                        <div class="mb-8">
                            <h2 class="mb-4 flex items-center gap-2 text-xl font-bold text-gray-800">
                                <i class="fas fa-info-circle text-blue-600"></i>
                                Deskripsi
                            </h2>
                            <div class="prose max-w-none leading-relaxed text-gray-700">
                                {!! nl2br(e($prestasi->deskripsi)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="mb-3 text-sm font-semibold text-gray-600">Bagikan:</div>
                        <div class="flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank" rel="noopener"
                                class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm text-white transition hover:bg-blue-700">
                                <i class="fab fa-facebook-f"></i>
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($prestasi->judul_prestasi) }}"
                                target="_blank" rel="noopener"
                                class="flex items-center gap-2 rounded-lg bg-sky-500 px-4 py-2 text-sm text-white transition hover:bg-sky-600">
                                <i class="fab fa-twitter"></i>
                                Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($prestasi->judul_prestasi . ' - ' . url()->current()) }}"
                                target="_blank" rel="noopener"
                                class="flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-sm text-white transition hover:bg-green-700">
                                <i class="fab fa-whatsapp"></i>
                                WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="mt-6">
                        <a href="{{ route('prestasi.index') }}"
                            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-6 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Daftar Prestasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRESTASI LAINNYA -->
    @if ($prestasiLainnya->count() > 0)
        <section class="bg-gray-50 py-12">
            <div class="mx-auto max-w-7xl px-4">
                <h2 class="mb-8 text-center text-3xl font-bold text-gray-800">Prestasi Lainnya</h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    @foreach ($prestasiLainnya as $item)
                        <div
                            class="group overflow-hidden rounded-lg bg-white shadow transition hover:shadow-xl hover:shadow-blue-100">
                            <!-- Image -->
                            <div class="relative h-40 overflow-hidden bg-gray-100">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul_prestasi }}"
                                        class="h-full w-full object-cover transition duration-300 group-hover:scale-110">
                                @else
                                    <div
                                        class="flex h-full items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200">
                                        <i class="fas fa-trophy text-5xl text-blue-400"></i>
                                    </div>
                                @endif

                                <!-- Badge -->
                                <div class="absolute right-2 top-2">
                                    <span
                                        class="@if ($item->tingkat == 'internasional') bg-purple-600 text-white
                                        @elseif($item->tingkat == 'nasional') bg-red-600 text-white
                                        @elseif($item->tingkat == 'provinsi') bg-blue-600 text-white
                                        @elseif($item->tingkat == 'kabupaten') bg-green-600 text-white
                                        @elseif($item->tingkat == 'kecamatan') bg-yellow-600 text-white
                                        @else bg-gray-600 text-white @endif rounded-full px-2 py-1 text-xs font-semibold shadow-md">
                                        {{ ucfirst($item->tingkat) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <h3 class="mb-2 line-clamp-2 text-base font-bold text-gray-800">
                                    {{ $item->judul_prestasi }}
                                </h3>

                                <a href="{{ route('prestasi.show', $item->id) }}"
                                    class="inline-flex items-center text-sm font-semibold text-blue-600 transition hover:text-blue-800">
                                    Lihat Detail
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
