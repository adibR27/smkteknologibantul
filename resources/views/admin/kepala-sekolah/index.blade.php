@extends('admin.layouts.app')

@section('title', 'Kepala Sekolah')
@section('page-title', 'Kepala Sekolah')
@section('page-subtitle', 'Kelola data kepala sekolah')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <!-- Header -->
        <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Data Kepala Sekolah</h2>
                <p class="mt-1 text-sm text-gray-500">Informasi sambutan dan profil kepala sekolah</p>
            </div>
            @if (!$kepalaSekolah)
                <a href="{{ route('admin.kepala-sekolah.create') }}"
                    class="inline-flex items-center space-x-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Data</span>
                </a>
            @endif
        </div>

        @if ($kepalaSekolah)
            <!-- Data Card -->
            <div class="overflow-hidden rounded-lg border border-gray-200">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-800">Profil Kepala Sekolah</h3>
                </div>

                <div class="p-6">
                    <div class="grid gap-6 md:grid-cols-3">
                        <!-- Foto Section -->
                        <div class="md:col-span-1">
                            <div class="text-center">
                                @if ($kepalaSekolah->foto)
                                    <img src="{{ asset('storage/' . $kepalaSekolah->foto) }}"
                                        alt="{{ $kepalaSekolah->nama }}"
                                        class="mx-auto h-64 w-64 rounded-lg border-4 border-gray-200 object-cover shadow-md">
                                @else
                                    <div
                                        class="mx-auto flex h-64 w-64 items-center justify-center rounded-lg border-4 border-gray-200 bg-gray-100">
                                        <div class="text-center">
                                            <i class="fas fa-user-tie mb-3 text-6xl text-gray-400"></i>
                                            <p class="text-sm text-gray-500">Foto belum tersedia</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Info Section -->
                        <div class="md:col-span-2">
                            <!-- Nama -->
                            <div class="mb-6">
                                <label class="mb-2 block text-sm font-semibold text-gray-600">
                                    <i class="fas fa-user mr-2"></i>Nama Lengkap
                                </label>
                                <p class="text-lg font-bold text-gray-800">{{ $kepalaSekolah->nama }}</p>
                            </div>

                            <!-- Sambutan -->
                            <div class="mb-6">
                                <label class="mb-2 block text-sm font-semibold text-gray-600">
                                    <i class="fas fa-comment-dots mr-2"></i>Sambutan
                                </label>
                                @if ($kepalaSekolah->sambutan)
                                    <div class="rounded-lg bg-gray-50 p-4">
                                        <p class="whitespace-pre-line text-gray-700">{{ $kepalaSekolah->sambutan }}</p>
                                    </div>
                                @else
                                    <p class="italic text-gray-400">Sambutan belum diisi</p>
                                @endif
                            </div>

                            <!-- Meta Info -->
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="rounded-lg bg-blue-50 p-4">
                                    <p class="mb-1 text-xs text-gray-600">Dibuat pada</p>
                                    <p class="font-semibold text-gray-800">
                                        {{ $kepalaSekolah->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                                <div class="rounded-lg bg-green-50 p-4">
                                    <p class="mb-1 text-xs text-gray-600">Terakhir diubah</p>
                                    <p class="font-semibold text-gray-800">
                                        {{ $kepalaSekolah->updated_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-6 flex flex-wrap gap-3">
                                <a href="{{ route('admin.kepala-sekolah.edit') }}"
                                    class="inline-flex items-center space-x-2 rounded-lg bg-yellow-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-yellow-600">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit Data</span>
                                </a>

                                <button onclick="confirmDelete()"
                                    class="inline-flex items-center space-x-2 rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-red-600">
                                    <i class="fas fa-trash"></i>
                                    <span>Hapus Data</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="py-16 text-center">
                <div class="mx-auto mb-4 flex h-24 w-24 items-center justify-center rounded-full bg-gray-100">
                    <i class="fas fa-user-tie text-4xl text-gray-400"></i>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-gray-800">Belum Ada Data Kepala Sekolah</h3>
                <p class="mb-6 text-gray-500">Tambahkan data kepala sekolah untuk menampilkan sambutan di website</p>
                <a href="{{ route('admin.kepala-sekolah.create') }}"
                    class="inline-flex items-center space-x-2 rounded-lg bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Data Kepala Sekolah</span>
                </a>
            </div>
        @endif
    </div>

    @if ($kepalaSekolah)
        <!-- Delete Confirmation Form -->
        <form id="deleteForm" action="{{ route('admin.kepala-sekolah.destroy') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endif
@endsection

@push('scripts')
    @if ($kepalaSekolah)
        <script>
            function confirmDelete() {
                if (confirm('Apakah Anda yakin ingin menghapus data kepala sekolah ini?')) {
                    document.getElementById('deleteForm').submit();
                }
            }
        </script>
    @endif
@endpush