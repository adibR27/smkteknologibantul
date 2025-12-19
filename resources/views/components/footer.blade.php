<footer class="bg-blue-900 text-white mt-12">
    <!-- FOOTER CONTENT -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <!-- KOLOM 1: About Sekolah -->
            <div>
                <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                    <i class="fas fa-graduation-cap"></i>
                    SMK Teknologi Bantul
                </h3>
                <p class="text-blue-100 text-sm leading-relaxed">
                    Sekolah Menengah Kejuruan yang berfokus pada teknologi dan inovasi untuk menghasilkan tenaga kerja profesional dan berdaya saing tinggi.
                </p>
            </div>

            <!-- KOLOM 2: Quick Links -->
            <div>
                <h4 class="text-lg font-bold mb-4">Menu Cepat</h4>
                <ul class="space-y-2 text-blue-100">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-white transition">
                            <i class="fas fa-chevron-right mr-2"></i>Beranda
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition">
                            <i class="fas fa-chevron-right mr-2"></i>Jurusan
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition">
                            <i class="fas fa-chevron-right mr-2"></i>Artikel
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition">
                            <i class="fas fa-chevron-right mr-2"></i>Galeri
                        </a>
                    </li>
                </ul>
            </div>

            <!-- KOLOM 3: Contact Info -->
            <div>
                <h4 class="text-lg font-bold mb-4">Hubungi Kami</h4>
                <ul class="space-y-3 text-blue-100 text-sm">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-phone mt-1 text-blue-300"></i>
                        <span>(0274) XXXX-XXXX</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-envelope mt-1 text-blue-300"></i>
                        <a href="mailto:info@smkteknologi.sch.id" class="hover:text-white transition">
                            info@smkteknologi.sch.id
                        </a>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-map-marker-alt mt-1 text-blue-300"></i>
                        <span>Jl. Raya Bantul, Yogyakarta 55713</span>
                    </li>
                </ul>
            </div>

            <!-- KOLOM 4: Social Media -->
            <div>
                <h4 class="text-lg font-bold mb-4">Ikuti Kami</h4>
                <p class="text-blue-100 text-sm mb-4">
                    Follow kami di media sosial untuk update terbaru
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center hover:bg-white hover:text-blue-900 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center hover:bg-white hover:text-blue-900 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center hover:bg-white hover:text-blue-900 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center hover:bg-white hover:text-blue-900 transition">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- DIVIDER -->
        <hr class="border-blue-700 my-8">

        <!-- BOTTOM: COPYRIGHT -->
        <div class="flex flex-col md:flex-row justify-between items-center text-blue-100 text-sm">
            <p>&copy; 2025 SMK Teknologi Bantul. All rights reserved.</p>
            <p>Designed with <i class="fas fa-heart text-red-500"></i> by Development Team</p>
        </div>
    </div>
</footer>