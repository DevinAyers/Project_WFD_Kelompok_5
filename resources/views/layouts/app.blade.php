<!--Daerah Navbar Customer-->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Athletix - Sistem Booking Lapangan')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 opacity-0 transition-opacity duration-500" onload="document.body.classList.add('opacity-100')">

<nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow p-4 flex justify-between items-center">
    <div class="ml-11">
        <a href="{{ auth()->check() ? route('dashboard') : url('/') }}" 
           class="text-3xl font-extrabold text-blue-700 tracking-wide hover:text-blue-800 transition cursor-pointer select-none">
            Athletix
        </a>
    </div>

    <div class="space-x-4">
        @auth
            <div class="flex items-center space-x-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2">
                    <img
                        src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('default-user.png') }}"
                        alt="Foto Profil"
                        style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc;" />
                    <span class="text-gray-700 hover:underline">
                        {{ Auth::user()->name }}
                    </span>
                </a>

                <a href="{{ route('customer.history') }}" class="text-blue-600 hover:underline">History</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline ml-4">Register</a>
        @endauth
    </div>
</nav>

<div class="pt-24">
    @yield('content')
</div>

</body>
</html>
