<!-- Untuk Nambah Jadwal Lapangan -->

@extends('layouts.admin')

@section('page_title', 'Tambah Jadwal')

@section('content')
<h1 class="text-xl font-bold mb-4">Tambah Jadwal</h1>

<form action="{{ route('admin.jadwals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    {{-- Pilih atau Tambah Lapangan --}}
    <div>
        <label class="block font-semibold">Pilih Lapangan</label>
        <select name="lapangan_id" id="lapanganSelect" class="w-full border px-3 py-2 rounded" onchange="toggleCustomLapangan(this)">
            @foreach($lapangans as $lapangan)
                <option value="{{ $lapangan->id }}">{{ $lapangan->name }}</option>
            @endforeach
            <option value="custom">+ Tambah Lapangan Baru</option>
        </select>
    </div>

    {{-- FORM LAPANGAN BARU --}}
    <div id="customLapanganDiv" class="hidden space-y-2 border border-gray-300 p-4 rounded">
        <label class="block font-semibold">Nama Lapangan</label>
        <input type="text" name="custom_lapangan" class="w-full border px-3 py-2 rounded">

        <label class="block font-semibold">Harga</label>
        <input type="number" name="custom_harga" class="w-full border px-3 py-2 rounded">

        <label class="block font-semibold">Deskripsi</label>
        <textarea name="custom_deskripsi" class="w-full border px-3 py-2 rounded" rows="3"></textarea>

        <label class="block font-semibold">Kontak</label>
        <input type="text" name="custom_kontak" class="w-full border px-3 py-2 rounded">

        <label class="block font-semibold">Alamat</label>
        <textarea name="custom_alamat" class="w-full border px-3 py-2 rounded" rows="2"></textarea>

        <label class="block font-semibold">Gambar</label>
        <input type="file" name="custom_gambar" class="w-full border px-3 py-2 rounded">
    </div>

    {{-- TANGGAL (5 input berjajar seperti jam) --}}
    <div class="space-y-2">
        <label class="block font-semibold">Tanggal (5 Jadwal)</label>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            @for($i = 0; $i < 5; $i++)
                <input type="date" name="tanggal[]" class="w-full border px-3 py-2 rounded">
            @endfor
        </div>
    </div>

    {{-- JAM (5 set: mulai & selesai) --}}
    <div class="space-y-4">
        <label class="block font-semibold">Jam Mulai & Selesai</label>
        @for($i = 0; $i < 5; $i++)
            <div class="grid grid-cols-2 gap-4">
                <input type="time" name="jam_mulai[]" class="w-full border px-3 py-2 rounded" placeholder="Jam Mulai {{ $i+1 }}">
                <input type="time" name="jam_selesai[]" class="w-full border px-3 py-2 rounded" placeholder="Jam Selesai {{ $i+1 }}">
            </div>
        @endfor
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Semua Jadwal</button>
</form>

<script>
    function toggleCustomLapangan(select) {
        const div = document.getElementById('customLapanganDiv');
        div.classList.toggle('hidden', select.value !== 'custom');
    }
</script>
@endsection
