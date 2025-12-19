@extends('admin.layouts.app')

@section('title', 'Kelola Carousel')
@section('page-title', 'Kelola Carousel')
@section('page-subtitle', 'Daftar gambar carousel pada halaman utama')

@section('content')
<div class="bg-white rounded-xl shadow-sm">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Daftar Carousel</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola gambar carousel yang ditampilkan di halaman utama</p>
            </div>
            <a href="{{ route('admin.carousel.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Tambah Carousel</span>
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        @if($carousels->count() > 0)
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($carousels as $index => $carousel)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ asset('storage/' . $carousel->gambar) }}" 
                             alt="Carousel" 
                             class="h-16 w-24 object-cover rounded-lg shadow-sm">
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-gray-900">
                            {{ $carousel->deskripsi ?? '-' }}
                        </p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $carousel->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('admin.carousel.edit', $carousel) }}" 
                               class="text-blue-600 hover:text-blue-900 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.carousel.destroy', $carousel) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus carousel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="text-center py-12">
            <i class="fas fa-images text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500 mb-4">Belum ada carousel</p>
            <a href="{{ route('admin.carousel.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Carousel Pertama
            </a>
        </div>
        @endif
    </div>
</div>
@endsection