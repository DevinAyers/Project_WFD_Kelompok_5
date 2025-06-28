@extends('layouts.admin')

@section('content')
<div class="h-20"></div>
<h1 class="text-2xl font-bold mb-4">Laporan Total Pendapatan</h1>

<form action="{{ route('admin.laporan.pendapatan') }}" method="GET" class="mb-4">
    <input type="date" name="tanggal" value="{{ $tanggal }}" class="border rounded p-2" />
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
</form>

<p class="mb-4 font-semibold">Total Pendapatan: Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>

<table class="table-auto w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 p-2">No</th>
            <th class="border border-gray-300 p-2">Lapangan</th>
            <th class="border border-gray-300 p-2">Tanggal</th>
            <th class="border border-gray-300 p-2">User</th>
            <th class="border border-gray-300 p-2">Harga</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bookings as $index => $booking)
        <tr>
            <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
            <td class="border border-gray-300 p-2">{{ $booking->jadwal->lapangan->name }}</td>
            <td class="border border-gray-300 p-2">{{ $booking->jadwal->tanggal->format('d-m-Y') }}</td>
            <td class="border border-gray-300 p-2">{{ $booking->user->name }}</td>
            <td class="border border-gray-300 p-2">Rp {{ number_format($booking->jadwal->lapangan->price, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center p-4">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
