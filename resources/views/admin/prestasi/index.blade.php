@extends('admin.layouts.app')

@section('title', 'Manajemen Prestasi')
@section('page-title', 'Prestasi')
@section('page-subtitle', 'Kelola prestasi sekolah')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Prestasi</h1>
                <p class="text-sm text-gray-600">Kelola prestasi yang diraih sekolah</p>
            </div>
            <a href="{{ route('admin.prestasi.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                <i class="fas fa-plus mr-2"></i>
                Tambah Prestasi
            </a>
        </div>

        <!-- Table Card -->
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Gambar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Judul Prestasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Tingkat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Peraih</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Tanggal</th>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($prestasi as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                    {{ $prestasi->firstItem() + $index }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul_prestasi }}"
                                            class="h-16 w-16 rounded-lg object-cover shadow">
                                    @else
                                        <div
                                            class="flex h-16 w-16 items-center justify-center rounded-lg bg-gray-100 text-gray-400">
                                            <i class="fas fa-trophy text-2xl"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->judul_prestasi }}</div>
                                    @if ($item->penyelenggara)
                                        <div class="text-xs text-gray-500">{{ $item->penyelenggara }}</div>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span
                                        class="@if ($item->tingkat == 'internasional') bg-purple-100 text-purple-800
                                        @elseif($item->tingkat == 'nasional') bg-red-100 text-red-800
                                        @elseif($item->tingkat == 'provinsi') bg-blue-100 text-blue-800
                                        @elseif($item->tingkat == 'kabupaten') bg-green-100 text-green-800
                                        @elseif($item->tingkat == 'kecamatan') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800 @endif inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                                        {{ ucfirst($item->tingkat) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $item->peraih ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                    {{ $item->tanggal_perolehan ? $item->tanggal_perolehan->format('d M Y') : '-' }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-center text-sm">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.prestasi.edit', $item->id) }}"
                                            class="rounded-lg bg-yellow-500 px-3 py-1.5 text-white transition hover:bg-yellow-600"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.prestasi.destroy', $item->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-lg bg-red-500 px-3 py-1.5 text-white transition hover:bg-red-600"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-trophy mb-4 text-5xl text-gray-300"></i>
                                        <p class="text-lg font-medium text-gray-500">Belum ada prestasi</p>
                                        <p class="text-sm text-gray-400">Klik tombol "Tambah Prestasi" untuk menambahkan
                                            prestasi baru</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($prestasi->hasPages())
                <div class="border-t border-gray-200 bg-white px-4 py-3">
                    {{ $prestasi->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
