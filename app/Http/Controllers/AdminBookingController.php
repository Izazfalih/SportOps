<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'field', 'payments']);

        // Date From filter
        if ($request->filled('date_from')) {
            $query->whereDate('tanggal', '>=', $request->date_from);
        }

        // Date To filter
        if ($request->filled('date_to')) {
            $query->whereDate('tanggal', '<=', $request->date_to);
        }

        // Status filter
        if ($request->filled('status') && $request->status !== 'All') {
            // Because the DB status are lowercase 'pending', 'confirmed', 'completed', 'cancelled'
            // and UI uses 'Pending Payment', 'Completed', etc.
            $statusMap = [
                'Pending Payment' => 'pending',
                'Confirmed'       => 'confirmed',
                'Completed'       => 'completed',
                'Cancelled'       => 'cancelled',
                'Active'          => 'active',
            ];
            
            // Just for checking if it matches the mapping, if not, try lowercasing the string directly
            $dbStatus = $statusMap[$request->status] ?? strtolower($request->status);
            
            // Some UI statuses might be 'DP Paid' or 'Fully Paid' which refer to the payment status rather than booking status.
            // For now, if the status exists in the map, use it.
            if (isset($statusMap[$request->status])) {
                $query->where('status', $statusMap[$request->status]);
            }
        }

        // Sport filter
        if ($request->filled('sport') && $request->sport !== 'All') {
            $query->whereHas('field', function ($q) use ($request) {
                $q->where('jenis_olahraga', $request->sport);
            });
        }

        // Search text (Name or code - we don't have code in DB strictly unless it's ID, so search ID or user name)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                // Assuming BK-202606... is the format, we can check if it contains the ID
                // We'll strip non-numeric if they search by ID
                if (preg_match('/BK-\d+-(\d+)/', $search, $matches)) {
                    $q->where('id', (int)$matches[1]);
                } else {
                    $q->whereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%");
                    });
                }
            });
        }

        // Order by latest
        $query->orderBy('tanggal', 'desc')->orderBy('jam_mulai', 'desc');

        // Paginate
        $bookingsData = $query->paginate(10);

        // Calculate summary cards
        // These can be dynamically calculated, or we can use the same logic as dashboard
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $activeToday = Booking::whereDate('tanggal', Carbon::today())->whereIn('status', ['confirmed', 'active'])->count();
        $completedMonth = Booking::whereMonth('tanggal', Carbon::now()->month)->where('status', 'completed')->count();

        $summaryCards = [
            ['label' => 'Total Bookings',      'value' => $totalBookings,   'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',                         'color' => 'blue'],
            ['label' => 'Pending Payment',     'value' => $pendingBookings, 'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',                                                    'color' => 'amber'],
            ['label' => 'Active Today',        'value' => $activeToday,     'icon' => '<path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/>', 'color' => 'green'],
            ['label' => 'Completed This Month','value' => $completedMonth,  'icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/>',                                  'color' => 'indigo'],
        ];

        return view('admin.bookings', compact('bookingsData', 'summaryCards'));
    }
}
