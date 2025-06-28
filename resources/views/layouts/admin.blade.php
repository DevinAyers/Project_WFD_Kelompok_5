<!--Daerah Navbar Admin-->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin - Athletix')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow p-4 flex justify-between items-center">
        <div>
            <a href="{{ route('dashboard') }}" 
               class="text-3xl font-extrabold text-blue-700 tracking-wide hover:text-blue-800">
                Athletix
            </a>
        </div>
        <div class="space-x-4">
            <a href="{{ route('admin.jadwals.index') }}" class="text-blue-600 hover:underline">Jadwal</a>
            {{-- <a href="{{ route('admin.laporan.pemesanan') }}" class="text-blue-600 hover:underline">Laporan</a> --}}
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
            </form>
        </div>
    </nav>

    {{-- Content --}}
    <div class="pt-24 max-w-6xl mx-auto p-4 bg-white shadow rounded">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

</body>
</html>
