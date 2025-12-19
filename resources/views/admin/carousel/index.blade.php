@extends('admin.layouts.app')

@section('title', 'Kelola Carousel')
@section('page-title', 'Kelola Carousel')
@section('page-subtitle', 'Daftar gambar carousel pada halaman utama')

@section('content')
    <div class="rounded-xl bg-white shadow-sm">
        <!-- Header -->
        <div class="border-b border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Carousel</h3>
                    <p class="mt-1 text-sm text-gray-500">Kelola gambar carousel yang ditampilkan di halaman utama</p>
                </div>
                <a href="{{ route('admin.carousel.create') }}"
                    class="flex items-center space-x-2 rounded-lg bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Carousel</span>
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            @if ($carousels->count() > 0)
                <table class="w-full">
                    <thead class="border-b border-gray-200 bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Gambar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Tanggal Dibuat</th>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($carousels as $index => $carousel)
                            <tr class="transition hover:bg-gray-50">
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                    {{ $index + 1 }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <img src="{{ asset('storage/' . $carousel->gambar) }}" alt="Carousel"
                                        class="h-16 w-24 rounded-lg object-cover shadow-sm">
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-900">
                                        {{ $carousel->deskripsi ?? '-' }}
                                    </p>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    {{ $carousel->created_at->format('d M Y') }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-center text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.carousel.edit', $carousel) }}"
                                            class="text-blue-600 transition hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.carousel.destroy', $carousel) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus carousel ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 transition hover:text-red-900">
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
                <div class="py-12 text-center">
                    <i class="fas fa-images mb-4 text-5xl text-gray-300"></i>
                    <p class="mb-4 text-gray-500">Belum ada carousel</p>
                    <a href="{{ route('admin.carousel.create') }}"
                        class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Carousel Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
