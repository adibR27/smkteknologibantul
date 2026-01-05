@extends('admin.layouts.app')

@section('title', 'Edit Jurusan')
@section('page-title', 'Edit Jurusan')
@section('page-subtitle', 'Perbarui data program keahlian')

@push('styles')
    <script src="https://cdn.tiny.cloud/1/g6hc18ycs57jyq3d2lyayai9ala30ew1n7bm1ly7naaixo2w/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
@endpush

@section('content')
    <div class="mx-auto max-w-4xl">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.jurusan.index') }}"
                class="inline-flex items-center text-sm text-gray-600 transition hover:text-gray-900">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Jurusan
            </a>
        </div>

        <!-- Form Card -->
        <div class="overflow-hidden rounded-xl bg-white shadow-sm">
            <div class="border-b border-gray-200 bg-gradient-to-r from-yellow-50 to-yellow-100 px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-edit mr-2 text-yellow-600"></i>
                    Form Edit Jurusan
                </h3>
            </div>

            <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data"
                id="jurusanForm" class="p-6">
                @csrf
                @method('PUT')

                <!-- Nama Jurusan -->
                <div class="mb-6">
                    <label for="nama_jurusan" class="mb-2 block text-sm font-semibold text-gray-700">
                        Nama Jurusan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_jurusan" id="nama_jurusan"
                        value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}"
                        class="@error('nama_jurusan') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Contoh: Teknik Komputer dan Jaringan" required>
                    @error('nama_jurusan')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fasilitas Jurusan -->
                <div class="mb-6">
                    <label for="fasilitas_jurusan" class="mb-2 block text-sm font-semibold text-gray-700">
                        Fasilitas Jurusan
                    </label>
                    <input type="text" name="fasilitas_jurusan" id="fasilitas_jurusan"
                        value="{{ old('fasilitas_jurusan', $jurusan->fasilitas_jurusan) }}"
                        class="@error('fasilitas_jurusan') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Contoh: Lab Komputer, Ruang Server, dll">
                    @error('fasilitas_jurusan')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-6">
                    <label for="deskripsi" class="mb-2 block text-sm font-semibold text-gray-700">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" id="deskripsi" class="@error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $jurusan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <p id="deskripsi-error" class="mt-1 hidden text-sm text-red-500">
                        Deskripsi wajib diisi
                    </p>
                </div>

                <!-- Gambar -->
                <div class="mb-6">
                    <label for="gambar" class="mb-2 block text-sm font-semibold text-gray-700">
                        Gambar Jurusan
                    </label>

                    <!-- Preview Gambar Lama -->
                    @if ($jurusan->gambar)
                        <div class="mb-3">
                            <p class="mb-2 text-sm text-gray-600">Gambar Saat Ini:</p>
                            <img src="{{ asset('storage/' . $jurusan->gambar) }}" alt="{{ $jurusan->nama_jurusan }}"
                                class="h-32 w-48 rounded-lg object-cover shadow-md" id="current-image">
                        </div>
                    @endif

                    <div class="flex items-start space-x-4">
                        <div class="flex-1">
                            <input type="file" name="gambar" id="gambar" accept="image/*"
                                class="@error('gambar') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                onchange="previewImage(event)">
                            @error('gambar')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">
                                Format: JPG, PNG, GIF (Max: 2MB) - Kosongkan jika tidak ingin mengubah gambar
                            </p>
                        </div>
                        <div id="preview-container" class="hidden">
                            <p class="mb-2 text-sm text-gray-600">Preview Gambar Baru:</p>
                            <img id="preview-image" src="" alt="Preview"
                                class="h-32 w-48 rounded-lg object-cover shadow-md">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3 border-t border-gray-200 pt-6">
                    <a href="{{ route('admin.jurusan.index') }}"
                        class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="rounded-lg bg-yellow-500 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-yellow-600">
                        <i class="fas fa-save mr-2"></i>
                        Update Jurusan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Preview Image
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                    // Sembunyikan gambar lama saat preview baru muncul
                    const currentImage = document.getElementById('current-image');
                    if (currentImage) {
                        currentImage.style.opacity = '0.5';
                    }
                }
                reader.readAsDataURL(file);
            } else {
                document.getElementById('preview-container').classList.add('hidden');
                const currentImage = document.getElementById('current-image');
                if (currentImage) {
                    currentImage.style.opacity = '1';
                }
            }
        }

        // Initialize TinyMCE
        tinymce.init({
            selector: '#deskripsi',
            height: 400,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });

        // Validasi form sebelum submit
        document.getElementById('jurusanForm').addEventListener('submit', function(e) {
            tinymce.triggerSave();
            const deskripsi = tinymce.get('deskripsi').getContent();

            if (!deskripsi || deskripsi.trim() === '') {
                e.preventDefault();
                document.getElementById('deskripsi-error').style.display = 'block';
                tinymce.get('deskripsi').focus();
                alert('Deskripsi wajib diisi!');
                return false;
            }

            document.getElementById('deskripsi-error').style.display = 'none';
        });
    </script>
@endpush
