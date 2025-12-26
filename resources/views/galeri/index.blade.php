@extends('layouts.app')

@section('title', 'Galeri Foto')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-800 to-blue-900 py-16">
        <div class="mx-auto max-w-7xl px-4">
            <div class="text-center text-white">
                <h1 class="mb-4 text-4xl font-bold md:text-5xl">Galeri Foto</h1>
                <p class="mx-auto max-w-2xl text-lg text-blue-100">
                    Dokumentasi kegiatan dan aktivitas SMK Teknologi Bantul
                </p>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4">
            @if ($galeri->count() > 0)
                <!-- Grid Galeri -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($galeri as $item)
                        <div
                            class="group relative overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 hover:shadow-2xl">
                            <!-- Image Container -->
                            <div class="aspect-square overflow-hidden bg-gray-100">
                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                    alt="{{ $item->caption ?? 'Galeri SMK Teknologi Bantul' }}"
                                    class="h-full w-full cursor-pointer object-cover transition duration-500 group-hover:scale-110"
                                    onclick="openLightbox({{ $item->id }})">
                            </div>

                            <!-- Overlay Info -->
                            <div
                                class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                @if ($item->caption)
                                    <p class="mb-2 line-clamp-2 text-sm font-medium text-white">{{ $item->caption }}</p>
                                @endif

                                <div class="flex items-center justify-between text-xs text-gray-300">
                                    <span>
                                        <i class="far fa-calendar mr-1"></i>
                                        {{ $item->tanggal_kegiatan ? $item->tanggal_kegiatan->format('d M Y') : $item->created_at->format('d M Y') }}
                                    </span>
                                    <button onclick="openLightbox({{ $item->id }})"
                                        class="rounded-full bg-white/20 px-3 py-1 backdrop-blur-sm transition hover:bg-white/30">
                                        <i class="fas fa-search-plus mr-1"></i> Lihat
                                    </button>
                                </div>
                            </div>

                            <!-- Date Badge -->
                            <div class="absolute left-3 top-3">
                                <div class="rounded-lg bg-white/95 px-3 py-1 text-xs font-semibold text-gray-700 shadow-md">
                                    {{ $item->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $galeri->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="rounded-xl bg-white px-6 py-16 text-center shadow-lg">
                    <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-gray-100">
                        <i class="fas fa-images text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="mb-2 text-2xl font-bold text-gray-800">Belum Ada Foto</h3>
                    <p class="text-gray-600">Galeri foto akan segera diperbarui</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightboxModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/95"
        onclick="closeLightbox()">
        <div class="relative h-full w-full max-w-7xl p-4" onclick="event.stopPropagation()">
            <!-- Close Button -->
            <button onclick="closeLightbox()"
                class="absolute right-6 top-6 z-10 flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20">
                <i class="fas fa-times text-2xl"></i>
            </button>

            <!-- Navigation Buttons -->
            <button id="prevBtn" onclick="navigateImage(-1)"
                class="absolute left-6 top-1/2 z-10 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20">
                <i class="fas fa-chevron-left text-xl"></i>
            </button>
            <button id="nextBtn" onclick="navigateImage(1)"
                class="absolute right-6 top-1/2 z-10 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20">
                <i class="fas fa-chevron-right text-xl"></i>
            </button>

            <!-- Content Container -->
            <div class="flex h-full items-center justify-center">
                <div class="grid h-full w-full gap-4 md:grid-cols-3">
                    <!-- Image (2/3) -->
                    <div class="flex items-center justify-center md:col-span-2">
                        <img id="lightboxImage" src="" alt=""
                            class="max-h-[80vh] w-auto rounded-lg object-contain">
                    </div>

                    <!-- Info Sidebar (1/3) -->
                    <div class="flex flex-col overflow-y-auto rounded-lg bg-white/10 p-6 backdrop-blur-md">
                        <h3 class="mb-4 text-xl font-bold text-white">Detail Foto</h3>

                        <!-- Caption -->
                        <div id="lightboxCaption" class="mb-6"></div>

                        <!-- Info List -->
                        <div class="space-y-4 text-sm text-gray-200">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-calendar mt-1 text-blue-400"></i>
                                <div>
                                    <div class="text-xs text-gray-400">Tanggal Kegiatan</div>
                                    <div id="lightboxTanggal" class="font-medium">-</div>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <i class="fas fa-clock mt-1 text-blue-400"></i>
                                <div>
                                    <div class="text-xs text-gray-400">Diupload</div>
                                    <div id="lightboxCreated" class="font-medium">-</div>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <i class="fas fa-user mt-1 text-blue-400"></i>
                                <div>
                                    <div class="text-xs text-gray-400">Uploader</div>
                                    <div id="lightboxUploader" class="font-medium">-</div>
                                </div>
                            </div>
                        </div>

                        <!-- Download Button -->
                        <div class="mt-auto pt-6">
                            <a id="lightboxDownload" href="" download
                                class="flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-3 font-medium text-white transition hover:bg-blue-700">
                                <i class="fas fa-download"></i>
                                Download Foto
                            </a>
                        </div>

                        <!-- Image Counter -->
                        <div class="mt-4 text-center text-sm text-gray-400">
                            <span id="imageCounter">1 / 1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Data galeri
        const galeriData = @json($galeri->items());
        let currentIndex = 0;

        function openLightbox(id) {
            currentIndex = galeriData.findIndex(g => g.id === id);
            if (currentIndex === -1) return;

            updateLightboxContent();
            document.getElementById('lightboxModal').classList.remove('hidden');
            document.getElementById('lightboxModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightboxModal').classList.add('hidden');
            document.getElementById('lightboxModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        function navigateImage(direction) {
            currentIndex += direction;

            // Loop around
            if (currentIndex < 0) {
                currentIndex = galeriData.length - 1;
            } else if (currentIndex >= galeriData.length) {
                currentIndex = 0;
            }

            updateLightboxContent();
        }

        function updateLightboxContent() {
            const item = galeriData[currentIndex];
            if (!item) return;

            // Update image
            document.getElementById('lightboxImage').src = `/storage/${item.gambar}`;
            document.getElementById('lightboxImage').alt = item.caption || 'Galeri';

            // Update caption
            const captionDiv = document.getElementById('lightboxCaption');
            if (item.caption) {
                captionDiv.innerHTML =
                    `<div class="rounded-lg bg-white/10 p-4"><p class="text-white leading-relaxed">${item.caption}</p></div>`;
            } else {
                captionDiv.innerHTML = '';
            }

            // Update info
            document.getElementById('lightboxTanggal').textContent = item.tanggal_kegiatan ?
                new Date(item.tanggal_kegiatan).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }) :
                new Date(item.created_at).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });

            document.getElementById('lightboxCreated').textContent = new Date(item.created_at).toLocaleDateString(
                'id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

            document.getElementById('lightboxUploader').textContent = item.uploader?.nama_lengkap || 'Admin';

            // Update download link
            document.getElementById('lightboxDownload').href = `/storage/${item.gambar}`;

            // Update counter
            document.getElementById('imageCounter').textContent = `${currentIndex + 1} / ${galeriData.length}`;

            // Show/hide navigation buttons
            document.getElementById('prevBtn').style.display = galeriData.length > 1 ? 'flex' : 'none';
            document.getElementById('nextBtn').style.display = galeriData.length > 1 ? 'flex' : 'none';
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (!document.getElementById('lightboxModal').classList.contains('hidden')) {
                if (e.key === 'Escape') {
                    closeLightbox();
                } else if (e.key === 'ArrowLeft') {
                    navigateImage(-1);
                } else if (e.key === 'ArrowRight') {
                    navigateImage(1);
                }
            }
        });
    </script>
@endpush
