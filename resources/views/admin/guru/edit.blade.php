@extends('admin.layouts.app')

@section('title', 'Edit Guru')
@section('page-title', 'Edit Guru')
@section('page-subtitle', 'Perbarui data guru')

@section('content')
    <div class="max-w-4xl">
        <div class="overflow-hidden rounded-xl bg-white shadow-sm">
            <div class="border-b border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800">Form Edit Guru</h3>
            </div>

            <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6 p-6">
                @csrf
                @method('PUT')

                <!-- Nama Lengkap -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $guru->nama_lengkap) }}"
                        required
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan nama lengkap">
                    @error('nama_lengkap')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Foto Profil <span class="text-gray-400">(Opsional)</span>
                    </label>

                    @if ($guru->foto)
                        <div class="mb-3">
                            <p class="mb-2 text-sm text-gray-600">Foto Saat Ini:</p>
                            <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama_lengkap }}"
                                class="h-32 w-32 rounded-lg object-cover">
                        </div>
                    @endif

                    <input type="file" name="foto" accept="image/*" id="foto"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin
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

                <!-- Email -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Email <span class="text-gray-400">(Opsional)</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email', $guru->email) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan email">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
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
                                {{ old('jurusan_id', $guru->jurusan_id) == $j->id ? 'selected' : '' }}>
                                {{ $j->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                    @error('jurusan_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Jabatan <span class="text-gray-400">(Opsional)</span>
                    </label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', $guru->jabatan) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Guru Mata Pelajaran, Wali Kelas">
                    @error('jabatan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mata Pelajaran -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Mata Pelajaran <span class="text-gray-400">(Opsional)</span>
                    </label>
                    <input type="text" name="mata_pelajaran" value="{{ old('mata_pelajaran', $guru->mata_pelajaran) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Matematika, Bahasa Indonesia">
                    @error('mata_pelajaran')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pendidikan Terakhir -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Pendidikan Terakhir <span class="text-gray-400">(Opsional)</span>
                    </label>
                    <input type="text" name="pendidikan_terakhir"
                        value="{{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: S1 Pendidikan Matematika">
                    @error('pendidikan_terakhir')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end space-x-3 border-t pt-6">
                    <a href="{{ route('admin.guru.index') }}"
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
    </script>
@endpush
