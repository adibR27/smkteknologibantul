@extends('admin.layouts.app')

@section('title', 'Tambah Foto Galeri')
@section('page-title', 'Galeri')
@section('page-subtitle', 'Tambah foto baru ke galeri')

@section('content')
    <div class="mx-auto max-w-4xl">
        <!-- Breadcrumb -->
        <nav class="mb-6 flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 text-sm md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                        <a href="{{ route('admin.galeri.index') }}" class="text-gray-700 hover:text-blue-600">Galeri</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                        <span class="text-gray-500">Tambah Foto</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Form Card -->
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <div class="mb-6 border-b pb-4">
                <h3 class="text-xl font-bold text-gray-800">Tambah Foto Baru</h3>
                <p class="mt-1 text-sm text-gray-600">Lengkapi form di bawah untuk menambahkan foto ke galeri</p>
            </div>

            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-6">
                    <!-- Upload Gambar -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Gambar <span class="text-red-500">*</span>
                        </label>
                        <div class="space-y-3">
                            <!-- Preview -->
                            <div id="imagePreview" class="hidden">
                                <div class="relative inline-block">
                                    <img id="previewImg" src="" alt="Preview"
                                        class="h-64 w-auto rounded-lg border-2 border-gray-300 object-cover shadow-md">
                                    <button type="button" onclick="removeImage()"
                                        class="absolute -right-2 -top-2 flex h-8 w-8 items-center justify-center rounded-full bg-red-600 text-white shadow-lg transition hover:bg-red-700">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Upload Button -->
                            <div id="uploadArea" class="flex items-center justify-center">
                                <label for="gambar"
                                    class="flex h-64 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 transition hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pb-6 pt-5">
                                        <i class="fas fa-cloud-upload-alt mb-3 text-4xl text-gray-400"></i>
                                        <p class="mb-2 text-sm text-gray-500">
                                            <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                        </p>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG atau GIF (MAX. 2MB)</p>
                                    </div>
                                    <input id="gambar" name="gambar" type="file" class="hidden"
                                        accept="image/png,image/jpeg,image/jpg,image/gif" onchange="previewImage(event)"
                                        required>
                                </label>
                            </div>
                        </div>
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Caption -->
                    <div>
                        <label for="caption" class="mb-2 block text-sm font-medium text-gray-700">
                            Caption
                        </label>
                        <textarea id="caption" name="caption" rows="3"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                            placeholder="Tambahkan deskripsi atau caption untuk foto ini...">{{ old('caption') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Opsional: Tambahkan keterangan singkat tentang foto</p>
                        @error('caption')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Kegiatan -->
                    <div>
                        <label for="tanggal_kegiatan" class="mb-2 block text-sm font-medium text-gray-700">
                            Tanggal Kegiatan
                        </label>
                        <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan"
                            value="{{ old('tanggal_kegiatan') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500">
                        <p class="mt-1 text-xs text-gray-500">Opsional: Kapan foto ini diambil</p>
                        @error('tanggal_kegiatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex justify-end gap-3 border-t pt-6">
                    <a href="{{ route('admin.galeri.index') }}"
                        class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                // Validasi ukuran file (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB.');
                    event.target.value = '';
                    return;
                }

                // Validasi tipe file
                const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak valid! Gunakan PNG, JPG, JPEG, atau GIF.');
                    event.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                    document.getElementById('uploadArea').classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function removeImage() {
            document.getElementById('gambar').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('uploadArea').classList.remove('hidden');
        }
    </script>
@endpush
