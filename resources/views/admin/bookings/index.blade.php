<!-- Daerah Admin Kelolah booking setuju atau tidak -->

@extends('layouts.admin')

@section('title', 'Manajemen Booking')

@section('content')
<h1 class="text-2xl font-bold mb-6">Daftar Booking</h1>

<div class="overflow-x-auto bg-white shadow rounded p-4">
  <table class="min-w-full table-auto border border-gray-200 text-sm">
    <thead class="bg-gray-100 text-left text-gray-700 uppercase text-xs">
      <tr>
        <th class="px-4 py-2">ID</th>
        <th class="px-4 py-2">User</th>
        <th class="px-4 py-2">Lapangan</th>
        <th class="px-4 py-2">Jenis</th>
        <th class="px-4 py-2">Tanggal</th>
        <th class="px-4 py-2">Jam</th>
        <th class="px-4 py-2">Harga</th>
        <th class="px-4 py-2">Status</th>
        <th class="px-4 py-2">Bukti</th>
        <th class="px-4 py-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($bookings as $booking)
      <tr class="border-t hover:bg-gray-50">
        <td class="px-4 py-2">{{ $booking->id }}</td>
        <td class="px-4 py-2">{{ $booking->user->name }}</td>
        <td class="px-4 py-2">{{ $booking->jadwal->lapangan->name }}</td>
        <td class="px-4 py-2">{{ $booking->jadwal->lapangan->tipe_lapangan }}</td>
        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($booking->jadwal->tanggal)->format('d-m-Y') }}</td>
        <td class="px-4 py-2">{{ $booking->jadwal->jam_mulai }} - {{ $booking->jadwal->jam_selesai }}</td>
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
        <td class="px-4 py-2">
          @if($booking->bukti_pembayaran)
            <a href="{{ asset('storage/' . $booking->bukti_pembayaran) }}" target="_blank" class="text-blue-500 underline hover:text-blue-700">
              Lihat Bukti
            </a>
          @else
            <span class="text-gray-500 italic">Belum Upload</span>
          @endif
        </td>
        <td class="px-4 py-2">
          @if($booking->status == 'Pending')
          <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="inline-flex space-x-1">
            @csrf
            @method('PATCH')
            <button name="status" value="Disetujui" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
              Setujui
            </button>
            <button name="status" value="Ditolak" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
              Tolak
            </button>
          </form>
          @else
          <span class="font-semibold text-sm text-gray-600">{{ $booking->status }}</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="mt-4">
    {{ $bookings->links() }}
  </div>
</div>
@endsection
