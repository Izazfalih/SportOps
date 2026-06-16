<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Payment;
use App\Models\Field;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();

        // Basic Stats
        $todayBookings = Booking::whereDate('created_at', $today)->count();
        $activeBookings = Booking::whereIn('status', ['pending', 'confirmed'])->count();
        $totalUsers = User::count();
        $totalRevenue = Payment::where('status_pembayaran', 'berhasil')->sum('jumlah_bayar');

        // Formatted KPIs
        $kpis = [
            [
                'label'   => "Today's Bookings",
                'value'   => $todayBookings,
                'change'  => 'Today',
                'up'      => true,
                'color'   => 'blue',
                'bgClass' => 'bg-blue-50',
                'txtClass'=> 'text-[#0047D4]',
                'icon'    => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
            ],
            [
                'label'   => 'Active Bookings',
                'value'   => $activeBookings,
                'change'  => 'Current',
                'up'      => true,
                'color'   => 'emerald',
                'bgClass' => 'bg-emerald-50',
                'txtClass'=> 'text-emerald-600',
                'icon'    => '<path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2"/>',
            ],
            [
                'label'   => 'Total Revenue',
                'value'   => 'Rp ' . number_format($totalRevenue, 0, ',', '.'),
                'change'  => 'All time',
                'up'      => true,
                'color'   => 'violet',
                'bgClass' => 'bg-violet-50',
                'txtClass'=> 'text-violet-600',
                'icon'    => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
            ],
            [
                'label'   => 'Total Users',
                'value'   => $totalUsers,
                'change'  => 'All time',
                'up'      => true,
                'color'   => 'amber',
                'bgClass' => 'bg-amber-50',
                'txtClass'=> 'text-amber-600',
                'icon'    => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
            ],
            [
                'label'   => 'Court Utilization',
                'value'   => 'N/A', // Need complex query for this
                'change'  => '-',
                'up'      => true,
                'color'   => 'rose',
                'bgClass' => 'bg-rose-50',
                'txtClass'=> 'text-rose-600',
                'icon'    => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>',
            ],
        ];

        // Quick Stats
        $availableCourts = Field::where('status', 'aktif')->count();
        $pendingPayments = Booking::where('status', 'pending')->count();
        $revenueToday = Payment::whereDate('tanggal_bayar', $today)->where('status_pembayaran', 'berhasil')->sum('jumlah_bayar');
        $newUsersWeek = User::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        $quickStats = [
            ['label' => 'Courts Available', 'value' => $availableCourts,  'color' => 'text-emerald-600'],
            ['label' => 'Pending Payments',  'value' => $pendingPayments,       'color' => 'text-amber-600'],
            ['label' => 'Revenue Today',     'value' => 'Rp ' . number_format($revenueToday, 0, ',', '.'), 'color' => 'text-[#0047D4]'],
            ['label' => 'New Users (Week)',  'value' => $newUsersWeek,       'color' => 'text-violet-600'],
        ];

        // Activities - just dummy for now to save time, or map from recent bookings
        $recentActivities = Booking::with(['user', 'field'])->orderBy('created_at', 'desc')->take(5)->get();
        $activities = [];
        foreach ($recentActivities as $act) {
            $activities[] = [
                'title'   => 'New booking by ' . ($act->user ? $act->user->name : 'Unknown'),
                'desc'    => ($act->field ? $act->field->jenis_olahraga : 'Court') . ', ' . Carbon::parse($act->tanggal)->format('M d') . ' ' . Carbon::parse($act->jam_mulai)->format('H:i'),
                'time'    => $act->created_at->diffForHumans(),
                'color'   => 'bg-blue-500',
                'icon'    => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
            ];
        }

        // Table Bookings
        $upcomingBookings = Booking::with(['user', 'field', 'payments'])->orderBy('tanggal', 'desc')->orderBy('jam_mulai', 'desc')->take(10)->get();
        $bookings = [];
        foreach ($upcomingBookings as $b) {
            $paymentStatus = $b->payments->first() ? $b->payments->first()->status_pembayaran : 'Unpaid';
            $payColor = $paymentStatus == 'berhasil' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700';

            $statColor = 'bg-gray-100 text-gray-600';
            if ($b->status === 'confirmed') $statColor = 'bg-blue-50 text-[#0047D4]';
            if ($b->status === 'pending') $statColor = 'bg-amber-50 text-amber-700';

            $bookings[] = [
                'name'      => $b->user ? $b->user->name : 'Unknown',
                'sport'     => $b->field ? $b->field->jenis_olahraga : 'Unknown',
                'date'      => Carbon::parse($b->tanggal)->format('d M Y'),
                'time'      => Carbon::parse($b->jam_mulai)->format('H:i') . ' - ' . Carbon::parse($b->jam_selesai)->format('H:i'),
                'payment'   => ucfirst($paymentStatus),
                'payColor'  => $payColor,
                'status'    => ucfirst($b->status),
                'statColor' => $statColor,
            ];
        }

        return view('admin.dashboard', compact('kpis', 'quickStats', 'activities', 'bookings'));
    }
}
