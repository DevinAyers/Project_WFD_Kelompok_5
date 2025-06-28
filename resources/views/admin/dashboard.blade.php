<!--Bagian Dashboard Admin-->

@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-4xl font-bold text-slate-800 mb-6 border-l-4 border-blue-600 pl-4">Dashboard Admin</h1>

    <!--Statistic Cards-->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-md p-6 border border-blue-100 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-blue-700">Total Pengguna</h2>
                    <p class="text-4xl font-bold mt-2 text-blue-900">{{ $totalUsers }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 border border-green-100 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-green-700">Total Booking</h2>
                    <p class="text-4xl font-bold mt-2 text-green-900">{{ $totalBookings }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2V9H3v8a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- <div class="bg-white rounded-2xl shadow-md p-6 border border-yellow-100 hover:shadow-xl transition mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-yellow-700">Total Pendapatan</h2>
                    <p class="text-3xl font-bold mt-2 text-yellow-900">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V4m0 16v-4m6-8a9 9 0 11-12 0" />
                    </svg>
                </div>
            </div>
        </div>
    </div> -->

    <!--Action Buttons-->
    <div class="flex flex-wrap gap-4 mt-8">
        <a href="{{ route('admin.jadwals.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
            📅 Kelola Jadwal
        </a>
        <!-- <a href="{{ route('admin.laporan.pemesanan') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg shadow hover:bg-green-700 transition">
            📊 Lihat Laporan
        </a> -->
        <a href="{{ route('admin.bookings.index') }}"
           class="bg-red-600 text-white px-6 py-3 rounded-lg shadow hover:bg-red-700 transition border border-red-700">
            📝 Kelola Booking
        </a>
        <a href="{{ route('admin.users.index') }}"
           class="bg-red-600 text-white px-6 py-3 rounded-lg shadow hover:bg-red-700 transition border border-red-700">
            🙍🏻‍♂️ Kelola User
        </a>
    </div>
</div>
@endsection
