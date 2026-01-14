@extends('admin.layouts.app')

@section('title', 'Tambah Kepala Sekolah')
@section('page-title', 'Tambah Kepala Sekolah')
@section('page-subtitle', 'Tambahkan data kepala sekolah baru')

@section('content')
    <div class="mx-auto max-w-4xl">
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <!-- Header -->
            <div class="mb-6 flex items-center justify-between border-b pb-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Form Tambah Kepala Sekolah</h2>
                    <p class="mt-1 text-sm text-gray-500">Lengkapi form di bawah ini dengan data yang valid</p>
                </div>
                <a href="{{ route('admin.kepala-sekolah.index') }}"
                    class="inline-flex items-center space-x-2 rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-200">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.kepala-sekolah.store') }}" method="POST" enctype="multipart/form-data"
                id="kepalaSekolahForm">
                @csrf

                <!-- Nama Lengkap -->
                <div class="mb-6">
                    <label for="nama" class="mb-2 block text-sm font-semibold text-gray-700">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                        class="@error('nama') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Contoh: Dr. Ahmad Sudrajat, M.Pd." required>
                    @error('nama')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto -->
                <div class="mb-6">
                    <label for="foto" class="mb-2 block text-sm font-semibold text-gray-700">
                        Foto Kepala Sekolah
                    </label>
                    <div class="flex items-start space-x-4">
                        <!-- Preview Area -->
                        <div class="flex-shrink-0">
                            <div id="previewContainer"
                                class="flex h-40 w-40 items-center justify-center overflow-hidden rounded-lg border-2 border-dashed border-gray-300 bg-gray-50">
                                <div id="previewPlaceholder" class="text-center">
                                    <i class="fas fa-user-tie mb-2 text-4xl text-gray-400"></i>
                                    <p class="text-xs text-gray-500">Preview Foto</p>
                                </div>
                                <img id="imagePreview" src="#" alt="Preview"
                                    class="hidden h-full w-full object-cover">
                            </div>
                        </div>

                        <!-- Upload Section -->
                        <div class="flex-1">
                            <input type="file" name="foto" id="foto" accept="image/jpeg,image/jpg,image/png"
                                class="@error('foto') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-2 transition file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                            <p class="mt-2 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Format: JPG, JPEG, PNG. Maksimal 2MB.
                            </p>
                            @error('foto')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Sambutan -->
                <div class="mb-6">
                    <label for="sambutan" class="mb-2 block text-sm font-semibold text-gray-700">
                        Sambutan Kepala Sekolah
                    </label>
                    <textarea name="sambutan" id="sambutan" rows="8"
                        class="@error('sambutan') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Tulis sambutan kepala sekolah di sini...">{{ old('sambutan') }}</textarea>
                    <p class="mt-2 text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Sambutan akan ditampilkan di halaman utama website
                    </p>
                    @error('sambutan')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info Box -->
                <div class="mb-6 rounded-lg border-l-4 border-blue-500 bg-blue-50 p-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle mt-1 text-blue-600"></i>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-blue-800">Informasi</p>
                            <p class="mt-1 text-sm text-blue-700">
                                Data kepala sekolah hanya bisa dibuat satu kali. Jika sudah ada, Anda hanya bisa mengedit
                                data yang ada.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3 border-t pt-6 sm:flex-row sm:justify-end">
                    <a href="{{ route('admin.kepala-sekolah.index') }}"
                        class="inline-flex items-center justify-center space-x-2 rounded-lg border border-gray-300 bg-white px-6 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                        <i class="fas fa-times"></i>
                        <span>Batal</span>
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center space-x-2 rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">
                        <i class="fas fa-save"></i>
                        <span>Simpan Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Image Preview
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validasi ukuran file (2MB)
                if (file.size > 2048000) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB');
                    this.value = '';
                    return;
                }

                // Validasi tipe file
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, JPEG, atau PNG');
                    this.value = '';
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewPlaceholder').classList.add('hidden');
                    const preview = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Form validation
        document.getElementById('kepalaSekolahForm').addEventListener('submit', function(e) {
            const nama = document.getElementById('nama').value.trim();

            if (!nama) {
                e.preventDefault();
                alert('Nama kepala sekolah wajib diisi');
                document.getElementById('nama').focus();
                return false;
            }
        });
    </script>
@endpush
