<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMK Teknologi Bantul')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Style -->
    <style>
        :root {
            --primary-color: #0066cc;
            --secondary-color: #004499;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- Header akan di-include di sini -->
    @include('components.header')

    <!-- Main Content - tempat untuk konten halaman -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer akan di-include di sini -->
    @include('components.footer')

    <!-- Script -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>