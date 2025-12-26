@extends('admin.layouts.app')

@section('title', 'Edit Foto Galeri')
@section('page-title', 'Galeri')
@section('page-subtitle', 'Edit foto galeri')

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
                        <span class="text-gray-500">Edit Foto</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Form Card -->
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <div class="mb-6 border-b pb-4">
                <h3 class="text-xl font-bold text-gray-800">Edit Foto</h3>
                <p class="mt-1 text-sm text-gray-600">Perbarui informasi foto galeri</p>
            </div>

            <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Upload Gambar -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Gambar
                        </label>
                        <div class="space-y-3">
                            <!-- Current Image -->
                            <div id="currentImage">
                                <p class="mb-2 text-xs text-gray-500">Gambar saat ini:</p>
                                <div class="relative inline-block">
                                    <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="Current"
                                        class="h-64 w-auto rounded-lg border-2 border-gray-300 object-cover shadow-md">
                                </div>
                            </div>

                            <!-- Preview New Image -->
                            <div id="imagePreview" class="hidden">
                                <p class="mb-2 text-xs text-gray-500">Gambar baru:</p>
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
                            <div>
                                <label for="gambar"
                                    class="inline-flex cursor-pointer items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                                    <i class="fas fa-image mr-2"></i>
                                    Ganti Gambar
                                    <input id="gambar" name="gambar" type="file" class="hidden"
                                        accept="image/png,image/jpeg,image/jpg,image/gif" onchange="previewImage(event)">
                                </label>
                                <p class="mt-1 text-xs text-gray-500">PNG, JPG, JPEG atau GIF (MAX. 2MB). Kosongkan jika
                                    tidak ingin mengganti.</p>
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
                            placeholder="Tambahkan deskripsi atau caption untuk foto ini...">{{ old('caption', $galeri->caption) }}</textarea>
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
                            value="{{ old('tanggal_kegiatan', $galeri->tanggal_kegiatan ? $galeri->tanggal_kegiatan->format('Y-m-d') : '') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500">
                        <p class="mt-1 text-xs text-gray-500">Opsional: Kapan foto ini diambil</p>
                        @error('tanggal_kegiatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info -->
                    <div class="rounded-lg bg-gray-50 p-4">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle mr-3 mt-1 text-blue-500"></i>
                            <div class="text-sm text-gray-600">
                                <p class="mb-1"><strong>Informasi:</strong></p>
                                <ul class="list-inside list-disc space-y-1">
                                    <li>Diupload oleh: <strong>{{ $galeri->uploader->nama_lengkap ?? 'Unknown' }}</strong>
                                    </li>
                                    <li>Tanggal upload: <strong>{{ $galeri->created_at->format('d M Y H:i') }}</strong>
                                    </li>
                                    @if ($galeri->created_at != $galeri->updated_at)
                                        <li>Terakhir diupdate:
                                            <strong>{{ $galeri->updated_at->format('d M Y H:i') }}</strong>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
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
                        <i class="fas fa-save mr-2"></i>Update
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
                    document.getElementById('currentImage').classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function removeImage() {
            document.getElementById('gambar').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('currentImage').classList.remove('hidden');
        }
    </script>
@endpush
