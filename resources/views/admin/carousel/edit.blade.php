@extends('admin.layouts.app')

@section('title', 'Edit Carousel')
@section('page-title', 'Edit Carousel')
@section('page-subtitle', 'Perbarui gambar carousel')

@section('content')
    <div class="max-w-3xl">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.carousel.index') }}"
                class="inline-flex items-center text-gray-600 transition hover:text-gray-900">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Carousel
            </a>
        </div>

        <!-- Form Card -->
        <div class="rounded-xl bg-white shadow-sm">
            <div class="border-b border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800">Form Edit Carousel</h3>
                <p class="mt-1 text-sm text-gray-500">Perbarui informasi carousel</p>
            </div>

            <form action="{{ route('admin.carousel.update', $carousel) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6 p-6">
                @csrf
                @method('PUT')

                <!-- Gambar Saat Ini -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Gambar Saat Ini
                    </label>
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $carousel->gambar) }}" alt="Current Carousel"
                            class="h-48 max-w-full rounded-lg object-cover shadow-md">
                    </div>
                </div>

                <!-- Upload Gambar Baru -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Ganti Gambar (Opsional)
                    </label>
                    <div
                        class="mt-1 flex justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 pb-6 pt-5 transition hover:border-gray-400">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-cloud-upload-alt mb-3 text-4xl text-gray-400"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="gambar"
                                    class="relative cursor-pointer rounded-md bg-white font-medium text-blue-600 hover:text-blue-500">
                                    <span>Upload gambar baru</span>
                                    <input id="gambar" name="gambar" type="file" class="sr-only" accept="image/*"
                                        onchange="previewImage(event)">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                        </div>
                    </div>

                    <!-- Preview Image -->
                    <div id="imagePreview" class="mt-4 hidden">
                        <p class="mb-2 text-sm text-gray-600">Preview gambar baru:</p>
                        <img id="preview" src="" alt="Preview"
                            class="h-48 max-w-full rounded-lg object-cover shadow-md">
                    </div>

                    @error('gambar')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="mb-2 block text-sm font-medium text-gray-700">
                        Deskripsi
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan deskripsi carousel (opsional)">{{ old('deskripsi', $carousel->deskripsi) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Deskripsi yang akan ditampilkan pada carousel</p>
                    @error('deskripsi')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end space-x-3 border-t border-gray-200 pt-6">
                    <a href="{{ route('admin.carousel.index') }}"
                        class="rounded-lg border border-gray-300 px-6 py-2 text-gray-700 transition hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex items-center space-x-2 rounded-lg bg-blue-600 px-6 py-2 text-white transition hover:bg-blue-700">
                        <i class="fas fa-save"></i>
                        <span>Update Carousel</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('preview');
                const previewContainer = document.getElementById('imagePreview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection
