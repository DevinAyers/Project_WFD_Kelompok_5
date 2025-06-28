<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use App\Models\TipeLapangan;



class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('lapangan')
                ->orderBy('tanggal')
                ->get();
                
        return view('admin.jadwals.index', compact('jadwals'));
    }

    public function create()
{
    $lapangans = \App\Models\Lapangan::all();
    $tipeLapangans = \App\Models\TipeLapangan::all();

    return view('admin.jadwals.create', compact('lapangans', 'tipeLapangans'));
}

public function store(Request $request)
{
    // 1. Validasi Input
    $request->validate([
        'lapangan_id' => 'required',
        'tanggal.*' => 'required|date',
        'jam_mulai.*' => 'required',
        'jam_selesai.*' => 'required',
    ]);

    // 2. Cek jika tambah lapangan baru
    if ($request->lapangan_id === 'custom') {
        $request->validate([
            'custom_lapangan' => 'required|string',
            'custom_harga' => 'required|numeric',
            'custom_deskripsi' => 'nullable|string',
            'custom_kontak' => 'nullable|string',
            'custom_alamat' => 'nullable|string',
            'custom_gambar' => 'nullable|image|max:2048',
        ]);

        // Simpan gambar kalau ada
        if ($request->hasFile('custom_gambar')) {
    $file = $request->file('custom_gambar');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('images'), $filename);
    $gambarPath = 'images/' . $filename;
}


        // Simpan lapangan baru
        $lapangan = Lapangan::create([
            'name' => $request->custom_lapangan,
            'harga' => $request->custom_harga,
            'deskripsi' => $request->custom_deskripsi,
            'kontak' => $request->custom_kontak,
            'alamat' => $request->custom_alamat,
            'gambar' => $gambarPath,
        ]);

        $lapanganId = $lapangan->id;
    } else {
        $lapanganId = $request->lapangan_id;
    }

    // 3. Simpan semua jadwal
    foreach ($request->tanggal as $tgl) {
    if (!$tgl) continue;

    foreach ($request->jam_mulai as $i => $jamMulai) {
        $jamSelesai = $request->jam_selesai[$i] ?? null;

        if (!$jamMulai || !$jamSelesai) continue;

        Jadwal::create([
            'lapangan_id' => $lapanganId,
            'tanggal' => $tgl,
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
        ]);
    }
}


    return redirect()->route('admin.jadwals.index')->with('success', 'Jadwal berhasil ditambahkan.');
}

    public function show($id)
    {
        $jadwal = Jadwal::with('lapangan')->findOrFail($id);
        return view('admin.jadwals.show', compact('jadwal'));
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
    $lapangans = Lapangan::all();

    $semuaJadwal = Jadwal::where('lapangan_id', $jadwal->lapangan_id)
        ->where('tanggal', $jadwal->tanggal)
        ->orderBy('jam_mulai')
        ->get();

    return view('admin.jadwals.edit', compact('jadwal', 'lapangans', 'semuaJadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'lapangan_id' => 'required|exists:lapangans,id',
        'tanggal' => 'required|date',
        'jadwals.*.id' => 'required|exists:jadwals,id',
        'jadwals.*.jam_mulai' => 'required',
        'jadwals.*.jam_selesai' => 'required',
        'custom_harga' => 'nullable|numeric',
        'custom_deskripsi' => 'nullable|string',
        'custom_kontak' => 'nullable|string',
        'custom_alamat' => 'nullable|string',
    ]);

    // Update semua jadwal berdasarkan input array
    foreach ($request->jadwals as $jadwalInput) {
        $jadwal = Jadwal::findOrFail($jadwalInput['id']);
        $jadwal->lapangan_id = $request->lapangan_id;
        $jadwal->tanggal = $request->tanggal;
        $jadwal->jam_mulai = $jadwalInput['jam_mulai'];
        $jadwal->jam_selesai = $jadwalInput['jam_selesai'];
        $jadwal->save();
    }

    // Update data lapangan
    $lapangan = Lapangan::find($request->lapangan_id);
    if ($lapangan) {
        $lapangan->harga = $request->custom_harga;
        $lapangan->deskripsi = $request->custom_deskripsi;
        $lapangan->kontak = $request->custom_kontak;
        $lapangan->alamat = $request->custom_alamat;
        $lapangan->save();
    }

    return redirect()->route('admin.jadwals.index')->with('success', 'Semua jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwals.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function destroyByLapangan($lapangan_id)
{
    // Hapus semua jadwal milik lapangan ini
    Jadwal::where('lapangan_id', $lapangan_id)->delete();

    // (Opsional) Hapus juga data lapangannya jika tidak dipakai lagi
    // Lapangan::where('id', $lapangan_id)->delete();

    return redirect()->route('admin.jadwals.index')->with('success', 'Semua jadwal dari lapangan ini berhasil dihapus.');
}

}
