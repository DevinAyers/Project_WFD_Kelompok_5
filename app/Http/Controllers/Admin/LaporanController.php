<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function pemesanan(Request $request)
    {
        // Ambil filter tanggal & lapangan dari query string
        $tanggal = $request->input('tanggal');
        $lapangan_id = $request->input('lapangan_id');

        $lapangans = Lapangan::all();

        $query = Booking::query()->with('jadwal.lapangan')->where('status', 'Disetujui');

        if ($tanggal) {
            $query->whereHas('jadwal', function ($q) use ($tanggal) {
                $q->where('tanggal', $tanggal);
            });
        }

        if ($lapangan_id) {
            $query->whereHas('jadwal', function ($q) use ($lapangan_id) {
                $q->where('lapangan_id', $lapangan_id);
            });
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.laporan.pemesanan', compact('bookings', 'lapangans', 'tanggal', 'lapangan_id'));
    }

    public function pendapatan(Request $request)
{
    $tanggal = $request->input('tanggal');

    $query = Booking::query()->with('jadwal.lapangan')->where('status', 'Disetujui');

    if ($tanggal) {
        $query->whereHas('jadwal', function ($q) use ($tanggal) {
            $q->where('tanggal', $tanggal);
        });
    }

    $bookings = $query->get();

    // Hitung total pendapatan dari harga lapangan berdasarkan booking yang disetujui
    $totalPendapatan = $bookings->sum(function ($booking) {
        return $booking->jadwal->lapangan->price;
    });

    return view('admin.laporan.pendapatan', compact('bookings', 'totalPendapatan', 'tanggal'));
}

}
