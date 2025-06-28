<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class HistoryController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('jadwal.lapangan')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.history', compact('bookings'));
    }
}
