<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Field;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();
        $user = Auth::user();

        $staff = [
            'name' => $user->name ?? 'Staff',
        ];

        // Stats
        $todayBookings = Booking::whereDate('tanggal', $today)->count();
        $checkedIn = Booking::whereDate('tanggal', $today)->where('status', 'active')->count(); // active implies currently playing/checked in
        $pendingCheckin = Booking::whereDate('tanggal', $today)->where('status', 'confirmed')->count();
        $pendingSettlement = Booking::whereDate('tanggal', $today)->whereHas('payments', function($q) {
            $q->where('status_pembayaran', '!=', 'berhasil');
        })->count();

        $kpis = [
            ['label' => "Today's Bookings", 'value' => $todayBookings, 'color' => 'blue',  'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
            ['label' => 'Checked In',       'value' => $checkedIn, 'color' => 'green', 'icon' => '<path d="M20 6 9 17l-5-5"/>'],
            ['label' => 'Pending Check-In',  'value' => $pendingCheckin, 'color' => 'amber', 'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>'],
            ['label' => 'Pending Settlement','value' => $pendingSettlement, 'color' => 'rose',  'icon' => '<rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/>'],
        ];

        // Today's schedule
        $todaysSchedule = Booking::with(['user', 'field', 'payments'])
            ->whereDate('tanggal', $today)
            ->orderBy('jam_mulai', 'asc')
            ->take(5)
            ->get();

        $schedule = [];
        foreach ($todaysSchedule as $b) {
            $paymentStatus = $b->payments->first() ? $b->payments->first()->status_pembayaran : 'Unpaid';
            $payColor = $paymentStatus == 'berhasil' ? 'emerald' : 'amber';
            if ($paymentStatus == 'Unpaid') $payColor = 'gray';

            $statusColor = 'gray';
            if ($b->status === 'confirmed') $statusColor = 'blue';
            if ($b->status === 'active') $statusColor = 'emerald'; // Checked In
            if ($b->status === 'pending') $statusColor = 'amber';

            $schedule[] = [
                'time' => Carbon::parse($b->jam_mulai)->format('H:i') . ' - ' . Carbon::parse($b->jam_selesai)->format('H:i'),
                'customer' => $b->user ? $b->user->name : 'Unknown',
                'sport' => $b->field ? $b->field->jenis_olahraga : 'Unknown',
                'payment' => ucfirst($paymentStatus),
                'payment_color' => $payColor,
                'status' => ucfirst($b->status),
                'status_color' => $statusColor,
            ];
        }

        // Courts Status
        $allFields = Field::all();
        $courts = [];
        $currentTime = Carbon::now()->format('H:i:s');
        
        foreach ($allFields as $field) {
            // Check if currently booked
            $currentBooking = Booking::where('field_id', $field->id)
                ->whereDate('tanggal', $today)
                ->where('jam_mulai', '<=', $currentTime)
                ->where('jam_selesai', '>', $currentTime)
                ->whereIn('status', ['confirmed', 'active'])
                ->exists();

            $status = 'Available';
            $color = 'blue';

            if ($field->status == 'maintenance') {
                $status = 'Maintenance';
                $color = 'rose';
            } elseif ($currentBooking) {
                $status = 'In Use';
                $color = 'emerald';
            }

            $courts[] = [
                'name' => $field->nama_lapangan,
                'status' => $status,
                'color' => $color
            ];
        }

        return view('staff.dashboard', compact('staff', 'kpis', 'schedule', 'courts'));
    }
}
