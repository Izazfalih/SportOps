@extends('layouts.admin')

@section('title', 'Financial Reports')
@section('page-title', 'Financial Reports')
@section('page-subtitle', 'Revenue analytics and transaction history')

@push('styles')
<style>
.bar-tooltip { opacity: 0; transition: opacity 150ms; }
        .bar-wrapper:hover .bar-tooltip { opacity: 1; }
        .bar-fill { transition: height 500ms cubic-bezier(.4,0,.2,1); }
</style>
@endpush

@section('content')

    @php
$summaryCards = [
            ['label' => 'Total Revenue',      'value' => 'Rp 45,800,000', 'badge' => '+12.5%', 'badgeColor' => 'green', 'icon' => 'revenue'],
            ['label' => 'Total DP Payments',   'value' => 'Rp 18,200,000', 'badge' => null,     'badgeColor' => null,    'icon' => 'dp'],
            ['label' => 'Total Full Payments', 'value' => 'Rp 27,600,000', 'badge' => null,     'badgeColor' => null,    'icon' => 'full'],
            ['label' => 'Outstanding Balance', 'value' => 'Rp 3,400,000',  'badge' => null,     'badgeColor' => 'amber', 'icon' => 'outstanding'],
        ];

        $revenueData = [
            ['month' => 'Jan', 'value' => 5.2, 'label' => 'Rp 5.2M'],
            ['month' => 'Feb', 'value' => 6.1, 'label' => 'Rp 6.1M'],
            ['month' => 'Mar', 'value' => 7.8, 'label' => 'Rp 7.8M'],
            ['month' => 'Apr', 'value' => 8.2, 'label' => 'Rp 8.2M'],
            ['month' => 'May', 'value' => 9.3, 'label' => 'Rp 9.3M'],
            ['month' => 'Jun', 'value' => 9.2, 'label' => 'Rp 9.2M'],
        ];
        $revenueMax = 10;

        $bookingData = [
            ['month' => 'Jan', 'value' => 42, 'label' => '42'],
            ['month' => 'Feb', 'value' => 51, 'label' => '51'],
            ['month' => 'Mar', 'value' => 68, 'label' => '68'],
            ['month' => 'Apr', 'value' => 72, 'label' => '72'],
            ['month' => 'May', 'value' => 85, 'label' => '85'],
            ['month' => 'Jun', 'value' => 78, 'label' => '78'],
        ];
        $bookingMax = 90;

        $sportRevenue = [
            ['sport' => 'Futsal',      'amount' => 'Rp 18,500,000', 'pct' => 40.4, 'color' => '#0047D4'],
            ['sport' => 'Basketball',  'amount' => 'Rp 10,200,000', 'pct' => 22.3, 'color' => '#6366f1'],
            ['sport' => 'Tennis',      'amount' => 'Rp 8,400,000',  'pct' => 18.3, 'color' => '#0ea5e9'],
            ['sport' => 'Volleyball',  'amount' => 'Rp 5,100,000',  'pct' => 11.1, 'color' => '#10b981'],
            ['sport' => 'Badminton',   'amount' => 'Rp 3,600,000',  'pct' => 7.9,  'color' => '#f59e0b'],
        ];

        $transactions = [
            ['date' => '2026-06-10', 'code' => 'BK-20260610-001', 'customer' => 'Rizky Maulana',  'sport' => 'Futsal',      'amount' => 'Rp 400,000', 'type' => 'Full',  'status' => 'Completed'],
            ['date' => '2026-06-09', 'code' => 'BK-20260609-003', 'customer' => 'Sari Dewi',       'sport' => 'Basketball',  'amount' => 'Rp 150,000', 'type' => 'DP',    'status' => 'Pending'],
            ['date' => '2026-06-09', 'code' => 'BK-20260609-002', 'customer' => 'Ahmad Fauzan',    'sport' => 'Tennis',       'amount' => 'Rp 300,000', 'type' => 'Full',  'status' => 'Completed'],
            ['date' => '2026-06-08', 'code' => 'BK-20260608-005', 'customer' => 'Linda Kartika',   'sport' => 'Badminton',    'amount' => 'Rp 100,000', 'type' => 'DP',    'status' => 'Pending'],
            ['date' => '2026-06-08', 'code' => 'BK-20260608-002', 'customer' => 'Budi Santoso',    'sport' => 'Volleyball',   'amount' => 'Rp 250,000', 'type' => 'Full',  'status' => 'Completed'],
            ['date' => '2026-06-07', 'code' => 'BK-20260607-001', 'customer' => 'Mega Putri',      'sport' => 'Futsal',       'amount' => 'Rp 200,000', 'type' => 'DP',    'status' => 'Refunded'],
        ];
    @endphp


{{-- ==================== PAGE HEADER ==================== --}}
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Financial Reports</h2>
                        <p class="mt-1 text-sm text-gray-500">Overview of revenue, payments, and booking trends.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="window.print()" class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
                            Print
                        </button>
                        <button class="inline-flex items-center gap-2 rounded-xl bg-[#0047D4] px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            Export Report
                        </button>
                    </div>
                </div>

                {{-- ==================== TIME PERIOD TABS ==================== --}}
                <div class="mt-6 flex items-center gap-1 rounded-xl bg-white border border-gray-100 p-1 shadow-xs w-fit">
                    @foreach (['Daily', 'Weekly', 'Monthly', 'Annual'] as $period)
                        <button class="rounded-lg px-4 py-2 text-sm font-semibold transition-colors duration-150
                            {{ $period === 'Monthly'
                                ? 'bg-[#0047D4] text-white shadow-lg shadow-blue-500/10'
                                : 'text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]' }}">
                            {{ $period }}
                        </button>
                    @endforeach
                </div>

                {{-- ==================== SUMMARY CARDS ==================== --}}
                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    @foreach ($summaryCards as $card)
                        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs {{ $card['badgeColor'] === 'amber' ? 'border-amber-200' : '' }}">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-500">{{ $card['label'] }}</p>
                                {{-- Icon --}}
                                @if ($card['icon'] === 'revenue')
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50">
                                        <svg class="h-5 w-5 text-[#0047D4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                    </div>
                                @elseif ($card['icon'] === 'dp')
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50">
                                        <svg class="h-5 w-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/></svg>
                                    </div>
                                @elseif ($card['icon'] === 'full')
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50">
                                        <svg class="h-5 w-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                    </div>
                                @elseif ($card['icon'] === 'outstanding')
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50">
                                        <svg class="h-5 w-5 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    </div>
                                @endif
                            </div>
                            <p class="mt-3 text-2xl font-extrabold tracking-tight {{ $card['badgeColor'] === 'amber' ? 'text-amber-700' : 'text-gray-900' }}">
                                {{ $card['value'] }}
                            </p>
                            @if ($card['badge'])
                                <span class="mt-2 inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                                    {{ $card['badge'] }}
                                </span>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- ==================== CHARTS ROW ==================== --}}
                <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-2">

                    {{-- Revenue Trend Chart --}}
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-xs">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-base font-bold text-gray-900">Revenue Trends</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Jan – Jun 2026</p>
                            </div>
                            <span class="rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-semibold text-[#0047D4]">Monthly</span>
                        </div>
                        <div class="flex items-end justify-between gap-3 h-52">
                            @foreach ($revenueData as $bar)
                                <div class="bar-wrapper relative flex flex-1 flex-col items-center justify-end h-full">
                                    {{-- Tooltip --}}
                                    <div class="bar-tooltip absolute -top-7 rounded-lg bg-gray-900 px-2 py-1 text-[11px] font-semibold text-white whitespace-nowrap shadow-lg z-10">
                                        {{ $bar['label'] }}
                                    </div>
                                    {{-- Bar --}}
                                    <div class="bar-fill w-full max-w-[48px] rounded-t-xl bg-gradient-to-t from-[#0047D4] to-[#4d8bff] hover:from-[#003cb5] hover:to-[#0047D4] cursor-pointer"
                                         style="height: {{ ($bar['value'] / $revenueMax) * 100 }}%">
                                    </div>
                                    {{-- Label --}}
                                    <span class="mt-2 text-xs font-medium text-gray-500">{{ $bar['month'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Booking Trend Chart --}}
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-xs">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-base font-bold text-gray-900">Booking Trends</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Jan – Jun 2026</p>
                            </div>
                            <span class="rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Monthly</span>
                        </div>
                        <div class="flex items-end justify-between gap-3 h-52">
                            @foreach ($bookingData as $bar)
                                <div class="bar-wrapper relative flex flex-1 flex-col items-center justify-end h-full">
                                    <div class="bar-tooltip absolute -top-7 rounded-lg bg-gray-900 px-2 py-1 text-[11px] font-semibold text-white whitespace-nowrap shadow-lg z-10">
                                        {{ $bar['label'] }} bookings
                                    </div>
                                    <div class="bar-fill w-full max-w-[48px] rounded-t-xl bg-gradient-to-t from-emerald-600 to-emerald-400 hover:from-emerald-700 hover:to-emerald-500 cursor-pointer"
                                         style="height: {{ ($bar['value'] / $bookingMax) * 100 }}%">
                                    </div>
                                    <span class="mt-2 text-xs font-medium text-gray-500">{{ $bar['month'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ==================== REVENUE BY SPORT ==================== --}}
                <div class="mt-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-xs">
                    <h3 class="text-base font-bold text-gray-900">Revenue by Sport</h3>
                    <p class="text-xs text-gray-500 mt-0.5 mb-5">Breakdown of total revenue by sport category</p>

                    <div class="space-y-4">
                        @foreach ($sportRevenue as $sport)
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <span class="text-sm font-semibold text-gray-700">{{ $sport['sport'] }}</span>
                                    <div class="flex items-center gap-3">
                                        <span class="text-sm font-bold text-gray-900">{{ $sport['amount'] }}</span>
                                        <span class="min-w-[48px] text-right text-xs font-semibold text-gray-500">{{ $sport['pct'] }}%</span>
                                    </div>
                                </div>
                                <div class="h-3 w-full overflow-hidden rounded-full bg-gray-100">
                                    <div class="h-full rounded-full transition-all duration-500" style="width: {{ $sport['pct'] }}%; background-color: {{ $sport['color'] }}"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- ==================== RECENT TRANSACTIONS ==================== --}}
                <div class="mt-6 rounded-2xl border border-gray-100 bg-white shadow-xs overflow-hidden">
                    <div class="flex items-center justify-between p-6 pb-0">
                        <div>
                            <h3 class="text-base font-bold text-gray-900">Recent Transactions</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Latest financial activities</p>
                        </div>
                    </div>

                    <div class="mt-4 overflow-x-auto">
                        <table class="w-full min-w-[700px]">
                            <thead>
                                <tr class="border-y border-gray-100 bg-gray-50/60">
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Booking Code</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Sport</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-gray-500">Amount</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold uppercase tracking-wider text-gray-500">Type</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach ($transactions as $tx)
                                    <tr class="hover:bg-gray-50/50 transition-colors duration-100">
                                        <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap">{{ $tx['date'] }}</td>
                                        <td class="px-6 py-4 text-sm font-mono font-semibold text-gray-900 whitespace-nowrap">{{ $tx['code'] }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $tx['customer'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap">{{ $tx['sport'] }}</td>
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 text-right whitespace-nowrap">{{ $tx['amount'] }}</td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold
                                                {{ $tx['type'] === 'DP'
                                                    ? 'bg-amber-50 text-amber-700'
                                                    : 'bg-blue-50 text-[#0047D4]' }}">
                                                {{ $tx['type'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if ($tx['status'] === 'Completed')
                                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                    Completed
                                                </span>
                                            @elseif ($tx['status'] === 'Pending')
                                                <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                    Pending
                                                </span>
                                            @elseif ($tx['status'] === 'Refunded')
                                                <span class="inline-flex items-center gap-1 rounded-full bg-rose-50 px-2.5 py-1 text-xs font-semibold text-rose-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                                    Refunded
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Table footer --}}
                    <div class="flex items-center justify-between border-t border-gray-100 px-6 py-4">
                        <p class="text-sm text-gray-500">Showing {{ count($transactions) }} latest transactions</p>
                        <button class="text-sm font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors">View all transactions →</button>
                    </div>
                </div>

@endsection
