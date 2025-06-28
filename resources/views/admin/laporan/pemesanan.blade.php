@extends('layouts.admin')

@section('content')
<div class="h-20"></div>
<h1 class="text-2xl font-bold mb-4">Laporan Pemesanan</h1>

<form action="{{ route('admin.laporan.pemesanan') }}" method="GET" class="mb-4 flex gap-4">
    <input type="date" name="tanggal" value="{{ $tanggal }}" class="border rounded p-2" />
    
    <select name="lapangan_id" class="border rounded p-2">
        <option value="">-- Semua Lapangan --</option>
        @foreach ($lapangans as $lapangan)
            <option value="{{ $lapangan->id }}" @selected($lapangan->id == $lapangan_id)>{{ $lapangan->name }}</option>
        @endforeach
    </select>
    
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
</form>

<table class="table-auto w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 p-2">No</th>
            <th class="border border-gray-300 p-2">User</th>
            <th class="border border-gray-300 p-2">Lapangan</th>
            <th class="border border-gray-300 p-2">Tanggal</th>
            <th class="border border-gray-300 p-2">Jam</th>
            <th class="border border-gray-300 p-2">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bookings as $index => $booking)
        <tr>
            <td class="border border-gray-300 p-2">{{ $bookings->firstItem() + $index }}</td>
            <td class="border border-gray-300 p-2">{{ $booking->user->name }}</td>
            <td class="border border-gray-300 p-2">{{ $booking->jadwal->lapangan->name }}</td>
            <td class="border border-gray-300 p-2">{{ $booking->jadwal->tanggal->format('d-m-Y') }}</td>
            <td class="border border-gray-300 p-2">{{ $booking->jadwal->jam_mulai }} - {{ $booking->jadwal->jam_selesai }}</td>
            <td class="border border-gray-300 p-2">{{ $booking->status }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center p-4">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $bookings->links() }}
</div>

@endsection
