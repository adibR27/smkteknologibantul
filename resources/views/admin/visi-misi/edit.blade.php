@extends('admin.layouts.app')

@section('title', $visiMisi ? 'Edit Visi & Misi' : 'Tambah Visi & Misi')
@section('page-title', $visiMisi ? 'Edit Visi & Misi' : 'Tambah Visi & Misi')
@section('page-subtitle', 'Kelola visi dan misi sekolah')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <form action="{{ route('admin.visi-misi.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Visi -->
            <div class="mb-6">
                <label class="mb-2 block font-semibold text-gray-700">
                    Visi Sekolah <span class="text-red-500">*</span>
                </label>
                <textarea name="visi" rows="5"
                    class="@error('visi') border-red-500 @enderror w-full rounded-lg border border-gray-300 p-3 focus:border-blue-500 focus:outline-none"
                    placeholder="Masukkan visi sekolah...">{{ old('visi', $visiMisi->visi ?? '') }}</textarea>
                @error('visi')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Visi adalah pandangan jauh ke depan tentang tujuan sekolah.</p>
            </div>

            <!-- Misi -->
            <div class="mb-6">
                <label class="mb-2 block font-semibold text-gray-700">
                    Misi Sekolah <span class="text-red-500">*</span>
                </label>
                <textarea name="misi" rows="10"
                    class="@error('misi') border-red-500 @enderror w-full rounded-lg border border-gray-300 p-3 focus:border-blue-500 focus:outline-none"
                    placeholder="Masukkan misi sekolah (pisahkan dengan enter untuk poin-poin)...">{{ old('misi', $visiMisi->misi ?? '') }}</textarea>
                @error('misi')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Misi adalah langkah-langkah untuk mencapai visi. Gunakan enter untuk
                    membuat poin baru.</p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <button type="submit"
                    class="rounded-lg bg-blue-600 px-6 py-2 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
                <a href="{{ route('admin.visi-misi.index') }}"
                    class="rounded-lg bg-gray-500 px-6 py-2 font-medium text-white transition hover:bg-gray-600">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
@endsection
