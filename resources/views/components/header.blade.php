<header class="bg-white shadow-md">
    <nav class="max-w-7xl mx-auto px-4 py-4">
        <!-- Flex container untuk header (logo + menu) -->
        <div class="flex justify-between items-center">

            <!-- LOGO / BRAND (Sebelah Kiri) -->
            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold text-blue-600">
                    <i class="fas fa-graduation-cap text-2xl"></i>
                    <span>SMK Teknologi Bantul</span>
                </a>
            </div>

            <!-- MOBILE MENU BUTTON (Hamburger) -->
            <button id="mobile-menu-btn" class="md:hidden flex flex-col gap-1 cursor-pointer">
                <span class="w-6 h-0.5 bg-blue-600"></span>
                <span class="w-6 h-0.5 bg-blue-600"></span>
                <span class="w-6 h-0.5 bg-blue-600"></span>
            </button>

            <!-- NAVIGATION MENU (Sebelah Kanan) -->
            <ul id="nav-menu" class="hidden md:flex gap-6 text-gray-700">
                <!-- Menu Beranda -->
                <li>
                    <a href="{{ route('home') }}" class="hover:text-blue-600 transition font-medium">
                        Beranda
                    </a>
                </li>

                <!-- Menu Profil (Dropdown) -->
                <li class="relative group">
                    <button class="hover:text-blue-600 transition font-medium">
                        Profil <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </button>
                    <!-- Dropdown Menu -->
                    <ul class="absolute left-0 mt-0 w-48 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 group-hover:opacity-100 transition invisible group-hover:visible">
                        <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 text-gray-700">Visi Misi</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 text-gray-700">Sambutan Kepala Sekolah</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 text-gray-700">Struktur Organisasi</a></li>
                    </ul>
                </li>

                <!-- Menu Jurusan -->
                <li>
                    <a href="#" class="hover:text-blue-600 transition font-medium">
                        Jurusan
                    </a>
                </li>

                <!-- Menu Guru -->
                <li>
                    <a href="#" class="hover:text-blue-600 transition font-medium">
                        Guru
                    </a>
                </li>

                <!-- Menu Artikel -->
                <li>
                    <a href="#" class="hover:text-blue-600 transition font-medium">
                        Artikel
                    </a>
                </li>

                <!-- Menu Galeri -->
                <li>
                    <a href="#" class="hover:text-blue-600 transition font-medium">
                        Galeri
                    </a>
                </li>

                <!-- Menu Alumni -->
                <li>
                    <a href="#" class="hover:text-blue-600 transition font-medium">
                        Alumni
                    </a>
                </li>

                <!-- Menu Kontak -->
                <li>
                    <a href="#" class="hover:text-blue-600 transition font-medium">
                        Kontak
                    </a>
                </li>
            </ul>
        </div>

        <!-- MOBILE MENU (Muncul saat hamburger diklik) -->
        <ul id="mobile-nav" class="hidden flex-col gap-2 mt-4 md:hidden bg-blue-50 p-4 rounded-md">
            <li><a href="{{ route('home') }}" class="block text-gray-700 hover:text-blue-600 font-medium">Beranda</a></li>
            <li><a href="#" class="block text-gray-700 hover:text-blue-600 font-medium">Profil</a></li>
            <li><a href="#" class="block text-gray-700 hover:text-blue-600 font-medium">Jurusan</a></li>
            <li><a href="#" class="block text-gray-700 hover:text-blue-600 font-medium">Guru</a></li>
            <li><a href="#" class="block text-gray-700 hover:text-blue-600 font-medium">Artikel</a></li>
            <li><a href="#" class="block text-gray-700 hover:text-blue-600 font-medium">Galeri</a></li>
            <li><a href="#" class="block text-gray-700 hover:text-blue-600 font-medium">Alumni</a></li>
            <li><a href="#" class="block text-gray-700 hover:text-blue-600 font-medium">Kontak</a></li>
        </ul>
    </nav>
</header>

<!-- JavaScript untuk Mobile Menu Toggle -->
<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const mobileNav = document.getElementById('mobile-nav');
        mobileNav.classList.toggle('hidden');
    });
</script>