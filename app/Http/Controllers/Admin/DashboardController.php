<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role_id', '!=', 1)->count();
        $totalBookings = Booking::count();
        $totalPendapatan = Booking::sum('total_harga');

        return view('admin.dashboard', compact('totalUsers', 'totalBookings', 'totalPendapatan'));
    }
}
