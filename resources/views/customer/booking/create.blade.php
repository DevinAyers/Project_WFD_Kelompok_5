<!--Bagian Setelah anda milih Tipe Lapangan, tanggal dan waktu-->

@extends('layouts.app')

@section('content')
<div class="h-20"></div>
<div class="max-w-2xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-8 border border-gray-200">
    <h2 class="text-3xl font-bold text-slate-800 mb-6 border-l-4 border-blue-600 pl-4">
        Form Booking
    </h2>

    <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">

        <!--Nama Pemesan-->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Nama Pemesan</label>
            <div class="bg-gray-100 rounded-md px-4 py-2">{{ Auth::user()->name }}</div>
        </div>

        <!--Tempat-->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Tempat</label>
            <div class="bg-gray-100 rounded-md px-4 py-2">{{ $jadwal->lapangan->name }}</div>
        </div>

        <!--Jenis Lapangan-->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Jenis Lapangan</label>
            <div class="bg-gray-100 rounded-md px-4 py-2">{{ $jadwal->tipe_lapangans }}</div>
        </div>

        <!--Tanggal-->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Tanggal</label>
            <div class="bg-gray-100 rounded-md px-4 py-2">
                {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') }}
            </div>
        </div>

        <!--Jam-->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Jam</label>
            <div class="bg-gray-100 rounded-md px-4 py-2">
                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
            </div>
        </div>

        <!--Harga Sewa-->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Harga Sewa</label>
            <div class="text-green-600 font-bold text-xl bg-green-50 px-4 py-2 rounded-md">
                Rp{{ number_format($jadwal->lapangan->harga, 0, ',', '.') }}
            </div>
        </div>

        <!--QRIS Pembayaran-->
        <div>
            <label class="block text-gray-700 font-medium mb-2">QRIS Pembayaran</label>
            <img src="{{ asset('images/ContohQRIS.png') }}" alt="QRIS" class="w-48 rounded-md shadow-md border border-gray-300">
        </div>

        <!--No Rekening-->
        <div>
            <label class="block text-gray-700 font-medium mb-1">No Rekening Transfer</label>
            <div class="bg-gray-100 rounded-md px-4 py-2">
                61231342384 (Bank BCA a.n Athletix Booking)
            </div>
        </div>

        <!--Upload Bukti Pembayaran-->
        <div>
            <label for="bukti_pembayaran" class="block text-gray-700 font-medium mb-1">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran"
                   class="block w-full border border-gray-300 rounded-md px-3 py-2
                          file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0
                          file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700
                          hover:file:bg-blue-100"
                   required>
            @error('bukti_pembayaran')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!--Tombol Submit-->
        <div class="pt-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-200">
                Booking Sekarang
            </button>
        </div>
    </form>
</div>
@endsection
