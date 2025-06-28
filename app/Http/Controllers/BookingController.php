<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('lapangan')->orderBy('tanggal')->get();
        return view('booking.index', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $buktiPath = $request->file('bukti_pembayaran')->store('bukti', 'public');

        Booking::create([
            'user_id' => Auth::id(),
            'jadwal_id' => $request->jadwal_id,
            'status' => 'Pending',
            'bukti_pembayaran' => $buktiPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking berhasil! Menunggu konfirmasi admin.');

    }
    public function create($jadwalId)
{
    $jadwal = \App\Models\Jadwal::with('lapangan')->findOrFail($jadwalId);

    return view('customer.booking.create', compact('jadwal'));
}

}
