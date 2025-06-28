<!--Bagian Halaman Lapangan detail jika pencet bagian tempat lapangan tersebut-->

@extends('layouts.app')

@section('content')
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init({ once: true, duration: 700 });</script>

<div class="h-20"></div>
<div class="max-w-6xl mx-auto py-10 px-4">

    <!-- Gambar Header -->
    <div class="relative mb-6 rounded-3xl overflow-hidden shadow-xl h-80">
        <img src="{{ asset($lapangan->gambar) }}" alt="Gambar Lapangan" class="w-full h-full object-cover">
    </div>


    <div class="mb-10 text-center" data-aos="fade-up">
        <h1 class="text-4xl font-extrabold text-gray-900 bg-white px-6 py-4 rounded-2xl shadow-md inline-block">
            {{ $lapangan->name }}
        </h1>
    </div>


    <a href="{{ url()->previous() }}" class="inline-block mb-6 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
        ← Kembali
    </a>

    <!-- Deskripsi -->
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-10" data-aos="fade-up">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Informasi Lapangan</h2>
        <p class="text-gray-700 mb-4 leading-relaxed">{{ $lapangan->deskripsi }}</p>
        <div class="space-y-2 text-gray-800">
            <p><strong>📍 Alamat:</strong> {{ $lapangan->alamat }}</p>
            <p><strong>📞 Kontak:</strong> {{ $lapangan->kontak }}</p>
            <p><strong>💰 Harga Sewa:</strong> 
                <span class="text-green-600 font-bold">Rp{{ number_format($lapangan->harga, 0, ',', '.') }}</span>
            </p>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="bg-gray-50 rounded-2xl shadow-lg p-6 mb-10" data-aos="fade-up">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Pilih Tipe & Jadwal</h2>

        <!-- Jenis Lapangan -->
        <form method="GET" action="{{ route('lapangan.show', $lapangan->id) }}" class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Jenis Lapangan</label>
            <select name="tipe_id" onchange="this.form.submit()" class="w-full border-gray-300 rounded-lg px-4 py-2 shadow focus:ring-2 focus:ring-blue-400 transition">
                <option value="">-- Semua Tipe --</option>
                @foreach($tipeLapangans as $tipe)
                    <option value="{{ $tipe->id }}" {{ request('tipe_id') == $tipe->id ? 'selected' : '' }}>
                        {{ $tipe->name }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- Tanggal -->
        <form method="GET" action="{{ route('lapangan.show', $lapangan->id) }}">
            <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">
            <input type="hidden" name="tipe_id" value="{{ request('tipe_id') }}">

            <label class="block font-semibold text-gray-700 mb-2">Pilih Tanggal</label>
            <select name="tanggal" onchange="this.form.submit()" class="w-full border-gray-300 rounded-lg px-4 py-2 shadow focus:ring-2 focus:ring-blue-400 transition">
                <option value="">-- Semua Tanggal --</option>
                @foreach($daftarTanggal as $tanggal)
                    <option value="{{ $tanggal }}" {{ $tanggalDipilih == $tanggal ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Jadwal -->
    @if($tanggalDipilih && $jadwals->count() > 0)
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-10" data-aos="fade-up">
        <form method="GET" id="formBooking">
            <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">
            <input type="hidden" name="tanggal" value="{{ $tanggalDipilih }}">

            <label class="block font-semibold text-gray-700 mb-2">Pilih Jam</label>
            <select name="jadwal_id" onchange="redirectToBooking(this)" class="w-full border-gray-300 rounded-lg px-4 py-2 shadow focus:ring-2 focus:ring-blue-400 transition">
                <option value="">-- Pilih Jam --</option>
                @foreach($jadwals as $jadwal)
                    <option value="{{ $jadwal->id }}">
                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                    </option>
                @endforeach
            </select>
        </form>

        <div class="mt-6 border-t pt-4">
            <p class="text-lg font-semibold text-gray-800">Harga Sewa:</p>
            <p class="text-2xl text-green-600 font-bold">
                Rp{{ number_format($lapangan->harga, 0, ',', '.') }}
            </p>
        </div>
    </div>
    @endif

    <!-- Tidak Ada Jadwal -->
    @if($tanggalDipilih && $jadwals->count() == 0)
        <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 rounded-xl p-4 text-center shadow-md" data-aos="fade-up">
            <p class="font-medium">Tidak ada jadwal tersedia untuk tanggal ini.</p>
        </div>
    @endif
</div>

<script>
    function redirectToBooking(select) {
        const jadwalId = select.value;
        if (jadwalId) {
            window.location.href = '/booking/create/' + jadwalId;
        }
    }
</script>
@endsection
