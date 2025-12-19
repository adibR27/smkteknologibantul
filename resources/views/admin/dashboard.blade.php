@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data dan statistik website')

@section('content')
<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-lg p-8 mb-6 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::guard('admin')->user()->nama_lengkap }}! 👋</h1>
            <p class="text-blue-100">Kelola konten website SMK Teknologi Bantul dengan mudah dan cepat.</p>
        </div>
        <div class="hidden lg:block">
            <i class="fas fa-chart-line text-6xl text-blue-300 opacity-50"></i>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Artikel Card -->
    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Total Artikel</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['artikel'] }}</p>
                <p class="text-xs text-green-600 mt-2">
                    <i class="fas fa-arrow-up"></i> Artikel terpublikasi
                </p>
            </div>
            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-newspaper text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Guru Card -->
    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Total Guru</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['guru'] }}</p>
                <p class="text-xs text-green-600 mt-2">
                    <i class="fas fa-check"></i> Tenaga pengajar
                </p>
            </div>
            <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-chalkboard-teacher text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Alumni Card -->
    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Total Alumni</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['alumni'] }}</p>
                <p class="text-xs text-blue-600 mt-2">
                    <i class="fas fa-graduation-cap"></i> Lulusan terdaftar
                </p>
            </div>
            <div class="w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-user-graduate text-yellow-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Prestasi Card -->
    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Total Prestasi</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['prestasi'] }}</p>
                <p class="text-xs text-purple-600 mt-2">
                    <i class="fas fa-trophy"></i> Pencapaian sekolah
                </p>
            </div>
            <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center">
                <i class="fas fa-award text-purple-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Stats -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow-sm p-4 text-center">
        <i class="fas fa-book text-indigo-600 text-2xl mb-2"></i>
        <p class="text-2xl font-bold text-gray-800">{{ $stats['jurusan'] }}</p>
        <p class="text-xs text-gray-500">Jurusan</p>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-4 text-center">
        <i class="fas fa-images text-pink-600 text-2xl mb-2"></i>
        <p class="text-2xl font-bold text-gray-800">{{ $stats['carousel'] }}</p>
        <p class="text-xs text-gray-500">Carousel</p>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-4 text-center">
        <i class="fas fa-image text-teal-600 text-2xl mb-2"></i>
        <p class="text-2xl font-bold text-gray-800">{{ $stats['galeri'] }}</p>
        <p class="text-xs text-gray-500">Galeri</p>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-4 text-center">
        <i class="fas fa-file-pdf text-red-600 text-2xl mb-2"></i>
        <p class="text-2xl font-bold text-gray-800">{{ $stats['dokumen'] }}</p>
        <p class="text-xs text-gray-500">Dokumen</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Chart Section -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-chart-line text-blue-600 mr-2"></i>
                    Artikel per Bulan
                </h3>
                <span class="text-sm text-gray-500">6 Bulan Terakhir</span>
            </div>
            <canvas id="artikelChart" class="w-full" height="80"></canvas>
        </div>

        <!-- Recent Articles -->
        <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-newspaper text-blue-600 mr-2"></i>
                Artikel Terbaru
            </h3>
            @if($recentArticles->count() > 0)
            <div class="space-y-3">
                @foreach($recentArticles as $artikel)
                <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg transition">
                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex-shrink-0">
                        @if($artikel->gambar)
                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover rounded-lg">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-semibold text-gray-800 truncate">{{ $artikel->judul }}</h4>
                        <p class="text-xs text-gray-500 mt-1">{{ $artikel->created_at->format('d M Y') }}</p>
                    </div>
                    <a href="#" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8 text-gray-400">
                <i class="fas fa-inbox text-4xl mb-3"></i>
                <p>Belum ada artikel</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-bolt text-yellow-600 mr-2"></i>
                Quick Actions
            </h3>
            <div class="space-y-2">
                <a href="{{ route('admin.artikel.create') }}" class="flex items-center space-x-3 p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                    <i class="fas fa-plus-circle text-blue-600"></i>
                    <span class="text-sm font-medium text-blue-800">Buat Artikel Baru</span>
                </a>
                <a href="{{ route('admin.carousel.create') }}" class="flex items-center space-x-3 p-3 bg-green-50 hover:bg-green-100 rounded-lg transition">
                    <i class="fas fa-images text-green-600"></i>
                    <span class="text-sm font-medium text-green-800">Tambah Carousel</span>
                </a>
                <a href="{{ route('admin.jurusan.create') }}" class="flex items-center space-x-3 p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition">
                    <i class="fas fa-book text-purple-600"></i>
                    <span class="text-sm font-medium text-purple-800">Tambah Jurusan</span>
                </a>
                <a href="{{ route('admin.guru.create') }}" class="flex items-center space-x-3 p-3 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition">
                    <i class="fas fa-user-plus text-yellow-600"></i>
                    <span class="text-sm font-medium text-yellow-800">Tambah Guru</span>
                </a>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-history text-gray-600 mr-2"></i>
                Aktivitas Terbaru
            </h3>
            @if($recentActivities->count() > 0)
            <div class="space-y-4">
                @foreach($recentActivities as $activity)
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-edit text-blue-600 text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-gray-800">{{ $activity['action'] }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $activity['description'] }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $activity['time'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8 text-gray-400">
                <i class="fas fa-clock text-3xl mb-2"></i>
                <p class="text-sm">Belum ada aktivitas</p>
            </div>
            @endif
        </div>

        <!-- Tips Card -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-sm p-6 text-white">
            <div class="flex items-start space-x-3 mb-3">
                <i class="fas fa-lightbulb text-2xl text-yellow-300"></i>
                <div>
                    <h4 class="font-semibold mb-1">Tips!</h4>
                    <p class="text-sm text-blue-100">Update artikel secara rutin untuk meningkatkan engagement website.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
{{-- Step 1: Kirim data dari Laravel ke JavaScript --}}
<script>
    window.artikelData = {!! json_encode($artikelPerBulan) !!};
</script>

{{-- Step 2: Script Chart.js --}}
<script>
    // Chart Configuration
    const ctx = document.getElementById('artikelChart').getContext('2d');
    
    // Ambil data dari window object
    const chartData = window.artikelData;
    
    // Proses data untuk chart
    const labels = chartData.map(item => {
        const [year, month] = item.bulan.split('-');
        const date = new Date(year, month - 1);
        return date.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
    });
    const data = chartData.map(item => item.jumlah);

    // Buat Chart
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels.length > 0 ? labels : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Jumlah Artikel',
                data: data.length > 0 ? data : [0, 0, 0, 0, 0, 0],
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: 'rgb(59, 130, 246)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush