@extends('layouts.app')

@section('title', 'Alumni')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-800 to-blue-900 py-20 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="mb-4 text-5xl font-bold">Alumni SMK Teknologi Bantul</h1>
            <p class="text-xl text-blue-100">Mengenal lulusan berprestasi kami yang telah berkarya di berbagai bidang</p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="bg-white py-8 shadow-md">
        <div class="container mx-auto px-4">
            <form method="GET" action="{{ route('alumni.index') }}" class="flex flex-wrap gap-4">
                <!-- Search -->
                <div class="min-w-[200px] flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Cari nama alumni...">
                </div>

                <!-- Filter Jurusan -->
                <div class="min-w-[200px]">
                    <select name="jurusan"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Jurusan</option>
                        @foreach ($jurusan as $j)
                            <option value="{{ $j->id }}" {{ request('jurusan') == $j->id ? 'selected' : '' }}>
                                {{ $j->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Tahun -->
                <div class="min-w-[150px]">
                    <select name="tahun"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Tahun</option>
                        @foreach ($tahunLulus as $tahun)
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex gap-2">
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-6 py-2 font-semibold text-white transition hover:bg-blue-700">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                    <a href="{{ route('alumni.index') }}"
                        class="rounded-lg border border-gray-300 px-6 py-2 font-semibold text-gray-700 transition hover:bg-gray-50">
                        <i class="fas fa-redo mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </section>

    <!-- Alumni Grid Section -->
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-4">
            @if ($alumni->count() > 0)
                <!-- Stats -->
                <div class="mb-8 text-center">
                    <p class="text-lg text-gray-600">
                        Menampilkan <span class="font-semibold">{{ $alumni->count() }}</span> dari
                        <span class="font-semibold">{{ $alumni->total() }}</span> alumni
                    </p>
                </div>

                <!-- Alumni Cards Grid -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($alumni as $item)
                        <div
                            class="group transform overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                            <!-- Foto Alumni -->
                            <div class="relative h-64 overflow-hidden bg-gradient-to-br from-blue-100 to-blue-200">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_lengkap }}"
                                        class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110">
                                @else
                                    <div class="flex h-full w-full items-center justify-center">
                                        <i class="fas fa-user-graduate text-8xl text-blue-300"></i>
                                    </div>
                                @endif

                                <!-- Badge Tahun Lulus -->
                                <div
                                    class="absolute right-3 top-3 rounded-full bg-blue-600 px-3 py-1 text-sm font-semibold text-white shadow-lg">
                                    <i class="fas fa-graduation-cap mr-1"></i>{{ $item->tahun_lulus }}
                                </div>
                            </div>

                            <!-- Info Alumni -->
                            <div class="p-5">
                                <h3 class="mb-2 text-xl font-bold text-gray-800">{{ $item->nama_lengkap }}</h3>

                                <!-- Jurusan -->
                                @if ($item->jurusan)
                                    <div class="mb-2 flex items-center text-sm text-gray-600">
                                        <i class="fas fa-book mr-2 text-blue-500"></i>
                                        <span>{{ $item->jurusan->nama_jurusan }}</span>
                                    </div>
                                @endif

                                <!-- Pekerjaan -->
                                @if ($item->pekerjaan_sekarang)
                                    <div class="mb-3 flex items-start text-sm text-gray-600">
                                        <i class="fas fa-briefcase mr-2 mt-1 text-green-500"></i>
                                        <span class="line-clamp-2">{{ $item->pekerjaan_sekarang }}</span>
                                    </div>
                                @endif

                                <!-- Pesan Alumni -->
                                @if ($item->pesan_alumni)
                                    <div class="mt-4 border-t border-gray-100 pt-4">
                                        <p class="line-clamp-3 text-sm italic text-gray-600">
                                            <i class="fas fa-quote-left mr-1 text-blue-400"></i>
                                            {{ $item->pesan_alumni }}
                                            <i class="fas fa-quote-right ml-1 text-blue-400"></i>
                                        </p>
                                    </div>
                                @endif

                                <!-- Button Lihat Detail -->
                                <div class="mt-4">
                                    <a href="{{ route('alumni.show', $item->id) }}"
                                        class="inline-block w-full rounded-lg bg-blue-600 px-4 py-2 text-center font-semibold text-white transition hover:bg-blue-700">
                                        <i class="fas fa-eye mr-2"></i>Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $alumni->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="rounded-xl bg-white p-12 text-center shadow-lg">
                    <i class="fas fa-search mb-4 text-6xl text-gray-300"></i>
                    <h3 class="mb-2 text-2xl font-bold text-gray-800">Tidak Ada Alumni Ditemukan</h3>
                    <p class="mb-6 text-gray-600">
                        @if (request()->has('search') || request()->has('jurusan') || request()->has('tahun'))
                            Coba ubah filter pencarian Anda
                        @else
                            Belum ada data alumni yang tersedia
                        @endif
                    </p>
                    @if (request()->has('search') || request()->has('jurusan') || request()->has('tahun'))
                        <a href="{{ route('alumni.index') }}"
                            class="inline-block rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700">
                            <i class="fas fa-redo mr-2"></i>Reset Filter
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

 
@endsection

@push('styles')
    <style>
        /* Line clamp utility */
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
