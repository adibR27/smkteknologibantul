@extends('admin.layouts.app')

@section('title', 'Edit Artikel')
@section('page-title', 'Edit Artikel')
@section('page-subtitle', 'Perbarui artikel yang sudah ada')

@section('content')
    <div class="mx-auto max-w-4xl">
        <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data"
            class="rounded-xl bg-white p-6 shadow-sm" id="artikelForm">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Judul -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Judul Artikel <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" value="{{ old('judul', $artikel->judul) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Masukkan judul artikel" required>
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori & Tanggal Publish -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <!-- Kategori -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="kategori"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            required>
                            <option value="">Pilih Kategori</option>
                            <option value="berita" {{ old('kategori', $artikel->kategori) == 'berita' ? 'selected' : '' }}>
                                Berita</option>
                            <option value="pengumuman"
                                {{ old('kategori', $artikel->kategori) == 'pengumuman' ? 'selected' : '' }}>Pengumuman
                            </option>
                            <option value="kegiatan"
                                {{ old('kategori', $artikel->kategori) == 'kegiatan' ? 'selected' : '' }}>Kegiatan
                            </option>
                            <option value="lainnya"
                                {{ old('kategori', $artikel->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Publish-->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">Tanggal Publish</label>
                        <input type="datetime-local" name="tanggal_publish"
                            value="{{ old('tanggal_publish', $artikel->tanggal_publish ? $artikel->tanggal_publish->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i') : '') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @error('tanggal_publish')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Gambar Utama -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Gambar Utama</label>
                    <div
                        class="flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 p-6 transition hover:border-blue-400">
                        <div class="text-center">
                            <div class="mb-4" id="preview-container"
                                style="{{ $artikel->gambar_utama ? 'display: block;' : 'display: none;' }}">
                                <img id="image-preview"
                                    src="{{ $artikel->gambar_utama ? asset('storage/' . $artikel->gambar_utama) : '' }}"
                                    class="mx-auto max-h-64 rounded-lg" />
                            </div>
                            <i class="fas fa-cloud-upload-alt mb-3 text-4xl text-gray-400" id="upload-icon"
                                style="{{ $artikel->gambar_utama ? 'display: none;' : '' }}"></i>
                            <input type="file" name="gambar_utama" id="gambar_utama" accept="image/*" class="hidden"
                                onchange="previewImage(event)">
                            <label for="gambar_utama"
                                class="cursor-pointer rounded-lg bg-blue-50 px-4 py-2 text-sm font-medium text-blue-600 transition hover:bg-blue-100">
                                <i class="fas fa-upload mr-2"></i>{{ $artikel->gambar_utama ? 'Ganti' : 'Pilih' }} Gambar
                            </label>
                            <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, GIF (Max: 2MB)</p>
                        </div>
                    </div>
                    @error('gambar_utama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konten dengan TinyMCE - HAPUS required -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Konten Artikel <span class="text-red-500">*</span>
                    </label>
                    <textarea name="konten" id="konten" rows="15" placeholder="Tulis konten artikel di sini...">{{ old('konten', $artikel->konten) }}</textarea>
                    @error('konten')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-red-600" id="konten-error" style="display: none;">Konten artikel wajib
                        diisi!</p>
                </div>

                <!-- Info Tambahan -->
                <div class="rounded-lg bg-gray-50 p-4">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600">Penulis:</p>
                            <p class="font-semibold text-gray-800">{{ $artikel->penulis->nama_lengkap ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Total Views:</p>
                            <p class="font-semibold text-gray-800">{{ number_format($artikel->views) }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Dibuat:</p>
                            <p class="font-semibold text-gray-800">
                                {{ $artikel->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-600">Terakhir Diupdate:</p>
                            <p class="font-semibold text-gray-800">
                                {{ $artikel->updated_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 flex items-center justify-end space-x-3 border-t pt-6">
                <a href="{{ route('admin.artikel.index') }}"
                    class="rounded-lg border border-gray-300 px-6 py-2.5 font-medium text-gray-700 transition hover:bg-gray-50">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit"
                    class="rounded-lg bg-blue-600 px-6 py-2.5 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>Perbarui Artikel
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/g6hc18ycs57jyq3d2lyayai9ala30ew1n7bm1ly7naaixo2w/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        // Initialize TinyMCE dengan support video
        tinymce.init({
            selector: '#konten',
            height: 500,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'link image media table | removeformat code fullscreen help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',

            // KONFIGURASI MEDIA (YouTube, Vimeo, dll)
            media_live_embeds: true,
            media_url_resolver: function(data, resolve) {
                if (data.url.indexOf('youtube.com') !== -1 || data.url.indexOf('youtu.be') !== -1) {
                    let videoId = '';

                    // Extract video ID dari berbagai format URL YouTube
                    if (data.url.indexOf('youtu.be') !== -1) {
                        videoId = data.url.split('youtu.be/')[1].split('?')[0];
                    } else if (data.url.indexOf('youtube.com') !== -1) {
                        if (data.url.indexOf('v=') !== -1) {
                            videoId = data.url.split('v=')[1].split('&')[0];
                        } else if (data.url.indexOf('embed/') !== -1) {
                            videoId = data.url.split('embed/')[1].split('?')[0];
                        }
                    }

                    if (videoId) {
                        resolve({
                            html: '<iframe width="560" height="315" src="https://www.youtube.com/embed/' +
                                videoId +
                                '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
                        });
                    }
                } else {
                    resolve({
                        html: ''
                    });
                }
            },

            // Konfigurasi Upload Gambar
            images_upload_handler: function(blobInfo, progress) {
                return new Promise((resolve, reject) => {
                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    // Upload ke server Laravel
                    fetch('/admin/upload-image', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.location) {
                                resolve(data.location);
                            } else {
                                reject('Upload gagal');
                            }
                        })
                        .catch(() => {
                            reject('Upload gagal');
                        });
                });
            }
        });

        // Validasi form sebelum submit
        document.getElementById('artikelForm').addEventListener('submit', function(e) {
            // Sync TinyMCE content ke textarea
            tinymce.triggerSave();

            // Ambil konten dari TinyMCE
            const konten = tinymce.get('konten').getContent();

            // Cek apakah konten kosong
            if (!konten || konten.trim() === '') {
                e.preventDefault();
                document.getElementById('konten-error').style.display = 'block';

                // Scroll ke editor
                tinymce.get('konten').focus();

                // Alert
                alert('Konten artikel wajib diisi!');
                return false;
            }

            // Sembunyikan error jika ada
            document.getElementById('konten-error').style.display = 'none';
        });

        // Preview Gambar Utama
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('preview-container').style.display = 'block';
                    document.getElementById('upload-icon').style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
