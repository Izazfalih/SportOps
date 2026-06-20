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

        return view('user.booking-history', ['history' => $mappedHistory->toArray(), 'user' => $user]);
    }

    public function create()
    {
        $fields = \App\Models\Field::all();
        $bookings = \App\Models\Booking::where('tanggal', '>=', date('Y-m-d'))
            ->whereIn('status', ['pending', 'confirmed'])
            ->get(['field_id', 'tanggal', 'jam_mulai', 'jam_selesai']);
        return view('user.booking', compact('fields', 'bookings'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:1',
            'pay_type' => 'required|in:full,dp',
            'total_harga' => 'required|numeric',
            'amount_paid' => 'required|numeric'
        ]);

        $jamMulai = \Carbon\Carbon::parse($validated['jam_mulai']);
        $jamSelesai = $jamMulai->copy()->addHours($validated['durasi']);

        // Cek konflik jadwal (sederhana)
        $conflict = \App\Models\Booking::where('field_id', $validated['field_id'])
            ->where('tanggal', $validated['tanggal'])
            ->whereIn('status', ['pending', 'confirmed', 'active'])
            ->where(function($query) use ($jamMulai, $jamSelesai) {
                $query->where(function($q) use ($jamMulai, $jamSelesai) {
                    $q->where('jam_mulai', '<', $jamSelesai->format('H:i'))
                      ->where('jam_selesai', '>', $jamMulai->format('H:i'));
                });
            })->exists();

        if ($conflict) {
            return response()->json(['error' => 'Jadwal pada jam tersebut sudah dipesan.'], 400);
        }

        $booking = \App\Models\Booking::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'field_id' => $validated['field_id'],
            'tanggal' => $validated['tanggal'],
            'jam_mulai' => $jamMulai->format('H:i:s'),
            'jam_selesai' => $jamSelesai->format('H:i:s'),
            'total_harga' => $validated['total_harga'],
            'status' => $validated['pay_type'] === 'full' ? 'confirmed' : 'pending',
            'catatan' => 'Pemesanan dari Web App'
        ]);

        \App\Models\Payment::create([
            'booking_id' => $booking->id,
            'metode' => 'qris',
            'nominal' => $validated['amount_paid'],
            'status' => 'paid',
            'jenis' => $validated['pay_type'] === 'full' ? 'pelunasan' : 'dp'
        ]);

        return response()->json([
            'success' => true, 
            'booking_id' => 'SPO-' . str_pad($booking->id, 5, '0', STR_PAD_LEFT)
        ]);
    }
}
