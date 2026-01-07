@extends('admin.layouts.app')

@section('title', 'Edit Struktur Organisasi')
@section('page-title', 'Edit Struktur Organisasi')
@section('page-subtitle', 'Update gambar struktur organisasi sekolah')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <form action="{{ route('admin.struktur-organisasi.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Gambar Saat Ini -->
            @if ($gambarUrl)
                <div class="mb-6">
                    <label class="mb-2 block font-semibold text-gray-700">Gambar Saat Ini:</label>
                    <img src="{{ $gambarUrl }}" alt="Struktur Organisasi"
                        class="max-h-96 w-full rounded-lg border object-contain">
                </div>
            @endif

            <!-- Upload Gambar Baru -->
            <div class="mb-6">
                <label class="mb-2 block font-semibold text-gray-700">
                    Gambar Baru <span class="text-red-500">*</span>
                </label>
                <input type="file" name="gambar" id="gambar" accept="image/jpeg,image/png,image/jpg"
                    class="@error('gambar') border-red-500 @enderror w-full rounded-lg border border-gray-300 p-2 focus:border-blue-500 focus:outline-none"
                    onchange="previewImage(event)">
                @error('gambar')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG. Maksimal 5MB. Gambar lama akan tergantikan.</p>
            </div>

            <!-- Preview Gambar Baru -->
            <div id="preview-container" class="mb-6 hidden">
                <label class="mb-2 block font-semibold text-gray-700">Preview Gambar Baru:</label>
                <img id="preview" src="" alt="Preview" class="max-h-96 w-full rounded-lg border object-contain">
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <button type="submit"
                    class="rounded-lg bg-blue-600 px-6 py-2 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>Update
                </button>
                <a href="{{ route('admin.struktur-organisasi.index') }}"
                    class="rounded-lg bg-gray-500 px-6 py-2 font-medium text-white transition hover:bg-gray-600">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
            const container = document.getElementById('preview-container');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
