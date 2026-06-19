<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        // 1. Calculate Summaries
        $totalRevenue = Payment::where('status', 'paid')->sum('nominal');
        $totalFull = Payment::where('status', 'paid')->where('jenis', 'pelunasan')->sum('nominal');
        $totalDP = Payment::where('status', 'paid')->where('jenis', 'dp')->sum('nominal');
        
        $totalBookingsVal = Booking::sum('total_harga');
        $outstanding = max(0, $totalBookingsVal - $totalRevenue);

        $summaryCards = [
            ['label' => 'Total Revenue',      'value' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'), 'badge' => null, 'badgeColor' => 'green', 'icon' => 'revenue'],
            ['label' => 'Total DP Payments',   'value' => 'Rp ' . number_format($totalDP, 0, ',', '.'), 'badge' => null,     'badgeColor' => null,    'icon' => 'dp'],
            ['label' => 'Total Full Payments', 'value' => 'Rp ' . number_format($totalFull, 0, ',', '.'), 'badge' => null,     'badgeColor' => null,    'icon' => 'full'],
            ['label' => 'Outstanding Balance', 'value' => 'Rp ' . number_format($outstanding, 0, ',', '.'),  'badge' => null,     'badgeColor' => 'amber', 'icon' => 'outstanding'],
        ];

        // 2. Revenue & Booking Trends
        $period = strtolower($request->query('period', 'monthly'));

        $revenueData = [];
        $bookingData = [];
        $revenueMax = 1;
        $bookingMax = 1;

        $iterations = 6;
        $subMethod = 'subMonths';
        $startMethod = 'startOfMonth';
        $endMethod = 'endOfMonth';
        $format = 'M';

        if ($period === 'daily') {
            $iterations = 7;
            $subMethod = 'subDays';
            $startMethod = 'startOfDay';
            $endMethod = 'endOfDay';
            $format = 'd M';
        } elseif ($period === 'weekly') {
            $iterations = 4;
            $subMethod = 'subWeeks';
            $startMethod = 'startOfWeek';
            $endMethod = 'endOfWeek';
            $format = 'W'; // Will prepend 'W' below
        } elseif ($period === 'annual') {
            $iterations = 5;
            $subMethod = 'subYears';
            $startMethod = 'startOfYear';
            $endMethod = 'endOfYear';
            $format = 'Y';
        }

        for ($i = $iterations - 1; $i >= 0; $i--) {
            $date = Carbon::now()->$subMethod($i);
            $start = $date->copy()->$startMethod();
            $end = $date->copy()->$endMethod();

            $rev = Payment::where('status', 'paid')->whereBetween('created_at', [$start, $end])->sum('nominal');
            $label = $period === 'weekly' ? 'W' . $date->weekOfYear : $date->format($format);

            $revenueData[] = [
                'month' => $label,
                'value' => $rev / 1000000, // in Millions for chart logic
                'label' => 'Rp ' . number_format($rev / 1000000, 1) . 'M'
            ];
            if (($rev / 1000000) > $revenueMax) $revenueMax = $rev / 1000000;

            $bks = Booking::whereBetween('created_at', [$start, $end])->count();
            $bookingData[] = [
                'month' => $label,
                'value' => $bks,
                'label' => (string)$bks
            ];
            if ($bks > $bookingMax) $bookingMax = $bks;
        }

        // 3. Sport Revenue
        $sportsQuery = Booking::join('payments', 'bookings.id', '=', 'payments.booking_id')
            ->join('fields', 'bookings.field_id', '=', 'fields.id')
            ->selectRaw('fields.jenis_olahraga as sport, sum(payments.nominal) as total')
            ->where('payments.status', 'paid')
            ->groupBy('fields.jenis_olahraga')
            ->orderByDesc('total')
            ->get();

        $colors = ['#0047D4', '#6366f1', '#0ea5e9', '#10b981', '#f59e0b'];
        $sportRevenue = [];
        $grandTotal = $sportsQuery->sum('total');

        foreach ($sportsQuery as $index => $sq) {
            $sportRevenue[] = [
                'sport' => $sq->sport ?: 'Unknown',
                'amount' => 'Rp ' . number_format($sq->total, 0, ',', '.'),
                'pct' => $grandTotal > 0 ? round(($sq->total / $grandTotal) * 100, 1) : 0,
                'color' => $colors[$index % count($colors)]
            ];
        }

        // 4. Recent Transactions
        $recentPayments = Payment::with(['booking.user', 'booking.field'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $transactions = [];
        foreach ($recentPayments as $pay) {
            $b = $pay->booking;
            $code = 'BK-2026' . str_pad($b ? $b->id : 0, 4, '0', STR_PAD_LEFT);
            $transactions[] = [
                'date' => $pay->created_at->format('Y-m-d'),
                'code' => $code,
                'customer' => $b && $b->user ? $b->user->name : 'Unknown',
                'sport' => $b && $b->field ? $b->field->jenis_olahraga : '-',
                'amount' => 'Rp ' . number_format($pay->nominal, 0, ',', '.'),
                'type' => ucfirst($pay->jenis),
                'status' => ucfirst($pay->status) // 'paid', 'unpaid', etc.
            ];
        }

        return view('admin.reports', compact('summaryCards', 'revenueData', 'revenueMax', 'bookingData', 'bookingMax', 'sportRevenue', 'transactions', 'period'));
    }

    public function exportCsv()
    {
        $payments = Payment::with(['booking.user', 'booking.field'])
            ->where('status', 'paid')
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = "SportOps_Report_" . Carbon::now()->format('Ymd_His') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Transaction ID', 'Date', 'Customer', 'Sport Category', 'Amount (Rp)', 'Type', 'Status'];

        $callback = function() use($payments, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($payments as $pay) {
                $b = $pay->booking;
                $code = 'BK-2026' . str_pad($b ? $b->id : 0, 4, '0', STR_PAD_LEFT);
                $customer = $b && $b->user ? $b->user->name : 'Unknown';
                $sport = $b && $b->field ? $b->field->jenis_olahraga : '-';

                $row = [
                    $code,
                    $pay->created_at->format('Y-m-d H:i:s'),
                    $customer,
                    $sport,
                    $pay->nominal,
                    ucfirst($pay->jenis),
                    ucfirst($pay->status)
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
