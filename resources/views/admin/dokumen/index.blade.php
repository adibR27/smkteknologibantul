@extends('admin.layouts.app')

@section('title', 'Kelola Dokumen')
@section('page-title', 'Kelola Dokumen')
@section('page-subtitle', 'Daftar dokumen yang tersedia')

@section('content')
    <!-- Header Actions -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <p class="text-gray-600">Total: <span class="font-semibold">{{ $dokumens->total() }}</span> dokumen</p>
        </div>
        <a href="{{ route('admin.dokumen.create') }}"
            class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Tambah Dokumen
        </a>
    </div>

    <!-- Dokumen Table -->
    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">No</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Judul</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Kategori</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Ukuran</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal Upload</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($dokumens as $index => $dokumen)
                        <tr class="transition hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $dokumens->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-100">
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
                                        <i class="{{ $iconClass }} text-red-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $dokumen->judul }}</p>
                                        <p class="text-xs text-gray-500">{{ $dokumen->nama_file }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="{{ $dokumen->kategori == 'kurikulum' ? 'bg-blue-100 text-blue-800' : '' }} {{ $dokumen->kategori == 'panduan' ? 'bg-green-100 text-green-800' : '' }} {{ $dokumen->kategori == 'jadwal' ? 'bg-yellow-100 text-yellow-800' : '' }} {{ $dokumen->kategori == 'lainnya' ? 'bg-gray-100 text-gray-800' : '' }} inline-block rounded-full px-3 py-1 text-xs font-semibold">
                                    {{ ucfirst($dokumen->kategori) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ number_format($dokumen->ukuran_file / 1024, 2) }} KB
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $dokumen->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <!-- Download -->
                                    <a href="{{ route('admin.dokumen.download', $dokumen->id) }}"
                                        class="rounded-lg bg-green-100 p-2 text-green-600 transition hover:bg-green-200"
                                        title="Download">
                                        <i class="fas fa-download"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}"
                                        class="rounded-lg bg-blue-100 p-2 text-blue-600 transition hover:bg-blue-200"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.dokumen.destroy', $dokumen->id) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-lg bg-red-100 p-2 text-red-600 transition hover:bg-red-200"
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
                                <i class="fas fa-folder-open mb-3 text-4xl text-gray-300"></i>
                                <p class="text-gray-500">Belum ada dokumen</p>
                                <a href="{{ route('admin.dokumen.create') }}"
                                    class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-plus mr-1"></i>Tambah Dokumen
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($dokumens->hasPages())
            <div class="border-t px-6 py-4">
                {{ $dokumens->links() }}
            </div>
        @endif
    </div>
@endsection
