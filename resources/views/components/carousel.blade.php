<section class="carousel-section relative">
    @if ($carousel->count() > 0)
        <!-- Swiper -->
        <div class="swiper carouselSwiper">
            <div class="swiper-wrapper">
                @foreach ($carousel as $index => $item)
                    <div class="swiper-slide">
                        <div class="relative h-[600px] md:h-[700px]">
                            <!-- Image -->
                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                alt="{{ $item->deskripsi ?? 'Carousel ' . ($index + 1) }}"
                                class="h-full w-full object-cover" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">

                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/40 to-black/70"></div>

                            <!-- Content -->
                            @if ($item->deskripsi)
                                @if ($loop->first)
                                    {{-- Slide Pertama: Full Content di Tengah --}}
                                    <div class="absolute inset-0 z-10 flex items-center justify-center">
                                        <div class="mx-auto max-w-5xl px-4 text-center">
                                            <h2
                                                class="animate__animated animate__fadeInUp mb-6 text-4xl font-bold text-white drop-shadow-2xl md:text-6xl lg:text-7xl">
                                                {{ $item->deskripsi }}
                                            </h2>
                                            <p
                                                class="animate__animated animate__fadeInUp animate__delay-1s mb-10 text-xl text-white/95 drop-shadow-lg md:text-2xl lg:text-3xl">
                                                SMK Teknologi Bantul - Mencetak Generasi Unggul
                                            </p>
                                            <div
                                                class="animate__animated animate__fadeInUp animate__delay-2s flex flex-col justify-center gap-4 sm:flex-row">
                                                <a href="{{ route('jurusan.index') }}"
                                                    class="bg-primary hover:bg-secondary group inline-flex transform items-center justify-center rounded-full px-8 py-4 font-semibold text-white transition-all duration-300 hover:scale-110 hover:shadow-2xl">
                                                    <i
                                                        class="fas fa-graduation-cap mr-2 group-hover:animate-bounce"></i>
                                                    Lihat Jurusan
                                                </a>
                                                <a href="{{ route('kontak.index') }}"
                                                    class="group inline-flex transform items-center justify-center rounded-full border-2 border-white bg-white/20 px-8 py-4 font-semibold text-white backdrop-blur-sm transition-all duration-300 hover:scale-110 hover:bg-white/30 hover:shadow-2xl">
                                                    <i class="fas fa-envelope mr-2 group-hover:animate-pulse"></i>
                                                    Hubungi Kami
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="absolute inset-x-0 bottom-0 z-10 pb-16 md:pb-20">
                                        <div class="mx-auto max-w-4xl px-4 text-center">
                                            <!-- Simple Line Decoration with Animation -->
                                            <div
                                                class="animate__animated animate__fadeIn mx-auto mb-6 h-1 w-24 rounded-full bg-white/70">
                                            </div>

                                            <!-- Text with better spacing -->
                                            <h3
                                                class="mb-4 text-3xl font-bold leading-tight text-white drop-shadow-2xl md:text-5xl lg:text-6xl">
                                                {{ $item->deskripsi }}
                                            </h3>

                                            <!-- School Name Badge -->
                                            <div
                                                class="inline-flex items-center justify-center gap-3 rounded-full bg-white/10 px-6 py-3 text-white/90 backdrop-blur-sm">
                                                <i class="fas fa-school text-lg"></i>
                                                <span class="text-sm font-medium md:text-base">SMK Teknologi
                                                    Bantul</span>
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
        <div class="flex h-[600px] items-center justify-center bg-gradient-to-br from-purple-500 to-pink-500">
            <div class="px-4 text-center text-white">
                <i class="fas fa-image mb-6 text-8xl opacity-50"></i>
                <h3 class="mb-2 text-3xl font-bold">Carousel belum ada data</h3>
                <p class="text-xl opacity-90">Silakan tambahkan gambar carousel melalui panel admin</p>
            </div>
        </div>
    @endif
</section>

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
            },
        });
    </script>
@endpush
