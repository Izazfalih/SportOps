<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $authUser = Auth::user();
        
        // Menghitung total pesanan
        $totalBookings = $authUser->bookings()->count();

        // Data user untuk tampilan
        $user = [
            'name'     => $authUser->name,
            'first'    => explode(' ', trim($authUser->name))[0],
            'email'    => $authUser->email,
            'initials' => strtoupper(substr($authUser->name, 0, 2)),
            'bookings' => $totalBookings,
        ];

        // Mengambil pesanan terdekat yang akan datang
        $upcomingBooking = $authUser->bookings()
            ->with('field')
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('tanggal', '>=', date('Y-m-d'))
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->first();

        return view('dashboard', compact('user', 'upcomingBooking'));
    }
}
