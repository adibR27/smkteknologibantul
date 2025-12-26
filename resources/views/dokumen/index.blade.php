@extends('layouts.app')

@section('title', 'Dokumen - ' . ($globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul'))

@section('content')
    <!-- HERO SECTION -->
    <section class="bg-gradient-to-r from-blue-800 to-blue-900 py-16 text-white">
        <div class="mx-auto max-w-7xl px-4">
            <div class="text-center">
                <h1 class="mb-4 text-4xl font-bold">
                    <i class="fas fa-file-download mr-3"></i>
                    Dokumen Sekolah
                </h1>
                <p class="text-lg text-blue-100">
                    Download berbagai dokumen penting dan informasi sekolah
                </p>
            </div>
        </div>
    </section>

    <!-- FILTER KATEGORI -->
    <section class="bg-gray-50 py-6">
        <div class="mx-auto max-w-7xl px-4">
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('dokumen.index') }}"
                    class="{{ !$kategori ? 'bg-blue-800 text-white' : 'bg-white text-gray-700 hover:bg-blue-100' }} rounded-full px-6 py-2 font-medium transition">
                    <i class="fas fa-th-large mr-2"></i>
                    Semua ({{ $jumlahPerKategori['semua'] }})
                </a>
                <a href="{{ route('dokumen.index', ['kategori' => 'kurikulum']) }}"
                    class="{{ $kategori === 'kurikulum' ? 'bg-blue-800 text-white' : 'bg-white text-gray-700 hover:bg-blue-100' }} rounded-full px-6 py-2 font-medium transition">
                    <i class="fas fa-book mr-2"></i>
                    Kurikulum ({{ $jumlahPerKategori['kurikulum'] }})
                </a>
                <a href="{{ route('dokumen.index', ['kategori' => 'panduan']) }}"
                    class="{{ $kategori === 'panduan' ? 'bg-blue-800 text-white' : 'bg-white text-gray-700 hover:bg-blue-100' }} rounded-full px-6 py-2 font-medium transition">
                    <i class="fas fa-book-open mr-2"></i>
                    Panduan ({{ $jumlahPerKategori['panduan'] }})
                </a>
                <a href="{{ route('dokumen.index', ['kategori' => 'jadwal']) }}"
                    class="{{ $kategori === 'jadwal' ? 'bg-blue-800 text-white' : 'bg-white text-gray-700 hover:bg-blue-100' }} rounded-full px-6 py-2 font-medium transition">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Jadwal ({{ $jumlahPerKategori['jadwal'] }})
                </a>
                <a href="{{ route('dokumen.index', ['kategori' => 'lainnya']) }}"
                    class="{{ $kategori === 'lainnya' ? 'bg-blue-800 text-white' : 'bg-white text-gray-700 hover:bg-blue-100' }} rounded-full px-6 py-2 font-medium transition">
                    <i class="fas fa-folder mr-2"></i>
                    Lainnya ({{ $jumlahPerKategori['lainnya'] }})
                </a>
            </div>
        </div>
    </section>

    <!-- DAFTAR DOKUMEN -->
    <section class="py-12">
        <div class="mx-auto max-w-7xl px-4">
            @if ($dokumens->count() > 0)
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($dokumens as $dokumen)
                        <div
                            class="group rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition hover:shadow-lg">
                            <!-- Icon Dokumen -->
                            <div class="mb-4 flex items-center justify-center">
                                <div
                                    class="flex h-20 w-20 items-center justify-center rounded-full bg-blue-50 text-blue-800 transition group-hover:bg-blue-800 group-hover:text-white">
                                    @php
                                        $extension = pathinfo($dokumen->nama_file, PATHINFO_EXTENSION);
                                        $iconClass = match (strtolower($extension)) {
                                            'pdf' => 'fas fa-file-pdf',
                                            'doc', 'docx' => 'fas fa-file-word',
                                            'xls', 'xlsx' => 'fas fa-file-excel',
                                            'ppt', 'pptx' => 'fas fa-file-powerpoint',
                                            default => 'fas fa-file',
                                        };
                                    @endphp
                                    <i class="{{ $iconClass }} text-3xl"></i>
                                </div>
                            </div>

                            <!-- Judul -->
                            <h3 class="mb-2 text-center text-lg font-bold text-gray-800">
                                {{ Str::limit($dokumen->judul, 50) }}
                            </h3>

                            <!-- Deskripsi -->
                            @if ($dokumen->deskripsi)
                                <p class="mb-4 text-center text-sm text-gray-600">
                                    {{ Str::limit($dokumen->deskripsi, 80) }}
                                </p>
                            @endif

                            <!-- Info -->
                            <div class="mb-4 space-y-2 border-t border-gray-100 pt-4 text-sm text-gray-600">
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center gap-2">
                                        <i class="fas fa-tag text-blue-600"></i>
                                        {{ ucfirst($dokumen->kategori) }}
                                    </span>
                                    <span class="flex items-center gap-2">
                                        <i class="fas fa-hdd text-blue-600"></i>
                                        {{ number_format($dokumen->ukuran_file / 1024, 0) }} KB
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-calendar text-blue-600"></i>
                                    {{ $dokumen->created_at->format('d M Y') }}
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="flex gap-2">
                                <a href="{{ route('dokumen.show', $dokumen->id) }}"
                                    class="flex-1 rounded-lg border border-blue-800 bg-white px-4 py-2 text-center font-medium text-blue-800 transition hover:bg-blue-50">
                                    <i class="fas fa-eye mr-1"></i>
                                    Detail
                                </a>
                                <a href="{{ route('dokumen.download', $dokumen->id) }}"
                                    class="flex-1 rounded-lg bg-blue-800 px-4 py-2 text-center font-medium text-white transition hover:bg-blue-900">
                                    <i class="fas fa-download mr-1"></i>
                                    Download
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $dokumens->links() }}
                </div>
            @else
                <!-- Tidak Ada Dokumen -->
                <div class="rounded-lg border border-gray-200 bg-white p-12 text-center">
                    <i class="fas fa-folder-open mb-4 text-6xl text-gray-300"></i>
                    <h3 class="mb-2 text-xl font-bold text-gray-800">Tidak Ada Dokumen</h3>
                    <p class="text-gray-600">
                        @if ($kategori)
                            Belum ada dokumen dalam kategori <strong>{{ ucfirst($kategori) }}</strong>
                        @else
                            Belum ada dokumen yang tersedia
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection
