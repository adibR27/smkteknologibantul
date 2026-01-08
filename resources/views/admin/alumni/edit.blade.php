@extends('admin.layouts.app')

@section('title', 'Edit Alumni')
@section('page-title', 'Edit Alumni')
@section('page-subtitle', 'Perbarui data alumni')

@section('content')
    <div class="max-w-4xl">
        <div class="overflow-hidden rounded-xl bg-white shadow-sm">
            <div class="border-b border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800">Form Edit Alumni</h3>
            </div>

            <form action="{{ route('admin.alumni.update', $alumni->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6 p-6">
                @csrf
                @method('PUT')

                <!-- Nama Lengkap -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $alumni->nama_lengkap) }}"
                        required
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan nama lengkap alumni">
                    @error('nama_lengkap')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Foto Alumni <span class="text-gray-400">(Opsional)</span>
                    </label>

                    @if ($alumni->foto)
                        <div class="mb-3">
                            <p class="mb-2 text-sm text-gray-600">Foto Saat Ini:</p>
                            <img src="{{ asset('storage/' . $alumni->foto) }}" alt="{{ $alumni->nama_lengkap }}"
                                class="h-32 w-32 rounded-lg object-cover">
                        </div>
                    @endif

                    <input type="file" name="foto" accept="image/*" id="foto"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin
                        mengubah foto</p>
                    @error('foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Preview -->
                    <div id="preview" class="mt-3 hidden">
                        <p class="mb-2 text-sm text-gray-600">Preview Foto Baru:</p>
                        <img id="preview-image" class="h-32 w-32 rounded-lg object-cover" alt="Preview">
                    </div>
                </div>

                <!-- Jurusan -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Jurusan <span class="text-gray-400">(Opsional)</span>
                    </label>
                    <select name="jurusan_id"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach ($jurusan as $j)
                            <option value="{{ $j->id }}"
                                {{ old('jurusan_id', $alumni->jurusan_id) == $j->id ? 'selected' : '' }}>
                                {{ $j->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                    @error('jurusan_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tahun Lulus -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Tahun Lulus <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}"
                        required min="1900" max="{{ date('Y') + 1 }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: 2024">
                    @error('tahun_lulus')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pekerjaan Sekarang -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Pekerjaan Sekarang <span class="text-gray-400">(Opsional)</span>
                    </label>
                    <input type="text" name="pekerjaan_sekarang"
                        value="{{ old('pekerjaan_sekarang', $alumni->pekerjaan_sekarang) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Software Engineer di PT. ABC">
                    @error('pekerjaan_sekarang')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pesan Alumni -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Pesan Alumni <span class="text-gray-400">(Opsional)</span>
                    </label>
                    <textarea name="pesan_alumni" id="pesan_alumni" rows="6" maxlength="1000"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                        placeholder="Pesan atau testimoni dari alumni (maksimal 1000 karakter)">{{ old('pesan_alumni', $alumni->pesan_alumni) }}</textarea>
                    @error('pesan_alumni')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <div class="mt-1 flex items-center justify-between">
                        <p class="text-sm text-gray-500">Maksimal 1000 karakter</p>
                        <p class="text-sm font-medium" id="char-count">
                            <span id="current-count">0</span>/1000
                        </p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end space-x-3 border-t pt-6">
                    <a href="{{ route('admin.alumni.index') }}"
                        class="rounded-lg border border-gray-300 px-6 py-2 text-gray-700 transition hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex items-center space-x-2 rounded-lg bg-blue-600 px-6 py-2 text-white transition hover:bg-blue-700">
                        <i class="fas fa-save"></i>
                        <span>Update Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Preview Image
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').classList.remove('hidden');
                    document.getElementById('preview-image').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Character Counter untuk Pesan Alumni
        const pesanAlumni = document.getElementById('pesan_alumni');
        const currentCount = document.getElementById('current-count');
        const charCount = document.getElementById('char-count');

        // Update count on page load (untuk existing value)
        updateCharCount();

        pesanAlumni.addEventListener('input', updateCharCount);

        function updateCharCount() {
            const length = pesanAlumni.value.length;
            currentCount.textContent = length;

            // Ubah warna berdasarkan jumlah karakter
            if (length > 950) { // 95% dari 1000
                charCount.classList.remove('text-gray-600', 'text-yellow-600');
                charCount.classList.add('text-red-600');
            } else if (length > 800) { // 80% dari 1000
                charCount.classList.remove('text-gray-600', 'text-red-600');
                charCount.classList.add('text-yellow-600');
            } else {
                charCount.classList.remove('text-red-600', 'text-yellow-600');
                charCount.classList.add('text-gray-600');
            }
        }
    </script>
@endpush
