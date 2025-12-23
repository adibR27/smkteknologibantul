@extends('admin.layouts.app')

@section('title', 'Kelola Artikel')
@section('page-title', 'Kelola Artikel')
@section('page-subtitle', 'Daftar semua artikel website')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Total: {{ $artikels->total() }} Artikel</h3>
        </div>
        <a href="{{ route('admin.artikel.create') }}"
            class="rounded-lg bg-blue-600 px-4 py-2.5 font-medium text-white transition hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Tambah Artikel
        </a>
    </div>

    <div class="rounded-xl bg-white shadow-sm">
        @if ($artikels->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Gambar</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Judul</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Kategori</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Penulis</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Views</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($artikels as $artikel)
                            <tr class="transition hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="h-16 w-16 overflow-hidden rounded-lg bg-gray-200">
                                        @if ($artikel->gambar_utama)
                                            <img src="{{ asset('storage/' . $artikel->gambar_utama) }}"
                                                alt="{{ $artikel->judul }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center">
                                                <i class="fas fa-image text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        <p class="font-semibold text-gray-800">{{ Str::limit($artikel->judul, 50) }}</p>
                                        <p class="text-xs text-gray-500">{{ $artikel->slug }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $badgeColors = [
                                            'berita' => 'bg-blue-100 text-blue-800',
                                            'pengumuman' => 'bg-yellow-100 text-yellow-800',
                                            'kegiatan' => 'bg-green-100 text-green-800',
                                            'lainnya' => 'bg-gray-100 text-gray-800',
                                        ];
                                    @endphp
                                    <span
                                        class="inline-flex rounded-full px-3 py-1 text-xs font-medium {{ $badgeColors[$artikel->kategori] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($artikel->kategori) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-700">{{ $artikel->penulis->nama_lengkap ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-eye mr-1 text-xs"></i>
                                        {{ number_format($artikel->views) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-700">
                                        {{ $artikel->tanggal_publish ? $artikel->tanggal_publish->format('d M Y') : '-' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.artikel.edit', $artikel->id) }}"
                                            class="rounded-lg bg-yellow-500 p-2 text-white transition hover:bg-yellow-600"
                                            title="Edit">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-lg bg-red-500 p-2 text-white transition hover:bg-red-600"
                                                title="Hapus">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="border-t px-6 py-4">
                {{ $artikels->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <i class="fas fa-newspaper mb-4 text-6xl text-gray-300"></i>
                <p class="mb-2 text-lg font-semibold text-gray-600">Belum Ada Artikel</p>
                <p class="mb-6 text-sm text-gray-500">Mulai tambahkan artikel pertama Anda</p>
                <a href="{{ route('admin.artikel.create') }}"
                    class="inline-flex items-center rounded-lg bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Tambah Artikel
                </a>
            </div>
        @endif
    </div>
@endsection