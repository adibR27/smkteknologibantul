@extends('admin.layouts.app')

@section('title', 'Struktur Organisasi')
@section('page-title', 'Struktur Organisasi')
@section('page-subtitle', 'Kelola gambar struktur organisasi sekolah')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-sitemap mr-2 text-blue-600"></i>
                Struktur Organisasi
            </h3>

            @if ($gambarUrl)
                <div class="flex gap-2">
                    <a href="{{ route('admin.struktur-organisasi.edit') }}"
                        class="rounded-lg bg-yellow-500 px-4 py-2 font-medium text-white transition hover:bg-yellow-600">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <form action="{{ route('admin.struktur-organisasi.destroy') }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus struktur organisasi?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="rounded-lg bg-red-500 px-4 py-2 font-medium text-white transition hover:bg-red-600">
                            <i class="fas fa-trash mr-2"></i>Hapus
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('admin.struktur-organisasi.create') }}"
                    class="rounded-lg bg-blue-600 px-4 py-2 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Upload Gambar
                </a>
            @endif
        </div>

        @if ($gambarUrl)
            <div class="rounded-lg border border-gray-200 p-4">
                <img src="{{ $gambarUrl }}" alt="Struktur Organisasi" class="mx-auto w-full rounded-lg shadow-md">
            </div>

            <div class="mt-4 flex justify-center gap-4">
                <a href="{{ route('struktur-organisasi') }}" target="_blank"
                    class="rounded-lg bg-green-500 px-4 py-2 font-medium text-white transition hover:bg-green-600">
                    <i class="fas fa-eye mr-2"></i>Lihat di Halaman Publik
                </a>
            </div>
        @else
            <div class="py-16 text-center">
                <i class="fas fa-image mb-4 text-6xl text-gray-300"></i>
                <p class="mb-4 text-gray-500">Belum ada gambar struktur organisasi</p>
                <a href="{{ route('admin.struktur-organisasi.create') }}"
                    class="inline-flex items-center rounded-lg bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-upload mr-2"></i>Upload Sekarang
                </a>
            </div>
        @endif
    </div>
@endsection
