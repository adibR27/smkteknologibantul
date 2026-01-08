@extends('admin.layouts.app')

@section('title', 'Visi & Misi')
@section('page-title', 'Visi & Misi')
@section('page-subtitle', 'Kelola visi dan misi sekolah')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-bullseye mr-2 text-blue-600"></i>
                Visi & Misi Sekolah
            </h3>

            <a href="{{ route('admin.visi-misi.edit') }}"
                class="rounded-lg bg-blue-600 px-4 py-2 font-medium text-white transition hover:bg-blue-700">
                <i class="fas fa-edit mr-2"></i>{{ $visiMisi ? 'Edit' : 'Tambah' }}
            </a>
        </div>

        @if ($visiMisi)
            <!-- Visi Section -->
            <div class="mb-8">
                <h4 class="mb-3 text-lg font-bold text-gray-800">
                    <i class="fas fa-eye mr-2 text-blue-600"></i>Visi
                </h4>
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                    <p class="whitespace-pre-line text-gray-700">{{ $visiMisi->visi }}</p>
                </div>
            </div>

            <!-- Misi Section -->
            <div>
                <h4 class="mb-3 text-lg font-bold text-gray-800">
                    <i class="fas fa-tasks mr-2 text-blue-600"></i>Misi
                </h4>
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                    <div class="prose max-w-none text-gray-700">{!! nl2br(e($visiMisi->misi)) !!}</div>
                </div>
            </div>

            <!-- Preview Button -->
            <div class="mt-6 flex justify-center">
                <a href="{{ route('visi-misi') }}" target="_blank"
                    class="rounded-lg bg-green-600 px-6 py-3 font-medium text-white transition hover:bg-green-700">
                    <i class="fas fa-eye mr-2"></i>Lihat di Halaman Publik
                </a>
            </div>
        @else
            <!-- Empty State -->
            <div class="py-16 text-center">
                <i class="fas fa-bullseye mb-4 text-6xl text-gray-300"></i>
                <p class="mb-4 text-gray-500">Belum ada Visi & Misi</p>
                <a href="{{ route('admin.visi-misi.edit') }}"
                    class="inline-flex items-center rounded-lg bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Tambah Sekarang
                </a>
            </div>
        @endif
    </div>
@endsection
