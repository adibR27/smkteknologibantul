@extends('admin.layouts.app')

@section('title', 'Tambah Prestasi')
@section('page-title', 'Tambah Prestasi')
@section('page-subtitle', 'Tambahkan prestasi baru')

@section('content')
    <div class="mx-auto max-w-4xl">
        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Tambah Prestasi Baru</h1>
                <p class="text-sm text-gray-600">Lengkapi form di bawah untuk menambahkan prestasi</p>
            </div>
            <a href="{{ route('admin.prestasi.index') }}"
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form Card -->
        <div class="rounded-lg bg-white p-6 shadow">
            <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-6">
                    <!-- Judul Prestasi -->
                    <div>
                        <label for="judul_prestasi" class="mb-2 block text-sm font-medium text-gray-700">
                            Judul Prestasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="judul_prestasi" name="judul_prestasi" value="{{ old('judul_prestasi') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan judul prestasi" required>
                        @error('judul_prestasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tingkat -->
                    <div>
                        <label for="tingkat" class="mb-2 block text-sm font-medium text-gray-700">
                            Tingkat <span class="text-red-500">*</span>
                        </label>
                        <select id="tingkat" name="tingkat"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="">Pilih Tingkat</option>
                            <option value="sekolah" {{ old('tingkat') == 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                            <option value="kecamatan" {{ old('tingkat') == 'kecamatan' ? 'selected' : '' }}>Kecamatan
                            </option>
                            <option value="kabupaten" {{ old('tingkat') == 'kabupaten' ? 'selected' : '' }}>Kabupaten
                            </option>
                            <option value="provinsi" {{ old('tingkat') == 'provinsi' ? 'selected' : '' }}>Provinsi</option>
                            <option value="nasional" {{ old('tingkat') == 'nasional' ? 'selected' : '' }}>Nasional
                            </option>
                            <option value="internasional" {{ old('tingkat') == 'internasional' ? 'selected' : '' }}>
                                Internasional</option>
                        </select>
                        @error('tingkat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Row: Peraih & Tanggal -->
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Peraih -->
                        <div>
                            <label for="peraih" class="mb-2 block text-sm font-medium text-gray-700">
                                Peraih
                            </label>
                            <input type="text" id="peraih" name="peraih" value="{{ old('peraih') }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Nama siswa/tim">
                            @error('peraih')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Perolehan -->
                        <div>
                            <label for="tanggal_perolehan" class="mb-2 block text-sm font-medium text-gray-700">
                                Tanggal Perolehan
                            </label>
                            <input type="date" id="tanggal_perolehan" name="tanggal_perolehan"
                                value="{{ old('tanggal_perolehan') }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('tanggal_perolehan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Penyelenggara -->
                    <div>
                        <label for="penyelenggara" class="mb-2 block text-sm font-medium text-gray-700">
                            Penyelenggara
                        </label>
                        <input type="text" id="penyelenggara" name="penyelenggara" value="{{ old('penyelenggara') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Nama penyelenggara/lembaga">
                        @error('penyelenggara')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="mb-2 block text-sm font-medium text-gray-700">
                            Deskripsi
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="5"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Deskripsi prestasi (opsional)">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div>
                        <label for="gambar" class="mb-2 block text-sm font-medium text-gray-700">
                            Gambar
                        </label>
                        <div class="flex items-center space-x-4">
                            <div class="flex-1">
                                <input type="file" id="gambar" name="gambar" accept="image/*"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    onchange="previewImage(this)">
                                <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                            </div>
                        </div>
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Preview Image -->
                        <div id="preview-container" class="mt-4 hidden">
                            <img id="preview-image" src="" alt="Preview"
                                class="h-48 w-auto rounded-lg object-cover shadow">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex items-center justify-end space-x-3 border-t pt-6">
                    <a href="{{ route('admin.prestasi.index') }}"
                        class="rounded-lg border border-gray-300 bg-white px-6 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                        <i class="fas fa-save mr-2"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview-image');
            const previewContainer = document.getElementById('preview-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                previewContainer.classList.add('hidden');
            }
        }
    </script>
@endpush
