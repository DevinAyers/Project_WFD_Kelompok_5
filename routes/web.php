<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Customer\DashboardController;

// view halaman pertama sebelum Login
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     $jadwals = \App\Models\Jadwal::with('lapangan')->get();
//     return view('dashboard', compact('jadwals'));
// })->middleware(['auth'])->name('dashboard');


Route::get('/dashboard', function () {
    $user = auth()->user();
    // Dashboard Admin
    if ($user->role->name === 'admin') {
    $totalUsers = \App\Models\User::count();
    $totalBookings = \App\Models\Booking::count();
    $totalPendapatan = \App\Models\Booking::where('status', 'disetujui')->sum('total_bayar');
    $pendingBookings = \App\Models\Booking::with('user', 'jadwal.lapangan')->where('status', 'Pending')->get();

    return view('admin.dashboard', compact('totalUsers', 'totalBookings', 'totalPendapatan', 'pendingBookings'));
}


    // Dashboard customer
    $lapangans = \App\Models\Lapangan::whereHas('jadwals')->get();
    return view('customer.dashboard', compact('lapangans'));

})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// // untuk Admin
// Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
//     Route::resource('lapangans', \App\Http\Controllers\Admin\LapanganController::class);
//     Route::resource('jadwals', \App\Http\Controllers\Admin\JadwalController::class);
//     Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class);
//     Route::get('laporan/pemesanan', [\App\Http\Controllers\Admin\LaporanController::class, 'pemesanan'])->name('laporan.pemesanan');
//     Route::get('laporan/pendapatan', [\App\Http\Controllers\Admin\LaporanController::class, 'pendapatan'])->name('laporan.pendapatan');
//     Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
// });

// untuk Admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('lapangans', \App\Http\Controllers\Admin\LapanganController::class);
    Route::resource('jadwals', \App\Http\Controllers\Admin\JadwalController::class);
    Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class);
    Route::patch('bookings/{booking}/status', [\App\Http\Controllers\Admin\BookingController::class, 'updateStatus'])->name('bookings.updateStatus');

    Route::get('laporan/pemesanan', [\App\Http\Controllers\Admin\LaporanController::class, 'pemesanan'])->name('laporan.pemesanan');
    Route::get('laporan/pendapatan', [\App\Http\Controllers\Admin\LaporanController::class, 'pendapatan'])->name('laporan.pendapatan');
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::delete('/jadwals/lapangan/{lapangan_id}', [\App\Http\Controllers\Admin\JadwalController::class, 'destroyByLapangan'])->name('jadwals.destroyByLapangan');

});

//untuk Customer
Route::middleware(['auth'])->group(function () {
    
    Route::resource('bookings', \App\Http\Controllers\BookingController::class);

    Route::patch('bookings/{booking}/status', [\App\Http\Controllers\Admin\BookingController::class, 'updateStatus'])->name('bookings.updateStatus');

    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/jadwal/{id}', [\App\Http\Controllers\JadwalController::class, 'show'])->name('jadwal.show');
    Route::get('/booking/create/{jadwal}', [BookingController::class, 'create'])->name('booking.create');
    Route::get('/lapangan/{id}', [\App\Http\Controllers\LapanganController::class, 'show'])->name('lapangan.show');
    Route::get('/lapangan/tipe/{id}', [\App\Http\Controllers\LapanganController::class, 'showByTipe'])->name('lapangan.tipe');

    Route::get('/booking/custom/{lapangan}', [BookingController::class, 'customForm'])->name('booking.custom.form');
    Route::post('/booking/custom/{lapangan}', [BookingController::class, 'customStore'])->name('booking.custom.store');
    
    Route::get('/history', [App\Http\Controllers\HistoryController::class, 'index'])->name('customer.history');
});


require __DIR__.'/auth.php';