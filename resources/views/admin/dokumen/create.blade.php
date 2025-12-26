@extends('admin.layouts.app')

@section('title', 'Tambah Dokumen')
@section('page-title', 'Tambah Dokumen')
@section('page-subtitle', 'Upload dokumen baru')

@section('content')
    <div class="mx-auto max-w-3xl">
        <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data"
            class="rounded-xl bg-white p-6 shadow-sm">
            @csrf

            <div class="space-y-6">
                <!-- Judul -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Judul Dokumen <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Contoh: Panduan PPDB 2024" required>
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        required>
                        <option value="">Pilih Kategori</option>
                        <option value="kurikulum" {{ old('kategori') == 'kurikulum' ? 'selected' : '' }}>Kurikulum
                        </option>
                        <option value="panduan" {{ old('kategori') == 'panduan' ? 'selected' : '' }}>Panduan</option>
                        <option value="jadwal" {{ old('kategori') == 'jadwal' ? 'selected' : '' }}>Jadwal</option>
                        <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Deskripsi singkat tentang dokumen (opsional)">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- File Upload -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Upload File <span class="text-red-500">*</span>
                    </label>
                    <div
                        class="flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 p-6 transition hover:border-blue-400">
                        <div class="text-center">
                            <i class="fas fa-cloud-upload-alt mb-3 text-4xl text-gray-400"></i>
                            <input type="file" name="file" id="file"
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" class="hidden"
                                onchange="updateFileName(this)" required>
                            <label for="file"
                                class="cursor-pointer rounded-lg bg-blue-50 px-4 py-2 text-sm font-medium text-blue-600 transition hover:bg-blue-100">
                                <i class="fas fa-file-upload mr-2"></i>Pilih File
                            </label>
                            <p class="mt-2 text-xs text-gray-500">
                                Format: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX (Max: 10MB)
                            </p>
                            <p id="fileName" class="mt-2 text-sm font-medium text-blue-600"></p>
                        </div>
                    </div>
                    @error('file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 flex items-center justify-end space-x-3 border-t pt-6">
                <a href="{{ route('admin.dokumen.index') }}"
                    class="rounded-lg border border-gray-300 px-6 py-2.5 font-medium text-gray-700 transition hover:bg-gray-50">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit"
                    class="rounded-lg bg-blue-600 px-6 py-2.5 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>Simpan Dokumen
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function updateFileName(input) {
            const fileName = input.files[0] ? input.files[0].name : '';
            document.getElementById('fileName').textContent = fileName ? 'File: ' + fileName : '';
        }
    </script>
@endpush
