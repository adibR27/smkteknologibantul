<section class="carousel-section relative z-10">
    @if ($carousel->count() > 0)
        <!-- Swiper -->
        <div class="swiper carouselSwiper">
            <div class="swiper-wrapper">
                @foreach ($carousel as $index => $item)
                    <div class="swiper-slide">
                        <!-- RESPONSIVE HEIGHT -->
                        <div class="relative h-[400px] sm:h-[500px] md:h-[600px] lg:h-[700px]">
                            <!-- Image - OBJECT-COVER untuk gambar landscape -->
                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                alt="{{ $item->deskripsi ?? 'Carousel ' . ($index + 1) }}"
                                class="h-full w-full object-cover" style="object-position: center center;"
                                loading="{{ $index === 0 ? 'eager' : 'lazy' }}">

                            <!-- Overlay gradient -->
                            <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/40 to-black/70"></div>

                            <!-- Content -->
                            @if ($item->deskripsi)
                                @if ($loop->first)
                                    {{-- Slide Pertama: Full Content di Tengah --}}
                                    <div class="absolute inset-0 z-10 flex items-center justify-center px-4">
                                        <div class="mx-auto max-w-5xl text-center">
                                            <h2
                                                class="animate__animated animate__fadeInUp mb-4 text-2xl font-bold leading-tight text-white drop-shadow-2xl sm:text-3xl md:mb-6 md:text-5xl lg:text-6xl xl:text-7xl">
                                                {{ $item->deskripsi }}
                                            </h2>
                                            <p
                                                class="animate__animated animate__fadeInUp animate__delay-1s mb-6 text-sm text-white/95 drop-shadow-lg sm:text-base md:mb-10 md:text-xl lg:text-2xl xl:text-3xl">
                                                {{ $globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul' }} -
                                                Mencetak Generasi Unggul
                                            </p>
                                            <div
                                                class="animate__animated animate__fadeInUp animate__delay-2s flex flex-col justify-center gap-3 sm:flex-row sm:gap-4">
                                                <a href="{{ route('jurusan.index') }}"
                                                    class="group inline-flex transform items-center justify-center rounded-full bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition-all duration-300 hover:scale-105 hover:bg-blue-700 hover:shadow-2xl sm:px-8 sm:py-4 sm:text-base">
                                                    <i
                                                        class="fas fa-graduation-cap mr-2 group-hover:animate-bounce"></i>
                                                    Lihat Jurusan
                                                </a>
                                                <a href="{{ route('kontak.index') }}"
                                                    class="group inline-flex transform items-center justify-center rounded-full border-2 border-white bg-white/20 px-6 py-3 text-sm font-semibold text-white backdrop-blur-sm transition-all duration-300 hover:scale-105 hover:bg-white/30 hover:shadow-2xl sm:px-8 sm:py-4 sm:text-base">
                                                    <i class="fas fa-envelope mr-2 group-hover:animate-pulse"></i>
                                                    Hubungi Kami
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{-- Slide lainnya: Content di bawah --}}
                                    <div class="absolute inset-x-0 bottom-0 z-10 pb-8 sm:pb-12 md:pb-16 lg:pb-20">
                                        <div class="mx-auto max-w-4xl px-4 text-center">
                                            <!-- Simple Line Decoration -->
                                            <div
                                                class="animate__animated animate__fadeIn mx-auto mb-3 h-1 w-16 rounded-full bg-white/70 sm:mb-4 sm:w-20 md:mb-6 md:w-24">
                                            </div>

                                            <!-- Text with better spacing -->
                                            <h3
                                                class="mb-3 text-xl font-bold leading-tight text-white drop-shadow-2xl sm:text-2xl md:mb-4 md:text-4xl lg:text-5xl xl:text-6xl">
                                                {{ $item->deskripsi }}
                                            </h3>

                                            <!-- School Name Badge - FAVICON DINAMIS -->
                                            <div
                                                class="inline-flex items-center justify-center gap-2 rounded-full bg-white/10 px-4 py-2 text-white/90 backdrop-blur-sm sm:gap-3 sm:px-6 sm:py-3">
                                                @if ($globalKonfigurasi && $globalKonfigurasi->favicon)
                                                    <!-- Favicon dari database -->
                                                    <img src="{{ asset('storage/' . $globalKonfigurasi->favicon) }}"
                                                        alt="Icon"
                                                        class="h-4 w-4 rounded object-contain sm:h-5 sm:w-5 lg:h-6 lg:w-6">
                                                @elseif($globalKonfigurasi && $globalKonfigurasi->logo)
                                                    <!-- Fallback ke logo -->
                                                    <img src="{{ asset('storage/' . $globalKonfigurasi->logo) }}"
                                                        alt="Logo"
                                                        class="h-4 w-4 rounded object-contain sm:h-5 sm:w-5 lg:h-6 lg:w-6">
                                                @else
                                                    <!-- Fallback ke icon FontAwesome -->
                                                    <i class="fas fa-school text-sm sm:text-base lg:text-lg"></i>
                                                @endif
                                                <span class="text-xs font-medium sm:text-sm md:text-base">
                                                    {{ $globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    @else
        <!-- Empty State -->
        <div
            class="flex h-[400px] items-center justify-center bg-gradient-to-br from-blue-500 to-blue-700 sm:h-[500px] md:h-[600px]">
            <div class="px-4 text-center text-white">
                <i class="fas fa-image mb-4 text-5xl opacity-50 sm:mb-6 sm:text-6xl md:text-8xl"></i>
                <h3 class="mb-2 text-xl font-bold sm:text-2xl md:text-3xl">Carousel belum ada data</h3>
                <p class="text-sm opacity-90 sm:text-base md:text-xl">Silakan tambahkan gambar carousel melalui panel
                    admin</p>
            </div>
        </div>
    @endif
</section>

@push('styles')
    <style>
        /* Custom styling untuk navigation buttons - responsive */
        .swiper-button-next,
        .swiper-button-prev {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 18px;
            font-weight: bold;
        }

        /* Responsive: Adjust navigation on small screens */
        @media (max-width: 640px) {

            .swiper-button-next,
            .swiper-button-prev {
                width: 32px;
                height: 32px;
            }

            .swiper-button-next:after,
            .swiper-button-prev:after {
                font-size: 14px;
            }
        }

        /* Pagination styling */
        .swiper-pagination-bullet {
            background: white;
            opacity: 0.5;
            width: 10px;
            height: 10px;
        }

        .swiper-pagination-bullet-active {
            opacity: 1;
            background: white;
        }

        @media (max-width: 640px) {
            .swiper-pagination-bullet {
                width: 8px;
                height: 8px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Initialize Swiper
        const swiper = new Swiper('.carouselSwiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            speed: 1000,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        });
    </script>
@endpush
