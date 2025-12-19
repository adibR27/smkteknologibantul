<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin SMK Teknologi Bantul</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('styles')
</head>

<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-gradient-to-b from-blue-800 to-blue-900 text-white w-64 flex-shrink-0 transition-all duration-300 overflow-y-auto">
            <!-- Logo -->
            <div class="p-6 border-b border-blue-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-blue-800 text-xl"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-lg">SMK Teknologi</h1>
                        <p class="text-xs text-blue-200">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Content Management -->
                <div class="pt-4 pb-2 px-4">
                    <p class="text-xs text-blue-300 uppercase font-semibold">Konten</p>
                </div>

                <a href="{{ route('admin.carousel.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.carousel.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-images w-5"></i>
                    <span>Carousel</span>
                </a>

                <a href="{{ route('admin.artikel.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.artikel.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-newspaper w-5"></i>
                    <span>Artikel</span>
                </a>

                <a href="{{ route('admin.jurusan.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.jurusan.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-book w-5"></i>
                    <span>Jurusan</span>
                </a>

                <a href="{{ route('admin.prestasi.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.prestasi.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-trophy w-5"></i>
                    <span>Prestasi</span>
                </a>

                <!-- People -->
                <div class="pt-4 pb-2 px-4">
                    <p class="text-xs text-blue-300 uppercase font-semibold">Data</p>
                </div>

                <a href="{{ route('admin.guru.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.guru.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-chalkboard-teacher w-5"></i>
                    <span>Guru</span>
                </a>

                <a href="{{ route('admin.alumni.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.alumni.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-user-graduate w-5"></i>
                    <span>Alumni</span>
                </a>

                <!-- Media -->
                <div class="pt-4 pb-2 px-4">
                    <p class="text-xs text-blue-300 uppercase font-semibold">Media</p>
                </div>

                <a href="{{ route('admin.galeri.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.galeri.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-image w-5"></i>
                    <span>Galeri</span>
                </a>

                <a href="{{ route('admin.dokumen.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.dokumen.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-file-pdf w-5"></i>
                    <span>Dokumen</span>
                </a>

                <!-- Settings -->
                <div class="pt-4 pb-2 px-4">
                    <p class="text-xs text-blue-300 uppercase font-semibold">Pengaturan</p>
                </div>

                <a href="{{ route('admin.visi-misi.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.visi-misi.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-bullseye w-5"></i>
                    <span>Visi & Misi</span>
                </a>

                <a href="{{ route('admin.kepala-sekolah.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.kepala-sekolah.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-user-tie w-5"></i>
                    <span>Kepala Sekolah</span>
                </a>

                <a href="{{ route('admin.konfigurasi.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.konfigurasi.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-cog w-5"></i>
                    <span>Konfigurasi</span>
                </a>

                <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.pengaduan.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-envelope w-5"></i>
                    <span>Pengaduan</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navbar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <button id="sidebarToggle" class="text-gray-500 hover:text-gray-700 lg:hidden">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                            <p class="text-sm text-gray-500">@yield('page-subtitle', 'Kelola konten website')</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-700 relative">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                            </button>
                        </div>

                        <!-- User Menu -->
                        <div class="flex items-center space-x-3 border-l pl-4">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-800">{{ Auth::guard('admin')->user()->nama_lengkap }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                            <div class="relative">
                                <button id="userMenuButton" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-semibold hover:bg-blue-700 transition">
                                    {{ strtoupper(substr(Auth::guard('admin')->user()->nama_lengkap, 0, 1)) }}
                                </button>
                                <!-- Dropdown dengan z-index lebih tinggi -->
                                <div id="userMenuDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 py-2 hidden z-50">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                        <i class="fas fa-user mr-2"></i> Profile
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                        <i class="fas fa-cog mr-2"></i> Pengaturan
                                    </a>
                                    <hr class="my-2">
                                    <form action="{{ route('admin.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="p-6">
                    <!-- Alerts -->
                    @if(session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                            <p class="text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3 mt-1"></i>
                            <div>
                                <p class="text-red-700 font-semibold mb-2">Terdapat kesalahan:</p>
                                <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Page Content -->
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Sidebar Toggle for Mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Auto hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('[class*="bg-green-50"], [class*="bg-red-50"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
            <script>
            // User Menu Dropdown
            const userMenuButton = document.getElementById('userMenuButton');
            const userMenuDropdown = document.getElementById('userMenuDropdown');

            userMenuButton?.addEventListener('click', (e) => {
                e.stopPropagation();
                userMenuDropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!userMenuButton?.contains(e.target) && !userMenuDropdown?.contains(e.target)) {
                    userMenuDropdown?.classList.add('hidden');
                }
            });
        </script>
    @stack('scripts')
</body>

</html>
