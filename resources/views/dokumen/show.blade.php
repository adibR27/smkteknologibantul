@extends('layouts.app')

@section('title', $dokumen->judul . ' - ' . ($globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul'))

@section('content')
    <!-- BREADCRUMB -->
    <section class="bg-gray-50 py-4">
        <div class="mx-auto max-w-7xl px-4">
            <nav class="flex items-center gap-2 text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-blue-800">
                    <i class="fas fa-home"></i> Beranda
                </a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="{{ route('dokumen.index') }}" class="hover:text-blue-800">Dokumen</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="font-medium text-blue-800">{{ Str::limit($dokumen->judul, 50) }}</span>
            </nav>
        </div>
    </section>

    <!-- DETAIL DOKUMEN -->
    <section class="py-12">
        <div class="mx-auto max-w-4xl px-4">
            <!-- Card Utama -->
            <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-lg">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-800 to-blue-900 p-8 text-white">
                    <div class="mb-6 flex justify-center">
                        <div class="flex h-24 w-24 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm">
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
                            <i class="{{ $iconClass }} text-4xl"></i>
                        </div>
                    </div>
                    <h1 class="mb-2 text-center text-3xl font-bold">{{ $dokumen->judul }}</h1>
                    <p class="text-center text-blue-100">
                        <span class="rounded-full bg-white/20 px-4 py-1">
                            {{ ucfirst($dokumen->kategori) }}
                        </span>
                    </p>
                </div>

                <!-- Body -->
                <div class="p-8">
                    <!-- Deskripsi -->
                    @if ($dokumen->deskripsi)
                        <div class="mb-6">
                            <h3 class="mb-3 text-lg font-bold text-gray-800">
                                <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                                Deskripsi
                            </h3>
                            <p class="text-gray-700">{{ $dokumen->deskripsi }}</p>
                        </div>
                    @endif

                    <!-- Informasi File -->
                    <div class="mb-6 rounded-lg bg-gray-50 p-6">
                        <h3 class="mb-4 text-lg font-bold text-gray-800">
                            <i class="fas fa-list mr-2 text-blue-600"></i>
                            Informasi File
                        </h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-file-signature mt-1 text-blue-600"></i>
                                <div>
                                    <p class="text-sm text-gray-600">Nama File</p>
                                    <p class="font-medium text-gray-800">{{ $dokumen->nama_file }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <i class="fas fa-hdd mt-1 text-blue-600"></i>
                                <div>
                                    <p class="text-sm text-gray-600">Ukuran</p>
                                    <p class="font-medium text-gray-800">
                                        {{ number_format($dokumen->ukuran_file / 1024, 2) }} KB
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <i class="fas fa-calendar-plus mt-1 text-blue-600"></i>
                                <div>
                                    <p class="text-sm text-gray-600">Diunggah</p>
                                    <p class="font-medium text-gray-800">
                                        {{ $dokumen->created_at->format('d F Y, H:i') }} WIB
                                    </p>
                                </div>
                            </div>
                            @if ($dokumen->uploader)
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-user mt-1 text-blue-600"></i>
                                    <div>
                                        <p class="text-sm text-gray-600">Diunggah oleh</p>
                                        <p class="font-medium text-gray-800">{{ $dokumen->uploader->nama_lengkap }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Tombol Download -->
                    <div class="flex gap-4">
                        <a href="{{ route('dokumen.index') }}"
                            class="flex-1 rounded-lg border border-gray-300 bg-white px-6 py-3 text-center font-medium text-gray-700 transition hover:bg-gray-50">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                        <a href="{{ route('dokumen.download', $dokumen->id) }}"
                            class="flex-1 rounded-lg bg-blue-800 px-6 py-3 text-center font-medium text-white transition hover:bg-blue-900">
                            <i class="fas fa-download mr-2"></i>
                            Download Dokumen
                        </a>
                    </div>
                </div>
            </div>

            <!-- Dokumen Terkait -->
            @if ($dokumenTerkait->count() > 0)
                <div class="mt-8">
                    <h2 class="mb-6 text-2xl font-bold text-gray-800">
                        <i class="fas fa-file-alt mr-2 text-blue-600"></i>
                        Dokumen Terkait
                    </h2>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        @foreach ($dokumenTerkait as $item)
                            <a href="{{ route('dokumen.show', $item->id) }}"
                                class="group flex items-center gap-4 rounded-lg border border-gray-200 bg-white p-4 transition hover:border-blue-800 hover:shadow-md">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded bg-blue-50 text-blue-800 transition group-hover:bg-blue-800 group-hover:text-white">
                                    @php
                                        $ext = pathinfo($item->nama_file, PATHINFO_EXTENSION);
                                        $icon = match (strtolower($ext)) {
                                            'pdf' => 'fas fa-file-pdf',
                                            'doc', 'docx' => 'fas fa-file-word',
                                            'xls', 'xlsx' => 'fas fa-file-excel',
                                            'ppt', 'pptx' => 'fas fa-file-powerpoint',
                                            default => 'fas fa-file',
                                        };
                                    @endphp
                                    <i class="{{ $icon }}"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-800 group-hover:text-blue-800">
                                        {{ Str::limit($item->judul, 50) }}
                                    </h4>
                                    <p class="text-sm text-gray-600">
                                        {{ number_format($item->ukuran_file / 1024, 0) }} KB •
                                        {{ $item->created_at->format('d M Y') }}
                                    </p>
                                </div>
                                <i class="fas fa-arrow-right text-gray-400 transition group-hover:text-blue-800"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
