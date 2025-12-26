@extends('admin.layouts.app')

@section('title', 'Edit Dokumen')
@section('page-title', 'Edit Dokumen')
@section('page-subtitle', 'Perbarui informasi dokumen')

@section('content')
    <div class="mx-auto max-w-3xl">
        <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data"
            class="rounded-xl bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Judul -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Judul Dokumen <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" value="{{ old('judul', $dokumen->judul) }}"
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
                        <option value="kurikulum"
                            {{ old('kategori', $dokumen->kategori) == 'kurikulum' ? 'selected' : '' }}>Kurikulum
                        </option>
                        <option value="panduan" {{ old('kategori', $dokumen->kategori) == 'panduan' ? 'selected' : '' }}>
                            Panduan</option>
                        <option value="jadwal" {{ old('kategori', $dokumen->kategori) == 'jadwal' ? 'selected' : '' }}>
                            Jadwal</option>
                        <option value="lainnya" {{ old('kategori', $dokumen->kategori) == 'lainnya' ? 'selected' : '' }}>
                            Lainnya</option>
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
                        placeholder="Deskripsi singkat tentang dokumen (opsional)">{{ old('deskripsi', $dokumen->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- File Saat Ini -->
                <div class="rounded-lg bg-blue-50 p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-file-pdf text-2xl text-blue-600"></i>
                            <div>
                                <p class="font-semibold text-gray-800">File Saat Ini:</p>
                                <p class="text-sm text-gray-600">{{ $dokumen->nama_file }}</p>
                                <p class="text-xs text-gray-500">Ukuran:
                                    {{ number_format($dokumen->ukuran_file / 1024, 2) }} KB</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.dokumen.download', $dokumen->id) }}"
                            class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700">
                            <i class="fas fa-download mr-2"></i>Download
                        </a>
                    </div>
                </div>

                <!-- File Upload (Opsional untuk update) -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Upload File Baru (Opsional)
                    </label>
                    <div
                        class="flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 p-6 transition hover:border-blue-400">
                        <div class="text-center">
                            <i class="fas fa-cloud-upload-alt mb-3 text-4xl text-gray-400"></i>
                            <input type="file" name="file" id="file"
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" class="hidden"
                                onchange="updateFileName(this)">
                            <label for="file"
                                class="cursor-pointer rounded-lg bg-blue-50 px-4 py-2 text-sm font-medium text-blue-600 transition hover:bg-blue-100">
                                <i class="fas fa-file-upload mr-2"></i>Pilih File Baru
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
                    <p class="mt-2 text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Kosongkan jika tidak ingin mengubah file
                    </p>
                </div>

                <!-- Info Tambahan -->
                <div class="rounded-lg bg-gray-50 p-4">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600">Diupload oleh:</p>
                            <p class="font-semibold text-gray-800">
                                {{ $dokumen->uploader->nama_lengkap ?? 'Admin' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-600">Tanggal Upload:</p>
                            <p class="font-semibold text-gray-800">
                                {{ $dokumen->created_at->format('d M Y H:i') }} WIB
                            </p>
                        </div>
                    </div>
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
                    <i class="fas fa-save mr-2"></i>Perbarui Dokumen
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function updateFileName(input) {
            const fileName = input.files[0] ? input.files[0].name : '';
            document.getElementById('fileName').textContent = fileName ? 'File baru: ' + fileName : '';
        }
    </script>
@endpush
