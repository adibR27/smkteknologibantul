@extends('admin.layouts.app')

@section('title', 'Data Guru')
@section('page-title', 'Data Guru')
@section('page-subtitle', 'Kelola data guru dan tenaga pengajar')

@section('content')
    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
        <!-- Header -->
        <div class="border-b border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Guru</h3>
                    <p class="mt-1 text-sm text-gray-500">Total {{ $guru->count() }} guru</p>
                </div>
                <a href="{{ route('admin.guru.create') }}"
                    class="flex items-center space-x-2 rounded-lg bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Guru</span>
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
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Mata
                            Pelajaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Jabatan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Jurusan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($guru as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_lengkap }}"
                                        class="h-12 w-12 rounded-full object-cover">
                                @else
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-200">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->nama_lengkap }}</div>
                                <div class="text-sm text-gray-500">{{ $item->email ?? '-' }}</div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                {{ $item->mata_pelajaran ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                {{ $item->jabatan ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                {{ $item->jurusan->nama_jurusan ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.guru.edit', $item->id) }}"
                                        class="text-blue-600 hover:text-blue-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.guru.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">
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
                                    <p class="text-lg font-medium">Belum ada data guru</p>
                                    <p class="mt-1 text-sm">Klik tombol "Tambah Guru" untuk menambahkan data</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
