<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Mengambil riwayat booking milik user yang sedang login beserta data lapangan
        $history = $user->bookings()->with('field')->orderBy('tanggal', 'desc')->orderBy('jam_mulai', 'desc')->get();

        // Map status untuk frontend
        $mappedHistory = $history->map(function ($booking) {
            // Logika sederhana untuk status pembayaran berdasarkan status booking
            $payStatus = 'Deposit';
            if ($booking->status === 'completed' || $booking->status === 'confirmed') {
                $payStatus = 'Paid';
            } elseif ($booking->status === 'cancelled') {
                $payStatus = 'Refunded';
            }

            // Map status
            $status = 'Upcoming';
            if ($booking->status === 'completed') {
                $status = 'Completed';
            } elseif ($booking->status === 'cancelled') {
                $status = 'Cancelled';
            }

            return [
                'id' => 'SPO-' . str_pad($booking->id, 5, '0', STR_PAD_LEFT),
                'court' => $booking->field ? $booking->field->nama_lapangan : 'Unknown Court',
                'date' => \Carbon\Carbon::parse($booking->tanggal)->format('M d, Y'),
                'time' => \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') . ' — ' . \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i'),
                'amount' => 'Rp' . number_format($booking->total_harga, 0, ',', '.'),
                'pay' => $payStatus,
                'status' => $status,
            ];
        });

        return view('booking-history', ['history' => $mappedHistory->toArray(), 'user' => $user]);
    }
}
