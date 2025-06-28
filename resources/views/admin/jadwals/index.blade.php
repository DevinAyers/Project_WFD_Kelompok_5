<!-- Bagian dari Kelola Jadwal yg tambah edit hapus jadwal lapangan -->

@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-bold mb-4">Data Jadwal</h1>

    <a href="{{ route('admin.jadwals.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Jadwal</a>

    @php
        $grouped = $jadwals->groupBy('lapangan_id');
    @endphp

    @foreach ($grouped as $lapanganId => $jadwalGroup)
        @php
            $lapangan = $jadwalGroup->first()->lapangan;
            $jadwalsByTanggal = $jadwalGroup->groupBy('tanggal');
        @endphp

        <div class="mt-6 border p-4 rounded shadow bg-white">
            <!-- Info Lapangan -->
            <div class="flex gap-4 items-center mb-3">
                <img src="{{ asset($lapangan->gambar) }}" alt="Gambar" class="h-24 w-40 object-cover rounded">
                <div>
                    <h2 class="text-lg font-semibold">{{ $lapangan->name }}</h2>
                    <p class="text-sm">Harga: Rp{{ number_format($lapangan->harga, 0, ',', '.') }}</p>
                    <p class="text-sm">Kontak: {{ $lapangan->kontak }}</p>
                    <p class="text-sm">Alamat: {{ $lapangan->alamat }}</p>
                    <p class="text-sm">Deskripsi: {{ $lapangan->deskripsi }}</p>
                </div>
            </div>

            <!-- Tabel Jadwal per Tanggal -->
            @foreach ($jadwalsByTanggal as $tanggal => $jadwals)
                <h3 class="text-sm font-semibold mt-4 mb-1">Tanggal: {{ $tanggal }}</h3>
                <table class="w-full text-sm border mb-4">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-2 py-1">Jam Mulai</th>
                            <th class="px-2 py-1">Jam Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwals as $jadwal)
                            <tr>
                                <td class="border px-2 py-1">{{ $jadwal->jam_mulai }}</td>
                                <td class="border px-2 py-1">{{ $jadwal->jam_selesai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach

            <div class="mt-3">
                <a href="{{ route('admin.jadwals.edit', $jadwalGroup->first()->id) }}" class="text-blue-600 text-sm">Edit Jadwal Lapangan Ini</a>
                
                <form action="{{ route('admin.jadwals.destroyByLapangan', $jadwalGroup->first()->lapangan_id) }}"method="POST" class="inline ml-4" onsubmit="return confirm('Yakin hapus semua jadwal untuk lapangan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 text-sm">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection
