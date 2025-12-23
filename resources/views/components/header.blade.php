<header class="sticky top-0 z-50 bg-gradient-to-r from-blue-800 to-blue-900 shadow-lg">
    <nav class="mx-auto max-w-7xl px-4 py-4">
        <!-- Flex container untuk header (logo + menu) -->
        <div class="flex items-center justify-between">

            <!-- LOGO / BRAND (Sebelah Kiri) - DINAMIS -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3 transition-transform hover:scale-105">
                    @if ($globalKonfigurasi && $globalKonfigurasi->logo)
                        <img src="{{ asset('storage/' . $globalKonfigurasi->logo) }}"
                            alt="{{ $globalKonfigurasi->nama_sekolah ?? 'Logo' }}"
                            class="h-10 w-10 rounded-lg bg-white object-contain p-1 shadow-md">
                    @else
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-white shadow-md">
                            <i class="fas fa-graduation-cap text-xl text-blue-800"></i>
                        </div>
                    @endif
                    <span class="text-xl font-bold text-white">
                        {{ $globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul' }}
                    </span>
                </a>
            </div>

            <!-- MOBILE MENU BUTTON (Hamburger) -->
            <button id="mobile-menu-btn" class="flex cursor-pointer flex-col gap-1.5 md:hidden">
                <span class="h-0.5 w-6 bg-white transition-all duration-300"></span>
                <span class="h-0.5 w-6 bg-white transition-all duration-300"></span>
                <span class="h-0.5 w-6 bg-white transition-all duration-300"></span>
            </button>

            <!-- NAVIGATION MENU (Sebelah Kanan) -->
            <ul id="nav-menu" class="hidden gap-6 text-white md:flex">
                <!-- Menu Beranda -->
                <li>
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'text-blue-200' : '' }} font-medium transition hover:text-blue-200">
                        <i class="fas fa-home mr-1"></i>
                        Beranda
                    </a>
                </li>

                <!-- Menu Profil (Dropdown) - FIX Z-INDEX -->
                <li class="group relative">
                    <button class="font-medium transition hover:text-blue-200">
                        <i class="fas fa-info-circle mr-1"></i>
                        Profil
                        <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                    </button>
                    <!-- Dropdown Menu - Z-INDEX TINGGI -->
                    <ul class="invisible absolute left-0 mt-2 w-56 rounded-lg border border-blue-700 bg-white opacity-0 shadow-xl transition-all duration-300 group-hover:visible group-hover:opacity-100"
                        style="z-index: 9999;">
                        <li>
                            <a href="{{ route('visi-misi') }}"
                                class="block border-b border-gray-100 px-4 py-3 text-gray-700 transition hover:bg-blue-50 hover:text-blue-800">
                                <i class="fas fa-bullseye mr-2 text-blue-600"></i>
                                Visi & Misi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sambutan') }}"
                                class="block border-b border-gray-100 px-4 py-3 text-gray-700 transition hover:bg-blue-50 hover:text-blue-800">
                                <i class="fas fa-user-tie mr-2 text-blue-600"></i>
                                Sambutan Kepala Sekolah
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-3 text-gray-700 transition hover:bg-blue-50 hover:text-blue-800">
                                <i class="fas fa-sitemap mr-2 text-blue-600"></i>
                                Struktur Organisasi
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Menu Jurusan -->
                <li>
                    <a href="{{ route('jurusan.index') }}"
                        class="{{ request()->routeIs('jurusan.*') ? 'text-blue-200' : '' }} font-medium transition hover:text-blue-200">
                        <i class="fas fa-book mr-1"></i>
                        Jurusan
                    </a>
                </li>

                <!-- Menu Guru -->
                <li>
                    <a href="{{ route('guru.index') }}"
                        class="{{ request()->routeIs('guru.*') ? 'text-blue-200' : '' }} font-medium transition hover:text-blue-200">
                        <i class="fas fa-chalkboard-teacher mr-1"></i>
                        Guru
                    </a>
                </li>

                <!-- Menu Artikel -->
                <li>
                    <a href="{{ route('artikel.index') }}"
                        class="{{ request()->routeIs('artikel.*') ? 'text-blue-200' : '' }} font-medium transition hover:text-blue-200">
                        <i class="fas fa-newspaper mr-1"></i>
                        Artikel
                    </a>
                </li>

                <!-- Menu Galeri -->
                <li>
                    <a href="{{ route('galeri.index') }}"
                        class="{{ request()->routeIs('galeri.*') ? 'text-blue-200' : '' }} font-medium transition hover:text-blue-200">
                        <i class="fas fa-images mr-1"></i>
                        Galeri
                    </a>
                </li>

                <!-- Menu Alumni -->
                <li>
                    <a href="{{ route('alumni.index') }}"
                        class="{{ request()->routeIs('alumni.*') ? 'text-blue-200' : '' }} font-medium transition hover:text-blue-200">
                        <i class="fas fa-user-graduate mr-1"></i>
                        Alumni
                    </a>
                </li>

                <!-- Menu Kontak -->
                <li>
                    <a href="{{ route('kontak.index') }}"
                        class="{{ request()->routeIs('kontak.*') ? 'text-blue-200' : '' }} font-medium transition hover:text-blue-200">
                        <i class="fas fa-envelope mr-1"></i>
                        Kontak
                    </a>
                </li>
            </ul>
        </div>

        <!-- MOBILE MENU (Muncul saat hamburger diklik) -->
        <ul id="mobile-nav" class="mt-4 hidden flex-col gap-2 rounded-lg bg-blue-800 p-4 md:hidden">
            <li>
                <a href="{{ route('home') }}"
                    class="block rounded px-3 py-2 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
            </li>

            <!-- Mobile Submenu Profil -->
            <li>
                <button id="mobile-profil-toggle"
                    class="flex w-full items-center justify-between rounded px-3 py-2 font-medium text-white transition hover:bg-blue-700">
                    <span><i class="fas fa-info-circle mr-2"></i>Profil</span>
                    <i class="fas fa-chevron-down text-xs transition-transform"></i>
                </button>
                <ul id="mobile-profil-submenu" class="ml-4 mt-2 hidden space-y-1">
                    <li>
                        <a href="{{ route('visi-misi') }}"
                            class="block rounded px-3 py-2 text-sm text-blue-100 transition hover:bg-blue-700 hover:text-white">
                            <i class="fas fa-bullseye mr-2"></i>Visi & Misi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sambutan') }}"
                            class="block rounded px-3 py-2 text-sm text-blue-100 transition hover:bg-blue-700 hover:text-white">
                            <i class="fas fa-user-tie mr-2"></i>Sambutan Kepala Sekolah
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="block rounded px-3 py-2 text-sm text-blue-100 transition hover:bg-blue-700 hover:text-white">
                            <i class="fas fa-sitemap mr-2"></i>Struktur Organisasi
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('jurusan.index') }}"
                    class="block rounded px-3 py-2 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-book mr-2"></i>Jurusan
                </a>
            </li>
            <li>
                <a href="{{ route('guru.index') }}"
                    class="block rounded px-3 py-2 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-chalkboard-teacher mr-2"></i>Guru
                </a>
            </li>
            <li>
                <a href="{{ route('artikel.index') }}"
                    class="block rounded px-3 py-2 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-newspaper mr-2"></i>Artikel
                </a>
            </li>
            <li>
                <a href="{{ route('galeri.index') }}"
                    class="block rounded px-3 py-2 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-images mr-2"></i>Galeri
                </a>
            </li>
            <li>
                <a href="{{ route('alumni.index') }}"
                    class="block rounded px-3 py-2 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-user-graduate mr-2"></i>Alumni
                </a>
            </li>
            <li>
                <a href="{{ route('kontak.index') }}"
                    class="block rounded px-3 py-2 font-medium text-white transition hover:bg-blue-700">
                    <i class="fas fa-envelope mr-2"></i>Kontak
                </a>
            </li>
        </ul>
    </nav>
</header>

<!-- JavaScript untuk Mobile Menu Toggle -->
<script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const mobileNav = document.getElementById('mobile-nav');
        const spans = this.querySelectorAll('span');

        mobileNav.classList.toggle('hidden');

        // Animate hamburger to X
        if (!mobileNav.classList.contains('hidden')) {
            spans[0].style.transform = 'rotate(45deg) translateY(8px)';
            spans[1].style.opacity = '0';
            spans[2].style.transform = 'rotate(-45deg) translateY(-8px)';
        } else {
            spans[0].style.transform = 'none';
            spans[1].style.opacity = '1';
            spans[2].style.transform = 'none';
        }
    });

    // Toggle mobile submenu
    const profilToggle = document.getElementById('mobile-profil-toggle');
    if (profilToggle) {
        profilToggle.addEventListener('click', function() {
            const submenu = document.getElementById('mobile-profil-submenu');
            const icon = this.querySelector('.fa-chevron-down');

            submenu.classList.toggle('hidden');
            icon.style.transform = submenu.classList.contains('hidden') ? 'none' : 'rotate(180deg)';
        });
    }
</script>
