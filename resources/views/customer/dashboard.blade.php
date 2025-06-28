<!--Bagian Dari Dashboard Customer -->

@extends('layouts.app')

@section('content')
<!-- Hero Section -->
 <div class="h-20"></div>
<section class="relative w-full h-[500px] flex items-center justify-center text-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/lapanganAwal.jpg') }}" alt="Background" class="w-full h-full object-cover filter blur-sm scale-110">
        <div class="absolute inset-0 bg-black opacity-30"></div>
    </div>
    <div class="relative z-10 text-white px-4">
        @auth
        <div class="flex items-center justify-center gap-4 mb-6">
            <h3 class="text-4xl md:text-6xl lg:text-7xl font-bold drop-shadow">Selamat Datang, {{ Auth::user()->name }} 👋</h3>
        </div>
        @endauth
    </div>
</section>

<!-- List Lapangan -->
<div class="max-w-6xl mx-auto mt-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Pilih Jadwal Lapangan</h1>

    @if (session('success'))
        <div class="p-4 bg-green-100 text-green-700 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($lapangans as $lapangan)
            <div class="border rounded-lg shadow p-4 bg-white hover:shadow-lg transition duration-200 flex flex-col justify-between">
                <a href="{{ route('lapangan.show', $lapangan->id) }}" class="block text-black hover:no-underline">
                    <img src="{{ asset($lapangan->gambar) }}" alt="Lapangan" class="h-40 w-full object-cover rounded mb-4">
                    <h2 class="text-xl font-semibold mb-1">{{ $lapangan->name }}</h2>
                </a>
                <div class="mt-4 text-right">
                    <a href="{{ route('lapangan.show', $lapangan->id) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-150">
                        Book Sekarang
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Footer -->
<footer class="mt-16 py-6 text-white text-center" style="background-color: #1e3a8a;">
    <div class="mb-2">
        <a href="https://wa.me/628123456789" target="_blank" class="text-green-600 hover:underline mx-2">WhatsApp</a>
        <a href="https://instagram.com/athletix.id" target="_blank" class="text-pink-600 hover:underline mx-2">Instagram</a>
        <a href="https://facebook.com/athletix" target="_blank" class="text-blue-600 hover:underline mx-2">Facebook</a>
    </div>
    <div class="mb-2 text-sm text-gray-200">
        <span>Hubungi kami: </span><a href="tel:+628123456789" class="hover:underline text-white">+62 812-3456-789</a>
    </div>
    <p class="text-sm text-gray-300">&copy; 2025 Athletix. All rights reserved.</p>
</footer>

@endsection
