<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BookingController extends Controller
{
    // Tampilkan semua booking (admin)
    public function index()
    {
        $bookings = Booking::with(['user', 'jadwal.lapangan'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    // Form create booking (admin biasanya tidak buat booking, tapi saya buatkan jika perlu)
    public function create()
    {
        $users = User::all();
        $jadwals = Jadwal::with('lapangan')->get();
        return view('admin.bookings.create', compact('users', 'jadwals'));
    }

    // Simpan booking baru (bisa dari admin atau user)
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'status' => 'required|in:Pending,Disetujui,Ditolak',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $booking = new Booking;
        $booking->user_id = $request->user_id;
        $booking->jadwal_id = $request->jadwal_id;
        $booking->status = $request->status;

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran')->store('bukti', 'public');
            $booking->bukti_pembayaran = $file;
        }

        $booking->save();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil disimpan.');
    }

    // Detail booking
    public function show($id)
    {
        $booking = Booking::with(['user', 'jadwal.lapangan'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    // Form edit booking (biasanya untuk update status)
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.bookings.edit', compact('booking'));
    }

    // Update booking
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Pending,Disetujui,Ditolak',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $booking->status = $request->status;

        if ($request->hasFile('bukti_pembayaran')) {
            // Hapus file lama jika ada
            if ($booking->bukti_pembayaran && Storage::disk('public')->exists($booking->bukti_pembayaran)) {
                Storage::disk('public')->delete($booking->bukti_pembayaran);
            }

            $file = $request->file('bukti_pembayaran')->store('bukti', 'public');
            $booking->bukti_pembayaran = $file;
        }

        $booking->save();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    // Hapus booking
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->bukti_pembayaran && Storage::disk('public')->exists($booking->bukti_pembayaran)) {
            Storage::disk('public')->delete($booking->bukti_pembayaran);
        }

        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dihapus.');
    }

    // Method baru untuk update status approve/tolak booking
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->route('admin.bookings.index')->with('success', 'Status booking berhasil diperbarui.');
    }
}
