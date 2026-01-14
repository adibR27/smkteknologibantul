@extends('layouts.app')

@section('title', 'Prestasi')

@section('content')
    <!-- HERO SECTION -->
    <section class="bg-gradient-to-r from-blue-800 to-blue-900 py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 text-center">
            <div class="mb-4">
                <i class="fas fa-trophy text-6xl text-blue-200"></i>
            </div>
            <h1 class="mb-4 text-4xl font-bold md:text-5xl">Prestasi Kami</h1>
            <p class="mx-auto max-w-2xl text-lg text-blue-100">
                Berbagai prestasi yang telah diraih oleh siswa-siswi SMK Teknologi Bantul
            </p>
        </div>
    </section>


    <!-- FILTER & SEARCH SECTION -->
    <section class="bg-gray-50 py-8">
        <div class="mx-auto max-w-7xl px-4">
            <form method="GET" action="{{ route('prestasi.index') }}" class="flex flex-col gap-4 md:flex-row">
                <!-- Search -->
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari prestasi..."
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Filter Tingkat -->
                <div class="w-full md:w-64">
                    <select name="tingkat"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Tingkat</option>
                        <option value="internasional" {{ request('tingkat') == 'internasional' ? 'selected' : '' }}>
                            Internasional</option>
                        <option value="nasional" {{ request('tingkat') == 'nasional' ? 'selected' : '' }}>Nasional
                        </option>
                        <option value="provinsi" {{ request('tingkat') == 'provinsi' ? 'selected' : '' }}>Provinsi
                        </option>
                        <option value="kabupaten" {{ request('tingkat') == 'kabupaten' ? 'selected' : '' }}>Kabupaten
                        </option>
                        <option value="kecamatan" {{ request('tingkat') == 'kecamatan' ? 'selected' : '' }}>Kecamatan
                        </option>
                        <option value="sekolah" {{ request('tingkat') == 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                    </select>
                </div>

                <!-- Button -->
                <div class="flex gap-2">
                    <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-white transition hover:bg-blue-700">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                    @if (request('search') || request('tingkat'))
                        <a href="{{ route('prestasi.index') }}"
                            class="rounded-lg border border-gray-300 bg-white px-6 py-2 text-gray-700 transition hover:bg-gray-50">
                            <i class="fas fa-times mr-2"></i>Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </section>

    <!-- PRESTASI GRID -->
    <section class="bg-gray-50 py-12">
        <div class="mx-auto max-w-7xl px-4">
            @if ($prestasi->count() > 0)
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($prestasi as $item)
                        <div
                            class="group overflow-hidden rounded-lg bg-white shadow transition hover:shadow-xl hover:shadow-blue-100">
                            <!-- Image -->
                            <div class="relative h-48 overflow-hidden bg-gray-100">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul_prestasi }}"
                                        class="h-full w-full object-cover transition duration-300 group-hover:scale-110">
                                @else
                                    <div
                                        class="flex h-full items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200">
                                        <i class="fas fa-trophy text-6xl text-blue-400"></i>
                                    </div>
                                @endif

                                <!-- Badge Tingkat -->
                                <div class="absolute right-2 top-2">
                                    <span
                                        class="@if ($item->tingkat == 'internasional') bg-purple-600 text-white
                                        @elseif($item->tingkat == 'nasional') bg-red-600 text-white
                                        @elseif($item->tingkat == 'provinsi') bg-blue-600 text-white
                                        @elseif($item->tingkat == 'kabupaten') bg-green-600 text-white
                                        @elseif($item->tingkat == 'kecamatan') bg-yellow-600 text-white
                                        @else bg-gray-600 text-white @endif rounded-full px-3 py-1 text-xs font-semibold shadow-md">
                                        {{ ucfirst($item->tingkat) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5">
                                <h3 class="mb-2 line-clamp-2 text-lg font-bold text-gray-800">
                                    {{ $item->judul_prestasi }}
                                </h3>

                                <!-- Info -->
                                <div class="mb-4 space-y-2 text-sm text-gray-600">
                                    @if ($item->peraih)
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-user text-blue-500"></i>
                                            <span>{{ $item->peraih }}</span>
                                        </div>
                                    @endif

                                    @if ($item->penyelenggara)
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-building text-blue-500"></i>
                                            <span>{{ $item->penyelenggara }}</span>
                                        </div>
                                    @endif

                                    @if ($item->tanggal_perolehan)
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-calendar text-blue-500"></i>
                                            <span>{{ $item->tanggal_perolehan->format('d F Y') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Button Detail -->
                                <a href="{{ route('prestasi.show', $item->id) }}"
                                    class="inline-flex items-center text-sm font-semibold text-blue-600 transition hover:text-blue-800">
                                    Lihat Detail
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $prestasi->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="py-16 text-center">
                    <i class="fas fa-trophy mb-4 text-6xl text-gray-300"></i>
                    <h3 class="mb-2 text-xl font-semibold text-gray-600">Tidak Ada Prestasi</h3>
                    <p class="text-gray-500">
                        @if (request('search') || request('tingkat'))
                            Tidak ada prestasi yang sesuai dengan pencarian Anda.
                        @else
                            Belum ada prestasi yang ditampilkan.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection
