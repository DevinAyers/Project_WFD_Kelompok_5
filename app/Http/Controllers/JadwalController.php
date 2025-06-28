<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Lapangan; // <--- Tambahkan ini jika belum ada

class JadwalController extends Controller
{
    public function show($id)
{
    $lapangan = Lapangan::findOrFail($id);
    $jadwals = Jadwal::where('lapangan_id', $lapangan->id)
                     ->whereDate('tanggal', '>=', now())
                     ->orderBy('tanggal')
                     ->get();

    return view('customer.lapangan-detail', compact('lapangan', 'jadwals'));
}

}
