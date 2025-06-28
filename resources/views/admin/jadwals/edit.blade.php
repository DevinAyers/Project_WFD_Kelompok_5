<!-- Bagian Edit Jadwal -->

@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-bold mb-4">Edit Jadwal</h1>

    <form action="{{ route('admin.jadwals.update', $jadwal->id) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')

        <!-- Lapangan -->
        <div>
            <label class="block font-semibold">Lapangan</label>
            <select name="lapangan_id" class="w-full border px-3 py-2 rounded">
                @foreach($lapangans as $lapangan)
                    <option value="{{ $lapangan->id }}" @selected($lapangan->id == $jadwal->lapangan_id)>
                        {{ $lapangan->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal -->
        <div>
            <label class="block font-semibold">Tanggal</label>
            <input type="date" name="tanggal" value="{{ $jadwal->tanggal }}" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Semua Jam untuk lapangan & tanggal yang sama -->
        <div>
            <label class="block font-semibold">Jadwal Jam (Bisa diubah semua)</label>
            @foreach ($semuaJadwal as $i => $item)
                <div class="flex gap-2 mb-2">
                    <input type="hidden" name="jadwals[{{ $i }}][id]" value="{{ $item->id }}">
                    <input type="time" name="jadwals[{{ $i }}][jam_mulai]" value="{{ $item->jam_mulai }}" class="border px-3 py-2 rounded w-1/2">
                    <input type="time" name="jadwals[{{ $i }}][jam_selesai]" value="{{ $item->jam_selesai }}" class="border px-3 py-2 rounded w-1/2">
                </div>
            @endforeach
        </div>

        <!-- Harga -->
        <div>
            <label class="block font-semibold">Harga</label>
            <input type="number" name="custom_harga" value="{{ old('custom_harga', $jadwal->lapangan->harga ?? '') }}" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="custom_deskripsi" rows="3" class="w-full border px-3 py-2 rounded">{{ old('custom_deskripsi', $jadwal->lapangan->deskripsi ?? '') }}</textarea>
        </div>

        <!-- Kontak -->
        <div>
            <label class="block font-semibold">Kontak</label>
            <input type="text" name="custom_kontak" value="{{ old('custom_kontak', $jadwal->lapangan->kontak ?? '') }}" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Alamat -->
        <div>
            <label class="block font-semibold">Alamat</label>
            <textarea name="custom_alamat" rows="2" class="w-full border px-3 py-2 rounded">{{ old('custom_alamat', $jadwal->lapangan->alamat ?? '') }}</textarea>
        </div>

        <!-- Submit -->
        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update Semua Jadwal</button>
        </div>
    </form>
@endsection
