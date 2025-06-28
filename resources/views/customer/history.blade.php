<!--Bagian History (isi setuju/tidak penerimaan Booking Dari Admin)-->

@extends('layouts.app')

@section('title', 'Riwayat Booking')

@section('content')
<div class="h-20"></div>
<div class="max-w-6xl mx-auto mt-10 px-4">
    <h1 class="text-2xl font-bold mb-6">Riwayat Booking Anda</h1>

    @if ($bookings->count() > 0)
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full table-auto text-sm border border-gray-200">
            <thead class="bg-gray-100 text-left text-xs uppercase text-gray-600">
                <tr>
                    <th class="px-4 py-2">Lapangan</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Jam</th>
                    <th class="px-4 py-2">Harga</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $booking->jadwal->lapangan->name }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($booking->jadwal->tanggal)->format('d-m-Y') }}</td>
                    <td class="px-4 py-2">
                        {{ \Carbon\Carbon::parse($booking->jadwal->jam_mulai)->format('H:i') }} -
                        {{ \Carbon\Carbon::parse($booking->jadwal->jam_selesai)->format('H:i') }}
                    </td>
                    <td class="px-4 py-2 text-green-600 font-semibold">
                        Rp{{ number_format($booking->jadwal->lapangan->harga, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-2">
                        <span class="inline-block px-2 py-1 rounded text-xs font-semibold
                            {{ $booking->status == 'Disetujui' ? 'bg-green-100 text-green-700' :
                               ($booking->status == 'Ditolak' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ $booking->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="text-gray-500 italic">Belum ada riwayat booking.</p>
    @endif
</div>
@endsection
