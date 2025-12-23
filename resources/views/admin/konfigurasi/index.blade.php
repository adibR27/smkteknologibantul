@extends('admin.layouts.app')

@section('title', 'Konfigurasi Website')
@section('page-title', 'Konfigurasi Website')
@section('page-subtitle', 'Kelola pengaturan umum website sekolah')

@section('content')
    <div class="mx-auto max-w-5xl space-y-6">

        <!-- Form Konfigurasi Utama -->
        <form action="{{ route('admin.konfigurasi.update') }}" method="POST" enctype="multipart/form-data"
            class="rounded-xl bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')

            <!-- Informasi Dasar -->
            <div class="mb-6">
                <h3 class="mb-4 flex items-center text-lg font-semibold text-gray-800">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                    Informasi Dasar
                </h3>

                <div class="space-y-4">
                    <!-- Nama Sekolah -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Nama Sekolah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_sekolah"
                            value="{{ old('nama_sekolah', $konfigurasi->nama_sekolah) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Masukkan nama sekolah" required>
                        @error('nama_sekolah')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" rows="3"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Masukkan alamat lengkap sekolah">{{ old('alamat', $konfigurasi->alamat) }}</textarea>
                        @error('alamat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <!-- No Telepon -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700">No. Telepon</label>
                            <input type="text" name="no_telepon"
                                value="{{ old('no_telepon', $konfigurasi->no_telepon) }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                placeholder="Contoh: 0274-123456">
                            @error('no_telepon')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email', $konfigurasi->email) }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                placeholder="Contoh: info@sekolah.sch.id">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-6">

            <!-- Logo & Favicon -->
            <div class="mb-6">
                <h3 class="mb-4 flex items-center text-lg font-semibold text-gray-800">
                    <i class="fas fa-image mr-2 text-blue-600"></i>
                    Logo & Favicon
                </h3>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Logo -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">Logo Sekolah</label>
                        <div
                            class="flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 p-4 transition hover:border-blue-400">
                            <div class="w-full text-center">
                                <div id="logo-preview-container" class="mb-3">
                                    @if ($konfigurasi->logo)
                                        <div class="relative inline-block">
                                            <img id="logo-preview" src="{{ asset('storage/' . $konfigurasi->logo) }}"
                                                alt="Logo" class="mx-auto h-32 w-32 rounded-lg object-contain">
                                            <button type="button" onclick="deleteLogo()"
                                                class="absolute -right-2 -top-2 flex h-6 w-6 items-center justify-center rounded-full bg-red-500 text-white transition hover:bg-red-600">
                                                <i class="fas fa-times text-xs"></i>
                                            </button>
                                        </div>
                                    @else
                                        <img id="logo-preview" src="" alt="Preview Logo"
                                            class="mx-auto hidden h-32 w-32 rounded-lg object-contain">
                                        <i id="logo-icon" class="fas fa-image text-4xl text-gray-400"></i>
                                    @endif
                                </div>

                                <input type="file" name="logo" id="logo" accept="image/*" class="hidden"
                                    onchange="previewLogo(this)">

                                <label for="logo"
                                    class="inline-block cursor-pointer rounded-lg bg-blue-50 px-4 py-2 text-sm font-medium text-blue-600 transition hover:bg-blue-100">
                                    <i class="fas fa-upload mr-2"></i>Pilih Logo
                                </label>
                                <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, GIF (Max: 2MB)</p>
                            </div>
                        </div>
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Favicon -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">Favicon</label>
                        <div
                            class="flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 p-4 transition hover:border-blue-400">
                            <div class="w-full text-center">
                                <div id="favicon-preview-container" class="mb-3">
                                    @if ($konfigurasi->favicon)
                                        <div class="relative inline-block">
                                            <img id="favicon-preview" src="{{ asset('storage/' . $konfigurasi->favicon) }}"
                                                alt="Favicon" class="mx-auto h-16 w-16 rounded object-contain">
                                            <button type="button" onclick="deleteFavicon()"
                                                class="absolute -right-2 -top-2 flex h-6 w-6 items-center justify-center rounded-full bg-red-500 text-white transition hover:bg-red-600">
                                                <i class="fas fa-times text-xs"></i>
                                            </button>
                                        </div>
                                    @else
                                        <img id="favicon-preview" src="" alt="Preview Favicon"
                                            class="mx-auto hidden h-16 w-16 rounded object-contain">
                                        <i id="favicon-icon" class="fas fa-star text-4xl text-gray-400"></i>
                                    @endif
                                </div>

                                <input type="file" name="favicon" id="favicon" accept="image/*" class="hidden"
                                    onchange="previewFavicon(this)">

                                <label for="favicon"
                                    class="inline-block cursor-pointer rounded-lg bg-blue-50 px-4 py-2 text-sm font-medium text-blue-600 transition hover:bg-blue-100">
                                    <i class="fas fa-upload mr-2"></i>Pilih Favicon
                                </label>
                                <p class="mt-2 text-xs text-gray-500">Format: ICO, PNG (Max: 1MB)</p>
                            </div>
                        </div>
                        @error('favicon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="my-6">

            <!-- SEO & Deskripsi -->
            <div class="mb-6">
                <h3 class="mb-4 flex items-center text-lg font-semibold text-gray-800">
                    <i class="fas fa-search mr-2 text-blue-600"></i>
                    SEO & Deskripsi
                </h3>

                <div class="space-y-4">
                    <!-- Deskripsi -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">Deskripsi Website</label>
                        <textarea name="deskripsi" rows="4"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Deskripsi singkat tentang sekolah untuk meta description">{{ old('deskripsi', $konfigurasi->deskripsi) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Deskripsi ini akan muncul di hasil pencarian Google</p>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Keywords -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">Meta Keywords</label>
                        <input type="text" name="meta_keywords"
                            value="{{ old('meta_keywords', $konfigurasi->meta_keywords) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Contoh: smk, teknologi, bantul, pendidikan">
                        <p class="mt-1 text-xs text-gray-500">Pisahkan kata kunci dengan koma</p>
                        @error('meta_keywords')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-3 border-t pt-6">
                <a href="{{ route('admin.dashboard') }}"
                    class="rounded-lg border border-gray-300 px-6 py-2.5 font-medium text-gray-700 transition hover:bg-gray-50">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit"
                    class="rounded-lg bg-blue-600 px-6 py-2.5 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>

        <!-- Media Sosial Section (OUTSIDE FORM) -->
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h3 class="flex items-center text-lg font-semibold text-gray-800">
                        <i class="fas fa-share-alt mr-2 text-blue-600"></i>
                        Media Sosial
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">Kelola link media sosial sekolah</p>
                </div>
                <button type="button" id="btnTambahMedia"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Tambah Media Sosial
                </button>
            </div>

            @if ($mediaSosial->count() > 0)
                <div class="space-y-3" id="mediaList">
                    @foreach ($mediaSosial as $media)
                        <div
                            class="media-item group flex items-center justify-between rounded-lg border border-gray-200 p-4 transition hover:bg-gray-50">
                            <div class="flex min-w-0 flex-1 items-center space-x-4">
                                <!-- Icon -->
                                <div
                                    class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-50">
                                    <i class="{{ $media->icon }} text-xl text-blue-600"></i>
                                </div>

                                <!-- Content -->
                                <div class="min-w-0 flex-1">
                                    <h4 class="mb-1 font-semibold text-gray-800">{{ $media->platform }}</h4>
                                    <a href="{{ $media->link_url }}" target="_blank"
                                        class="block truncate text-sm text-blue-600 hover:underline">
                                        {{ $media->link_url }}
                                    </a>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="ml-4 flex flex-shrink-0 items-center space-x-2">
                                <a href="javascript:void(0)"
                                    class="btn-edit-media flex h-9 w-9 items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 transition hover:bg-yellow-100"
                                    data-id="{{ $media->id }}"
                                    data-platform="{{ htmlspecialchars($media->platform, ENT_QUOTES) }}"
                                    data-icon="{{ htmlspecialchars($media->icon, ENT_QUOTES) }}"
                                    data-url="{{ htmlspecialchars($media->link_url, ENT_QUOTES) }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)"
                                    class="btn-delete-media flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-600 transition hover:bg-red-100"
                                    data-id="{{ $media->id }}" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-12 text-center text-gray-400">
                    <i class="fas fa-share-alt mb-3 text-5xl"></i>
                    <p>Belum ada media sosial</p>
                    <button type="button" id="btnTambahMediaKosong"
                        class="mt-4 text-sm text-blue-600 hover:text-blue-700">
                        <i class="fas fa-plus mr-1"></i> Tambah Media Sosial Pertama
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Add/Edit Media Sosial -->
    <div id="mediaSosialModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4"
        style="display: none;">
        <div class="w-full max-w-md rounded-xl bg-white shadow-xl">
            <form id="mediaSosialForm" method="POST">
                @csrf
                <input type="hidden" id="method" name="_method" value="POST">

                <div class="p-6">
                    <h3 class="mb-4 text-xl font-bold text-gray-800" id="modalTitle">Tambah Media Sosial</h3>

                    <!-- Platform -->
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Platform <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="platform" id="platform" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Contoh: Facebook, Instagram, YouTube">
                    </div>

                    <!-- Icon -->
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Icon <span class="text-red-500">*</span>
                        </label>
                        <select name="icon" id="icon" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                            <option value="">Pilih Icon</option>
                            <option value="fab fa-facebook">Facebook</option>
                            <option value="fab fa-instagram">Instagram</option>
                            <option value="fab fa-twitter">Twitter</option>
                            <option value="fab fa-youtube">YouTube</option>
                            <option value="fab fa-tiktok">TikTok</option>
                            <option value="fab fa-linkedin">LinkedIn</option>
                            <option value="fab fa-whatsapp">WhatsApp</option>
                            <option value="fab fa-telegram">Telegram</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">
                            <i class="fas fa-info-circle"></i> Preview: <i id="iconPreview" class="ml-2"></i>
                        </p>
                    </div>

                    <!-- Link URL -->
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Link URL <span class="text-red-500">*</span>
                        </label>
                        <input type="url" name="link_url" id="link_url" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="https://facebook.com/...">
                    </div>
                </div>

                <div class="flex justify-end space-x-3 border-t p-4">
                    <button type="button" id="btnCloseModal"
                        class="rounded-lg border border-gray-300 px-4 py-2 font-medium text-gray-700 hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-4 py-2 font-medium text-white hover:bg-blue-700">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            'use strict';

            // Preview Logo & Favicon
            window.previewLogo = function(input) {
                const preview = document.getElementById('logo-preview');
                const icon = document.getElementById('logo-icon');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        if (icon) icon.classList.add('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            };

            window.previewFavicon = function(input) {
                const preview = document.getElementById('favicon-preview');
                const icon = document.getElementById('favicon-icon');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        if (icon) icon.classList.add('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            };

            // Delete Logo & Favicon
            window.deleteLogo = function() {
                if (confirm('Yakin ingin menghapus logo?')) {
                    fetch('{{ route('admin.konfigurasi.deleteLogo') }}', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert('Gagal menghapus logo');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan');
                        });
                }
            };

            window.deleteFavicon = function() {
                if (confirm('Yakin ingin menghapus favicon?')) {
                    fetch('{{ route('admin.konfigurasi.deleteFavicon') }}', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert('Gagal menghapus favicon');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan');
                        });
                }
            };

            // Modal Functions
            const modal = document.getElementById('mediaSosialModal');
            const modalForm = document.getElementById('mediaSosialForm');
            const modalTitle = document.getElementById('modalTitle');
            const methodInput = document.getElementById('method');
            const platformInput = document.getElementById('platform');
            const iconInput = document.getElementById('icon');
            const linkUrlInput = document.getElementById('link_url');
            const iconPreview = document.getElementById('iconPreview');

            function openModal() {
                modal.style.display = 'flex';
            }

            function closeModal() {
                modal.style.display = 'none';
            }

            function openAddModal() {
                modalTitle.textContent = 'Tambah Media Sosial';
                modalForm.action = '{{ route('admin.konfigurasi.media-sosial.store') }}';
                methodInput.value = 'POST';
                platformInput.value = '';
                iconInput.value = '';
                linkUrlInput.value = '';
                iconPreview.className = '';
                openModal();
            }

            function openEditModal(id, platform, icon, linkUrl) {
                modalTitle.textContent = 'Edit Media Sosial';
                modalForm.action = '{{ url('admin/konfigurasi/media-sosial') }}/' + id;
                methodInput.value = 'PUT';
                platformInput.value = platform;
                iconInput.value = icon;
                linkUrlInput.value = linkUrl;
                iconPreview.className = icon;
                openModal();
            }

            // Icon Preview
            iconInput.addEventListener('change', function() {
                iconPreview.className = this.value;
            });

            // Button Events
            const btnTambahMedia = document.getElementById('btnTambahMedia');
            if (btnTambahMedia) {
                btnTambahMedia.addEventListener('click', openAddModal);
            }

            const btnTambahMediaKosong = document.getElementById('btnTambahMediaKosong');
            if (btnTambahMediaKosong) {
                btnTambahMediaKosong.addEventListener('click', openAddModal);
            }

            const btnCloseModal = document.getElementById('btnCloseModal');
            btnCloseModal.addEventListener('click', closeModal);

            // Close modal on outside click
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Close modal on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display === 'flex') {
                    closeModal();
                }
            });

            // Edit Button Event - Using event delegation
            document.addEventListener('click', function(e) {
                const editBtn = e.target.closest('.btn-edit-media');
                if (editBtn) {
                    e.preventDefault();
                    const id = editBtn.getAttribute('data-id');
                    const platform = editBtn.getAttribute('data-platform');
                    const icon = editBtn.getAttribute('data-icon');
                    const linkUrl = editBtn.getAttribute('data-url');
                    openEditModal(id, platform, icon, linkUrl);
                }
            });

            // Delete Button Event - Using event delegation
            document.addEventListener('click', function(e) {
                const deleteBtn = e.target.closest('.btn-delete-media');
                if (deleteBtn) {
                    e.preventDefault();
                    const id = deleteBtn.getAttribute('data-id');

                    if (confirm('Yakin ingin menghapus media sosial ini?')) {
                        // Show loading
                        const icon = deleteBtn.querySelector('i');
                        const originalIcon = icon.className;
                        icon.className = 'fas fa-spinner fa-spin';
                        deleteBtn.style.pointerEvents = 'none';

                        fetch('{{ url('admin/konfigurasi/media-sosial') }}/' + id, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network error');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    window.location.reload();
                                } else {
                                    alert('Gagal menghapus: ' + (data.message || 'Unknown error'));
                                    icon.className = originalIcon;
                                    deleteBtn.style.pointerEvents = 'auto';
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menghapus');
                                icon.className = originalIcon;
                                deleteBtn.style.pointerEvents = 'auto';
                            });
                    }
                }
            });
        })();
    </script>
@endpush
