@extends('layouts.staff')

@section('title', 'Settlement')
@section('page-title', 'Payment Settlement')
@section('page-subtitle', 'Complete remaining payment balances')

@section('content')

    @php
$pendingSettlements = [
            [
                'code'      => 'BK-20260610-002',
                'customer'  => 'Sarah Putri',
                'sport'     => 'Badminton',
                'court'     => 'Court A2',
                'date'      => '10 Jun 2026',
                'time'      => '11:00 – 12:00',
                'total'     => 75000,
                'dp'        => 37500,
                'remaining' => 37500,
            ],
            [
                'code'      => 'BK-20260610-006',
                'customer'  => 'Fajar Hidayat',
                'sport'     => 'Volleyball',
                'court'     => 'Court V1',
                'date'      => '10 Jun 2026',
                'time'      => '16:00 – 17:00',
                'total'     => 100000,
                'dp'        => 50000,
                'remaining' => 50000,
            ],
            [
                'code'      => 'BK-20260609-015',
                'customer'  => 'Andi Wijaya',
                'sport'     => 'Futsal',
                'court'     => 'Court F1',
                'date'      => '9 Jun 2026',
                'time'      => 'Yesterday',
                'total'     => 150000,
                'dp'        => 75000,
                'remaining' => 75000,
            ],
            [
                'code'      => 'BK-20260608-022',
                'customer'  => 'Lisa Permata',
                'sport'     => 'Basketball',
                'court'     => 'Court B1',
                'date'      => '8 Jun 2026',
                'time'      => '2 days ago',
                'total'     => 200000,
                'dp'        => 100000,
                'remaining' => 100000,
            ],
            [
                'code'      => 'BK-20260610-011',
                'customer'  => 'Dimas Pratama',
                'sport'     => 'Badminton',
                'court'     => 'Court A1',
                'date'      => '10 Jun 2026',
                'time'      => '14:00 – 15:00',
                'total'     => 75000,
                'dp'        => 37500,
                'remaining' => 37500,
            ],
        ];

        $recentlySettled = [
            [
                'code'      => 'BK-20260610-001',
                'customer'  => 'Budi Santoso',
                'sport'     => 'Futsal',
                'amount'    => 75000,
                'time'      => '10:05',
            ],
            [
                'code'      => 'BK-20260610-008',
                'customer'  => 'Yoga Permana',
                'sport'     => 'Badminton',
                'amount'    => 37500,
                'time'      => '09:15',
            ],
            [
                'code'      => 'BK-20260610-007',
                'customer'  => 'Riko Aditya',
                'sport'     => 'Futsal',
                'amount'    => 75000,
                'time'      => '08:30',
            ],
        ];

        $totalOutstanding = collect($pendingSettlements)->sum('remaining');
        $settledToday = collect($recentlySettled)->sum('amount');
    @endphp


{{-- Summary cards --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                {{-- Pending Settlements --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </span>
                    </div>
                    <p class="mt-3 text-2xl font-extrabold tracking-tight text-gray-900">{{ count($pendingSettlements) }}</p>
                    <p class="mt-1 text-sm text-gray-500">Pending Settlements</p>
                </div>

                {{-- Total Outstanding --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        </span>
                    </div>
                    <p class="mt-3 text-2xl font-extrabold tracking-tight text-gray-900">Rp {{ number_format($totalOutstanding, 0, ',', '.') }}</p>
                    <p class="mt-1 text-sm text-gray-500">Total Outstanding</p>
                </div>

                {{-- Settled Today --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </span>
                    </div>
                    <p class="mt-3 text-2xl font-extrabold tracking-tight text-emerald-600">Rp {{ number_format($settledToday, 0, ',', '.') }}</p>
                    <p class="mt-1 text-sm text-gray-500">Settled Today</p>
                </div>
            </div>

            {{-- Search bar --}}
            <div class="mt-6">
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </span>
                    <input type="text" id="search-input" placeholder="Search by booking code or customer name..." class="w-full rounded-2xl border border-gray-200 bg-white py-3.5 pl-12 pr-4 text-sm text-gray-900 shadow-xs placeholder:text-gray-400 focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-[#0047D4]/10 transition-all duration-150">
                </div>
            </div>

            {{-- Pending Settlements --}}
            <div class="mt-6 rounded-2xl border border-gray-100 bg-white shadow-xs">
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <h2 class="text-base font-bold text-gray-900">Pending Settlements</h2>
                        <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">{{ count($pendingSettlements) }} pending</span>
                    </div>
                </div>

                {{-- Desktop table --}}
                <div class="hidden overflow-x-auto lg:block">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-gray-100 text-xs font-bold uppercase tracking-wider text-gray-400">
                                <th class="px-6 py-3.5">Booking Code</th>
                                <th class="px-6 py-3.5">Customer</th>
                                <th class="px-6 py-3.5">Court (Sport)</th>
                                <th class="px-6 py-3.5">Date & Time</th>
                                <th class="px-6 py-3.5">Total Price</th>
                                <th class="px-6 py-3.5">DP Paid</th>
                                <th class="px-6 py-3.5">Remaining</th>
                                <th class="px-6 py-3.5">Status</th>
                                <th class="px-6 py-3.5">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50" id="settlements-table-body">
                            @foreach ($pendingSettlements as $index => $s)
                                <tr class="settlement-row transition-colors duration-100 hover:bg-gray-50/50" data-search="{{ strtolower($s['code'] . ' ' . $s['customer']) }}">
                                    <td class="px-6 py-4">
                                        <span class="font-mono text-xs font-semibold text-[#0047D4]">{{ $s['code'] }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gray-100 text-xs font-bold text-gray-600">{{ collect(explode(' ', $s['customer']))->map(fn($w) => mb_substr($w, 0, 1))->join('') }}</span>
                                            <span class="font-semibold text-gray-900">{{ $s['customer'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $s['court'] }} ({{ $s['sport'] }})</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $s['date'] }}<br><span class="text-xs text-gray-400">{{ $s['time'] }}</span></td>
                                    <td class="px-6 py-4 text-gray-600">Rp {{ number_format($s['total'], 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-gray-600">Rp {{ number_format($s['dp'], 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="text-base font-extrabold text-rose-600">Rp {{ number_format($s['remaining'], 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">DP Paid</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="button" onclick="openSettleModal({{ $index }})" class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-lg shadow-emerald-500/10 transition-colors duration-150 hover:bg-emerald-700">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                            Settle Payment
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile cards --}}
                <div class="divide-y divide-gray-50 lg:hidden" id="settlements-cards">
                    @foreach ($pendingSettlements as $index => $s)
                        <div class="settlement-row p-4" data-search="{{ strtolower($s['code'] . ' ' . $s['customer']) }}">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span class="font-mono text-xs font-semibold text-[#0047D4]">{{ $s['code'] }}</span>
                                    <div class="mt-1 flex items-center gap-2">
                                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-gray-100 text-[10px] font-bold text-gray-600">{{ collect(explode(' ', $s['customer']))->map(fn($w) => mb_substr($w, 0, 1))->join('') }}</span>
                                        <span class="font-semibold text-gray-900">{{ $s['customer'] }}</span>
                                    </div>
                                </div>
                                <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">DP Paid</span>
                            </div>

                            <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                                <div>
                                    <p class="text-xs text-gray-400">Court (Sport)</p>
                                    <p class="font-medium text-gray-700">{{ $s['court'] }} ({{ $s['sport'] }})</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Date & Time</p>
                                    <p class="font-medium text-gray-700">{{ $s['date'] }}, {{ $s['time'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Total</p>
                                    <p class="font-medium text-gray-700">Rp {{ number_format($s['total'], 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">DP Paid</p>
                                    <p class="font-medium text-gray-700">Rp {{ number_format($s['dp'], 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="mt-3 flex items-center justify-between rounded-xl bg-rose-50 px-4 py-3">
                                <div>
                                    <p class="text-xs font-medium text-rose-500">Remaining Balance</p>
                                    <p class="text-lg font-extrabold text-rose-600">Rp {{ number_format($s['remaining'], 0, ',', '.') }}</p>
                                </div>
                                <button type="button" onclick="openSettleModal({{ $index }})" class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/10 transition-colors duration-150 hover:bg-emerald-700">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                    Settle
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Table footer --}}
                <div class="flex items-center justify-between border-t border-gray-100 px-6 py-3.5">
                    <p class="text-sm text-gray-500">Showing <span class="font-semibold text-gray-700" id="visible-count">{{ count($pendingSettlements) }}</span> pending settlements</p>
                    <p class="text-sm font-semibold text-rose-600">Total: Rp {{ number_format($totalOutstanding, 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- Recently Settled (collapsible) --}}
            <div class="mt-6 rounded-2xl border border-gray-100 bg-white shadow-xs">
                <button type="button" onclick="toggleRecent()" class="flex w-full items-center justify-between px-6 py-4 text-left">
                    <div class="flex items-center gap-3">
                        <h2 class="text-base font-bold text-gray-900">Recently Settled</h2>
                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">{{ count($recentlySettled) }} today</span>
                    </div>
                    <svg id="recent-chevron" class="h-5 w-5 text-gray-400 transition-transform duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>

                <div id="recent-body" class="border-t border-gray-100">
                    <div class="divide-y divide-gray-50">
                        @foreach ($recentlySettled as $settled)
                            <div class="flex items-center gap-4 px-6 py-4">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                </span>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono text-xs font-semibold text-gray-500">{{ $settled['code'] }}</span>
                                        <span class="text-xs text-gray-300">•</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ $settled['customer'] }}</span>
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $settled['sport'] }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-emerald-600">Rp {{ number_format($settled['amount'], 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-400">Settled at {{ $settled['time'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

@endsection
