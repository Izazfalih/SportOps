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
            $q->where('status', '!=', 'paid');
        })->count();

        $kpis = [
            ['label' => "Today's Bookings", 'value' => $todayBookings, 'color' => 'blue',  'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
            ['label' => 'Active / Playing',       'value' => $checkedIn, 'color' => 'green', 'icon' => '<path d="M20 6 9 17l-5-5"/>'],
            ['label' => 'Pending Verification',  'value' => $pendingCheckin, 'color' => 'amber', 'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>'],
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
            $paymentStatus = $b->payments->first() ? $b->payments->first()->status : 'unpaid';
            $payColor = $paymentStatus == 'paid' ? 'emerald' : 'amber';
            if ($paymentStatus == 'unpaid') $payColor = 'gray';

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

    public function schedule(Request $request)
    {
        $dateParam = $request->query('date', Carbon::today()->toDateString());
        $date = Carbon::parse($dateParam);
        
        $currentDate = $date->format('l, d F Y'); // e.g. Tuesday, 10 June 2026
        $currentDateShort = $date->format('d M Y');
        $prevDate = $date->copy()->subDay()->toDateString();
        $nextDate = $date->copy()->addDay()->toDateString();

        $activeFilter = $request->query('filter', 'all');

        $allFields = Field::all();
        
        // Filter courts based on active filter
        $courts = [];
        foreach ($allFields as $field) {
            $sportKey = strtolower($field->jenis_olahraga);
            // normalization
            if (str_contains($sportKey, 'basket')) $sportKey = 'basketball';
            if (str_contains($sportKey, 'tenis') || str_contains($sportKey, 'tennis')) $sportKey = 'tennis';
            if (str_contains($sportKey, 'voli')) $sportKey = 'volleyball';

            if ($activeFilter === 'all' || $activeFilter === $sportKey) {
                $courts[] = [
                    'id' => $field->id,
                    'name' => $field->nama_lapangan,
                    'sport' => ucfirst($sportKey), // normalized name for UI display
                    'status' => $field->status,
                ];
            }
        }

        $timeSlots = [];
        $start = 8;
        $end = 21; // 08:00 to 21:00 slots
        for ($h = $start; $h <= $end; $h++) {
            $timeSlots[] = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00';
        }

        $allBookings = Booking::with(['user', 'payments'])
            ->whereDate('tanggal', $date)
            ->get();

        $bookings = [];
        $stats = [
            'total'       => count($timeSlots) * count($courts),
            'booked'      => 0,
            'available'   => 0,
            'maintenance' => 0,
        ];

        foreach ($timeSlots as $time) {
            $h = substr($time, 0, 2);
            $nextH = str_pad(intval($h) + 1, 2, '0', STR_PAD_LEFT);
            $jam_mulai = "$h:00:00";
            $jam_selesai = "$nextH:00:00";

            $bookings[$time] = [];

            foreach ($courts as $court) {
                // Maintenance removed per user request

                $b = $allBookings->where('field_id', $court['id'])
                    ->filter(function($booking) use ($jam_mulai, $jam_selesai) {
                        return $booking->jam_mulai < $jam_selesai && $booking->jam_selesai > $jam_mulai;
                    })->first();

                if ($b && in_array($b->status, ['confirmed', 'active', 'completed', 'pending'])) {
                    $paymentStatus = 'Pending';
                    $totalPaid = $b->payments->where('status', 'paid')->sum('nominal');
                    if ($totalPaid > 0) {
                        $paymentStatus = $totalPaid >= $b->total_harga ? 'Fully Paid' : 'DP Paid';
                    }

                    $statusMap = [
                        'confirmed' => 'booked',
                        'pending'   => 'booked',
                        'active'    => 'active',
                        'completed' => 'completed',
                    ];

                    $bookings[$time][$court['id']] = [
                        'status' => $statusMap[$b->status] ?? 'booked',
                        'customer' => $b->user ? $b->user->name : 'Unknown',
                        'payment' => $paymentStatus,
                    ];
                    
                    $stats['booked']++;
                } else {
                    $stats['available']++;
                }
            }
        }

        return view('staff.schedule', compact(
            'currentDate', 'currentDateShort', 'prevDate', 'nextDate',
            'courts', 'timeSlots', 'bookings', 'stats', 'activeFilter', 'dateParam'
        ));
    }

    public function verification()
    {
        $today = \Carbon\Carbon::today();

        $bookings = \App\Models\Booking::with(['user', 'field', 'payments'])
            ->whereDate('tanggal', $today)
            ->whereIn('status', ['confirmed', 'active', 'completed'])
            ->orderBy('jam_mulai', 'asc')
            ->get();

        $bookedList = [];
        $activeList = [];
        $completedList = [];

        foreach ($bookings as $b) {
            $paymentStatus = 'Pending';
            $totalPaid = $b->payments->where('status', 'paid')->sum('nominal');
            $dpPaid = $b->payments->where('status', 'dp')->sum('nominal');
            $paidAmount = $totalPaid + $dpPaid;
            $remaining = $b->total_harga - $paidAmount;
            
            if ($totalPaid >= $b->total_harga) {
                $paymentStatus = 'Fully Paid';
            } elseif ($paidAmount > 0) {
                $paymentStatus = 'DP Paid';
            }

            $payColor = $paymentStatus === 'Fully Paid' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700';

            $data = [
                'id'          => $b->id,
                'code'        => 'BK-2026' . str_pad($b->id, 4, '0', STR_PAD_LEFT),
                'customer'    => $b->user ? $b->user->name : 'Unknown',
                'sport'       => $b->field ? $b->field->jenis_olahraga : 'N/A',
                'court'       => $b->field ? $b->field->nama_lapangan : 'N/A',
                'date'        => \Carbon\Carbon::parse($b->tanggal)->format('d M Y'),
                'time'        => \Carbon\Carbon::parse($b->jam_mulai)->format('H:i') . ' – ' . \Carbon\Carbon::parse($b->jam_selesai)->format('H:i'),
                'payment'     => $paymentStatus,
                'payColor'    => $payColor,
                'totalPrice'  => $b->total_harga,
                'paidAmount'  => $paidAmount,
                'remaining'   => $remaining,
                'warning'     => null,
                'checkedAt'   => $b->updated_at->format('H:i'),
            ];

            if ($b->status === 'confirmed') {
                $bookedList[] = $data;
            } elseif ($b->status === 'active') {
                $activeList[] = $data;
            } else {
                $completedList[] = $data;
            }
        }

        return view('staff.verification', compact('bookedList', 'activeList', 'completedList'));
    }

    public function processVerification(\Illuminate\Http\Request $request, $id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        
        if ($booking->status === 'confirmed') {
            $booking->update(['status' => 'active']);
            return redirect()->route('staff.verification')->with('success', 'Customer marked as Active!');
        } elseif ($booking->status === 'active') {
            $booking->update(['status' => 'completed']);
            return redirect()->route('staff.verification')->with('success', 'Booking marked as Completed!');
        }
        
        return redirect()->route('staff.verification');
    }

    public function offlineBooking()
    {
        $staff = ['name' => Auth::user()->name ?? 'Staff'];

        $fields = Field::all();
        $sports = [];
        foreach ($fields as $field) {
            $sports[] = [
                'id' => $field->id,
                'name' => $field->nama_lapangan,
                'price' => $field->harga,
                'icon' => $this->getSportIcon($field->jenis_olahraga),
                'available' => $field->status !== 'maintenance',
                'note' => $field->status === 'maintenance' ? 'Maintenance' : '',
            ];
        }

        $timeSlots = [];
        $start = 8;
        $end = 22; // up to 22:00
        for ($i = $start; $i <= $end; $i++) {
            $h = str_pad($i, 2, '0', STR_PAD_LEFT);
            $nextH = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
            $timeSlots[] = [
                'time' => "$h:00 - $nextH:00",
                'hour' => "$h:00",
                'status' => 'available',
            ];
        }

        // Court Schedules (Right Panel)
        $selectedDate = request('date', Carbon::today()->format('Y-m-d'));
        $bookingsToday = Booking::with('user')
            ->whereDate('tanggal', $selectedDate)
            ->whereIn('status', ['pending', 'confirmed', 'active', 'completed'])
            ->get();
        
        $courtSchedules = [];
        foreach ($fields as $field) {
            $slots = [];
            $bookedHours = [];
            $fieldBookings = $bookingsToday->where('field_id', $field->id);
            foreach ($fieldBookings as $b) {
                $slots[] = [
                    'time' => Carbon::parse($b->jam_mulai)->format('H:i') . ' - ' . Carbon::parse($b->jam_selesai)->format('H:i'),
                    'customer' => $b->user ? $b->user->name : 'Unknown',
                ];
                
                $startHour = (int) Carbon::parse($b->jam_mulai)->format('H');
                $endHour = (int) Carbon::parse($b->jam_selesai)->format('H');
                for ($h = $startHour; $h < $endHour; $h++) {
                    $hStr = str_pad($h, 2, '0', STR_PAD_LEFT);
                    $nextHStr = str_pad($h + 1, 2, '0', STR_PAD_LEFT);
                    $bookedHours[] = "$hStr:00 - $nextHStr:00";
                }
            }
            $courtSchedules[] = [
                'id' => $field->id,
                'court' => $field->nama_lapangan,
                'sport' => $field->jenis_olahraga,
                'color' => 'bg-blue-500', 
                'slots' => $slots,
                'booked_hours' => $bookedHours,
                'note' => $field->status === 'maintenance' ? 'Under Maintenance' : '',
            ];
        }

        return view('staff.offline-booking', compact('sports', 'timeSlots', 'courtSchedules', 'staff', 'selectedDate'));
    }

    private function getSportIcon($sport) {
        $sport = strtolower($sport);
        if (str_contains($sport, 'futsal')) return '⚽';
        if (str_contains($sport, 'badminton')) return '🏸';
        if (str_contains($sport, 'basket')) return '🏀';
        if (str_contains($sport, 'voli')) return '🏐';
        if (str_contains($sport, 'tenis') || str_contains($sport, 'tennis')) return '🎾';
        return '🏟️';
    }

    public function storeOfflineBooking(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'phone_number' => 'required|string',
            'field_id' => 'required|exists:fields,id',
            'booking_date' => 'required|date',
            'time' => 'required|string',
            'payment_type' => 'required|in:dp,full',
        ]);

        // Find or create user by phone
        $user = \App\Models\User::where('phone', $request->phone_number)->first();
        if (!$user) {
            $user = \App\Models\User::create([
                'name' => $request->customer_name,
                'phone' => $request->phone_number,
                'email' => preg_replace('/[^a-zA-Z0-9]/', '', $request->phone_number) . '@walkin.local',
                'password' => \Illuminate\Support\Facades\Hash::make('walkin123'),
                'role' => 'user',
            ]);
        }

        // Parse time
        $timeParts = explode('-', $request->time);
        $jam_mulai = trim($timeParts[0]);
        $jam_selesai = trim($timeParts[1] ?? ($jam_mulai)); 

        // Check if already booked
        $exists = Booking::where('field_id', $request->field_id)
            ->where('tanggal', $request->booking_date)
            ->where('jam_mulai', '<', $jam_selesai)
            ->where('jam_selesai', '>', $jam_mulai)
            ->whereIn('status', ['pending', 'confirmed', 'active'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Court is already booked for the selected time slot. Please choose another time.');
        }

        $field = Field::find($request->field_id);
        $totalHarga = $field->harga;

        $booking = Booking::create([
            'user_id' => $user->id,
            'field_id' => $field->id,
            'tanggal' => $request->booking_date,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
            'total_harga' => $totalHarga,
            'status' => 'confirmed',
        ]);

        $nominal = $request->payment_type === 'dp' ? ($totalHarga / 2) : $totalHarga;

        \App\Models\Payment::create([
            'booking_id' => $booking->id,
            'metode' => 'cash',
            'status' => 'paid',
            'nominal' => $nominal,
            'jenis' => $request->payment_type === 'dp' ? 'dp' : 'pelunasan',
        ]);

        return back()->with('success', [
            'code' => 'WLK-' . date('ymd') . '-' . str_pad($booking->id, 3, '0', STR_PAD_LEFT),
            'customer' => $user->name,
            'court' => $field->nama_lapangan,
            'datetime' => Carbon::parse($booking->tanggal)->format('d M Y') . ' • ' . $jam_mulai . ' - ' . $jam_selesai,
            'payment' => 'Rp ' . number_format($nominal, 0, ',', '.') . ' (' . strtoupper($request->payment_type) . ' - Paid Cash)'
        ]);
    }

    public function settlement()
    {
        $allBookings = Booking::with(['user', 'field', 'payments' => function ($q) {
            $q->where('status', 'paid');
        }])->get();

        $pendingSettlements = [];
        $recentlySettled = [];
        $totalOutstanding = 0;
        $settledTodayAmount = 0;
        $today = Carbon::today()->toDateString();

        foreach ($allBookings as $booking) {
            $totalPaid = $booking->payments->sum('nominal');
            $remaining = $booking->total_harga - $totalPaid;
            $code = 'WLK-' . date('ymd', strtotime($booking->created_at)) . '-' . str_pad($booking->id, 3, '0', STR_PAD_LEFT);

            if ($remaining > 0) {
                // Determine date relative wording (e.g. "Today", "Yesterday")
                $bDate = Carbon::parse($booking->tanggal);
                $dateStr = $bDate->format('d M Y');
                $timeStr = Carbon::parse($booking->jam_mulai)->format('H:i') . ' - ' . Carbon::parse($booking->jam_selesai)->format('H:i');

                $pendingSettlements[] = [
                    'id'        => $booking->id,
                    'code'      => $code,
                    'customer'  => $booking->user ? $booking->user->name : 'Unknown',
                    'sport'     => $booking->field ? $this->getSportName($booking->field->jenis_olahraga) : 'Unknown',
                    'court'     => $booking->field ? $booking->field->nama_lapangan : 'Unknown',
                    'date'      => $dateStr,
                    'time'      => $timeStr,
                    'total'     => $booking->total_harga,
                    'dp'        => $totalPaid,
                    'remaining' => $remaining,
                ];
                $totalOutstanding += $remaining;
            }

            // Check if settled today
            foreach ($booking->payments as $payment) {
                if ($payment->jenis === 'pelunasan' && Carbon::parse($payment->created_at)->toDateString() === $today) {
                    $recentlySettled[] = [
                        'code'      => $code,
                        'customer'  => $booking->user ? $booking->user->name : 'Unknown',
                        'sport'     => $booking->field ? $this->getSportName($booking->field->jenis_olahraga) : 'Unknown',
                        'amount'    => $payment->nominal,
                        'time'      => Carbon::parse($payment->created_at)->format('H:i'),
                    ];
                    $settledTodayAmount += $payment->nominal;
                }
            }
        }

        return view('staff.settlement', compact(
            'pendingSettlements',
            'recentlySettled',
            'totalOutstanding',
            'settledTodayAmount'
        ));
    }

    public function storeSettlement(Request $request, Booking $booking)
    {
        $request->validate([
            'metode' => 'required|in:cash,transfer',
        ]);

        $totalPaid = $booking->payments()->where('status', 'paid')->sum('nominal');
        $remaining = $booking->total_harga - $totalPaid;

        if ($remaining <= 0) {
            return back()->with('error', 'This booking is already fully paid.');
        }

        \App\Models\Payment::create([
            'booking_id' => $booking->id,
            'metode' => $request->metode,
            'status' => 'paid',
            'nominal' => $remaining,
            'jenis' => 'pelunasan',
        ]);

        return back()->with('success', 'Payment settled successfully.');
    }

    private function getSportName($jenis)
    {
        $sportKey = strtolower($jenis);
        if (str_contains($sportKey, 'basket')) return 'Basketball';
        if (str_contains($sportKey, 'tenis') || str_contains($sportKey, 'tennis')) return 'Tennis';
        if (str_contains($sportKey, 'voli')) return 'Volleyball';
        return ucfirst($sportKey);
    }
}
