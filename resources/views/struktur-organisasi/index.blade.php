@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-800 to-blue-900 py-16">
        <div class="mx-auto max-w-7xl px-4">
            <div class="text-center text-white">
                <h1 class="mb-4 text-4xl font-bold md:text-5xl">
                    <i class="fas fa-sitemap mr-3"></i>
                    Struktur Organisasi
                </h1>
                <p class="mx-auto max-w-2xl text-lg text-blue-100">
                    Struktur Organisasi {{ $globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Struktur Organisasi Section -->
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4">
            <div class="rounded-xl bg-white p-8 shadow-lg">
                <!-- Image Container -->
                <div class="relative overflow-hidden rounded-lg bg-gray-50">
                    <img src="{{ $gambarUrl }}"
                        alt="Struktur Organisasi {{ $globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul' }}"
                        class="w-full cursor-pointer transition-transform duration-300 hover:scale-105"
                        onclick="openLightbox()" id="strukturImage">
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex flex-wrap justify-center gap-4">
                    <button onclick="openLightbox()"
                        class="inline-flex items-center rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700">
                        <i class="fas fa-search-plus mr-2"></i>
                        Lihat Lebih Besar
                    </button>
                    <a href="{{ $gambarUrl }}" download
                        class="inline-flex items-center rounded-lg bg-green-600 px-6 py-3 font-semibold text-white transition hover:bg-green-700">
                        <i class="fas fa-download mr-2"></i>
                        Download Gambar
                    </a>
                </div>

                <!-- Info Text -->
                <div class="mt-6 rounded-lg bg-blue-50 p-4 text-center">
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                        Klik gambar atau tombol "Lihat Lebih Besar" untuk melihat struktur organisasi secara detail
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightboxModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/95"
        onclick="closeLightbox()">
        <div class="relative h-full w-full p-4" onclick="event.stopPropagation()">
            <!-- Close Button -->
            <button onclick="closeLightbox()"
                class="absolute right-6 top-6 z-10 flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20">
                <i class="fas fa-times text-2xl"></i>
            </button>

            <!-- Zoom Controls -->
            <div class="absolute left-6 top-6 z-10 flex gap-2">
                <button onclick="zoomIn()"
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20"
                    title="Zoom In">
                    <i class="fas fa-search-plus"></i>
                </button>
                <button onclick="zoomOut()"
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20"
                    title="Zoom Out">
                    <i class="fas fa-search-minus"></i>
                </button>
                <button onclick="resetZoom()"
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20"
                    title="Reset Zoom">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>

            <!-- Download Button in Lightbox -->
            <div class="absolute bottom-6 left-1/2 z-10 -translate-x-1/2">
                <a href="{{ $gambarUrl }}" download
                    class="inline-flex items-center rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white backdrop-blur-sm transition hover:bg-blue-700">
                    <i class="fas fa-download mr-2"></i>
                    Download
                </a>
            </div>

            <!-- Image Container with Pan & Zoom -->
            <div class="flex h-full items-center justify-center overflow-hidden">
                <div id="imageWrapper" class="relative" style="transform-origin: center center;">
                    <img id="lightboxImage" src="{{ $gambarUrl }}"
                        alt="Struktur Organisasi {{ $globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul' }}"
                        class="max-h-[85vh] w-auto rounded-lg object-contain" draggable="false">
                </div>
            </div>

            <!-- Zoom Level Indicator -->
            <div class="absolute bottom-6 right-6 rounded-lg bg-white/10 px-4 py-2 text-white backdrop-blur-sm">
                <span id="zoomLevel">100%</span>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let currentZoom = 1;
        let isDragging = false;
        let startX, startY, translateX = 0,
            translateY = 0;

        function openLightbox() {
            document.getElementById('lightboxModal').classList.remove('hidden');
            document.getElementById('lightboxModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
            resetZoom();
        }

        function closeLightbox() {
            document.getElementById('lightboxModal').classList.add('hidden');
            document.getElementById('lightboxModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
            resetZoom();
        }

        function zoomIn() {
            currentZoom = Math.min(currentZoom + 0.25, 3);
            updateZoom();
        }

        function zoomOut() {
            currentZoom = Math.max(currentZoom - 0.25, 0.5);
            updateZoom();
        }

        function resetZoom() {
            currentZoom = 1;
            translateX = 0;
            translateY = 0;
            updateZoom();
        }

        function updateZoom() {
            const wrapper = document.getElementById('imageWrapper');
            wrapper.style.transform = `scale(${currentZoom}) translate(${translateX}px, ${translateY}px)`;
            document.getElementById('zoomLevel').textContent = Math.round(currentZoom * 100) + '%';
        }

        // Mouse wheel zoom
        document.getElementById('lightboxModal')?.addEventListener('wheel', function(e) {
            if (!this.classList.contains('hidden')) {
                e.preventDefault();
                if (e.deltaY < 0) {
                    zoomIn();
                } else {
                    zoomOut();
                }
            }
        });

        // Pan functionality
        const imageWrapper = document.getElementById('imageWrapper');

        imageWrapper?.addEventListener('mousedown', function(e) {
            if (currentZoom > 1) {
                isDragging = true;
                startX = e.clientX - translateX;
                startY = e.clientY - translateY;
                this.style.cursor = 'grabbing';
            }
        });

        document.addEventListener('mousemove', function(e) {
            if (isDragging) {
                translateX = e.clientX - startX;
                translateY = e.clientY - startY;
                updateZoom();
            }
        });

        document.addEventListener('mouseup', function() {
            isDragging = false;
            if (imageWrapper) {
                imageWrapper.style.cursor = currentZoom > 1 ? 'grab' : 'default';
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('lightboxModal');
            if (!modal.classList.contains('hidden')) {
                switch (e.key) {
                    case 'Escape':
                        closeLightbox();
                        break;
                    case '+':
                    case '=':
                        zoomIn();
                        break;
                    case '-':
                        zoomOut();
                        break;
                    case '0':
                        resetZoom();
                        break;
                }
            }
        });

        // Update cursor based on zoom level
        imageWrapper?.addEventListener('mouseover', function() {
            this.style.cursor = currentZoom > 1 ? 'grab' : 'default';
        });
    </script>
@endpush
