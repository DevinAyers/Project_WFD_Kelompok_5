<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Jadwal;
use App\Models\TipeLapangan;

class LapanganController extends Controller
{
    public function show($id, Request $request)
    {
        $lapangan = Lapangan::findOrFail($id);
        $lapangans = Lapangan::all();
        $tipeLapangans = TipeLapangan::all(); // untuk dropdown jenis lapangan

        $tanggalDipilih = $request->query('tanggal');
        $jadwalsQuery = Jadwal::where('lapangan_id', $lapangan->id);

        if ($tanggalDipilih) {
            $jadwalsQuery->where('tanggal', $tanggalDipilih);
        }

        $jadwals = $jadwalsQuery->get();
        $daftarTanggal = Jadwal::where('lapangan_id', $lapangan->id)
            ->orderBy('tanggal')
            ->distinct()
            ->pluck('tanggal');

        return view('customer.lapangan-detail', [
            'lapangan' => $lapangan,
            'lapangans' => $lapangans,
            'tipeLapangans' => $tipeLapangans,
            'jadwals' => $jadwals,
            'daftarTanggal' => $daftarTanggal,
            'tanggalDipilih' => $tanggalDipilih,
        ]);
    }

    public function showByTipe($id, Request $request)
    {
        // Ambil semua lapangan yang punya tipe ini
        $lapangan = Lapangan::where('tipe_id', $id)->firstOrFail();
        $lapangans = Lapangan::where('tipe_id', $id)->get();
        $tipeLapangans = TipeLapangan::all();

        $tanggalDipilih = $request->query('tanggal');
        $jadwalsQuery = Jadwal::where('lapangan_id', $lapangan->id);

        if ($tanggalDipilih) {
            $jadwalsQuery->where('tanggal', $tanggalDipilih);
        }

        $jadwals = $jadwalsQuery->get();
        $daftarTanggal = Jadwal::where('lapangan_id', $lapangan->id)
            ->orderBy('tanggal')
            ->distinct()
            ->pluck('tanggal');

        return view('customer.lapangan-detail', [
            'lapangan' => $lapangan,
            'lapangans' => $lapangans,
            'tipeLapangans' => $tipeLapangans,
            'jadwals' => $jadwals,
            'daftarTanggal' => $daftarTanggal,
            'tanggalDipilih' => $tanggalDipilih,
        ]);
        
    }
}
