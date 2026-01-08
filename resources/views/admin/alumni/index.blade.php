@extends('admin.layouts.app')

@section('title', 'Data Alumni')
@section('page-title', 'Data Alumni')
@section('page-subtitle', 'Kelola data alumni dan lulusan')

@section('content')
    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
        <!-- Header -->
        <div class="border-b border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Alumni</h3>
                    <p class="mt-1 text-sm text-gray-500">Total {{ $alumni->total() }} alumni</p>
                </div>
                <a href="{{ route('admin.alumni.create') }}"
                    class="flex items-center space-x-2 rounded-lg bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Alumni</span>
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Foto</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Jurusan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Tahun
                            Lulus</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Pekerjaan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($alumni as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                {{ $alumni->firstItem() + $index }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_lengkap }}"
                                        class="h-16 w-16 rounded-lg object-cover shadow-sm">
                                @else
                                    <div class="flex h-16 w-16 items-center justify-center rounded-lg bg-gray-200">
                                        <i class="fas fa-user-graduate text-xl text-gray-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->nama_lengkap }}</div>
                                @if ($item->pesan_alumni)
                                    <div class="mt-1 line-clamp-1 text-xs text-gray-500">{{ $item->pesan_alumni }}</div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                @if ($item->jurusan)
                                    <span
                                        class="inline-flex rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-800">
                                        {{ $item->jurusan->nama_jurusan }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                <span
                                    class="inline-flex items-center rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">
                                    <i class="fas fa-graduation-cap mr-1"></i>
                                    {{ $item->tahun_lulus }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $item->pekerjaan_sekarang ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.alumni.edit', $item->id) }}"
                                        class="text-blue-600 hover:text-blue-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.alumni.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data alumni ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <i class="fas fa-inbox mb-4 text-5xl"></i>
                                    <p class="text-lg font-medium">Belum ada data alumni</p>
                                    <p class="mt-1 text-sm">Klik tombol "Tambah Alumni" untuk menambahkan data</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($alumni->hasPages())
            <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">
                {{ $alumni->links() }} 
            </div>
        @endif
    </div>
@endsection
