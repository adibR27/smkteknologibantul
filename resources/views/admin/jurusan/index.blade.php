@extends('admin.layouts.app')

@section('title', 'Kelola Jurusan')
@section('page-title', 'Kelola Jurusan')
@section('page-subtitle', 'Daftar semua program keahlian')

@section('content')
    <!-- Header Actions -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Jurusan</h2>
            <p class="mt-1 text-sm text-gray-600">Kelola data program keahlian sekolah</p>
        </div>
        <a href="{{ route('admin.jurusan.create') }}"
            class="inline-flex items-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>
            Tambah Jurusan
        </a>
    </div>

    <!-- Table Card -->
    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-700">
                            No
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-700">
                            Gambar
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-700">
                            Nama Jurusan
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-700">
                            Fasilitas
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-700">
                            Deskripsi
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-700">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($jurusans as $index => $jurusan)
                        <tr class="transition hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                {{ $jurusans->firstItem() + $index }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                @if ($jurusan->gambar)
                                    <img src="{{ asset('storage/' . $jurusan->gambar) }}" alt="{{ $jurusan->nama_jurusan }}"
                                        class="h-16 w-24 rounded-lg object-cover shadow-sm">
                                @else
                                    <div class="flex h-16 w-24 items-center justify-center rounded-lg bg-gray-200">
                                        <i class="fas fa-image text-2xl text-gray-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-900">{{ $jurusan->nama_jurusan }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">
                                    {{ Str::limit($jurusan->fasilitas_jurusan ?? '-', 50) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">
                                    {{ Str::limit(strip_tags($jurusan->deskripsi), 60) }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.jurusan.edit', $jurusan->id) }}"
                                        class="inline-flex items-center rounded-lg bg-yellow-500 px-3 py-2 text-sm font-medium text-white transition hover:bg-yellow-600"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.jurusan.destroy', $jurusan->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?');"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center rounded-lg bg-red-500 px-3 py-2 text-sm font-medium text-white transition hover:bg-red-600"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-inbox mb-4 text-6xl text-gray-300"></i>
                                    <p class="text-lg font-medium text-gray-500">Belum ada data jurusan</p>
                                    <p class="mt-1 text-sm text-gray-400">Mulai tambahkan jurusan baru</p>
                                    <a href="{{ route('admin.jurusan.create') }}"
                                        class="mt-4 inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm text-white transition hover:bg-blue-700">
                                        <i class="fas fa-plus mr-2"></i>
                                        Tambah Jurusan
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($jurusans->hasPages())
            <div class="border-t border-gray-200 bg-white px-6 py-4">
                {{ $jurusans->links() }}
            </div>
        @endif
    </div>
@endsection
