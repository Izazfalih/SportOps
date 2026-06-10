<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Settlement | SportOps</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    @php
        $staff = [
            'name'     => 'Staff Operasional',
            'initials' => 'SO',
            'email'    => 'staff@sportops.id',
        ];

        $navItems = [
            ['label' => 'Dashboard',        'href' => route('staff.dashboard'),        'active' => false, 'icon' => '<rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/>'],
            ['label' => "Today's Schedule",  'href' => route('staff.schedule'),         'active' => false, 'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01M16 18h.01"/>'],
            ['label' => 'Check-In',          'href' => route('staff.checkin'),          'active' => false, 'icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>'],
            ['label' => 'Offline Booking',   'href' => route('staff.offline-booking'),  'active' => false, 'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="M12 10v4l2 2"/>'],
            ['label' => 'Settlement',        'href' => route('staff.settlement'),       'active' => true,  'icon' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>'],
        ];

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

    {{-- Mobile sidebar overlay --}}
    <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm transition-opacity duration-300 lg:hidden hidden" onclick="closeSidebar()"></div>

    {{-- Sidebar --}}
    <aside id="sidebar" class="fixed left-0 top-0 z-50 flex h-full w-[280px] -translate-x-full flex-col border-r border-gray-100 bg-white transition-transform duration-300 ease-in-out lg:translate-x-0">
        <div class="flex items-center gap-3 border-b border-gray-100 px-6 py-5">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#0047D4] to-indigo-600 shadow-lg shadow-blue-500/20">
                <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            </div>
            <div>
                <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
                <p class="text-[11px] font-medium text-gray-400">Staff Panel</p>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto px-4 py-4">
            <p class="mb-2 px-3 text-[11px] font-bold uppercase tracking-widest text-gray-400">Menu</p>
            <div class="space-y-1">
                @foreach ($navItems as $item)
                    <a href="{{ $item['href'] }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-colors duration-150
                              {{ $item['active']
                                  ? 'bg-blue-50 font-semibold text-[#0047D4]'
                                  : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]' }}">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg {{ $item['active'] ? 'bg-[#0047D4] text-white shadow-lg shadow-blue-500/20' : 'bg-gray-50 text-gray-500' }}">
                            <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $item['icon'] !!}</svg>
                        </span>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </nav>

        <div class="border-t border-gray-100 px-4 py-4">
            <div class="mb-3 flex items-center gap-3 rounded-xl bg-gray-50 px-3 py-2.5">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $staff['initials'] }}</span>
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-gray-900">{{ $staff['name'] }}</p>
                    <p class="truncate text-xs text-gray-500">{{ $staff['email'] }}</p>
                </div>
            </div>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 transition-colors duration-150 hover:bg-rose-50 hover:text-rose-600">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-gray-50 text-gray-500">
                        <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    </span>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="min-h-full transition-all duration-300 lg:ml-[280px]">

        {{-- Top header bar --}}
        <header class="sticky top-0 z-30 border-b border-gray-100 bg-white/80 backdrop-blur-md">
            <div class="flex items-center justify-between px-4 py-3.5 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3">
                    <button type="button" onclick="openSidebar()" class="inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs lg:hidden" aria-label="Open sidebar">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
                    </button>
                    <div>
                        <h1 class="text-xl font-extrabold tracking-tight text-gray-900 sm:text-2xl">Payment Settlement</h1>
                        <p class="text-sm text-gray-500">Process remaining payments for DP bookings</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2.5 rounded-xl border border-gray-150 bg-white p-1 pr-3 shadow-xs">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $staff['initials'] }}</span>
                        <span class="hidden text-sm font-semibold text-gray-700 sm:inline">{{ $staff['name'] }}</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Page content --}}
        <main class="px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

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

        </main>

        {{-- Footer --}}
        <footer class="mt-4 border-t border-gray-100 bg-white">
            <div class="flex flex-col items-center justify-between gap-3 px-4 py-6 sm:flex-row sm:px-6 lg:px-8">
                <p class="text-sm text-gray-400">&copy; {{ date('Y') }} SportOps. All rights reserved.</p>
                <div class="flex items-center gap-5 text-sm text-gray-400">
                    <a href="#" class="hover:text-[#0047D4] transition-colors duration-150">Help Center</a>
                    <a href="#" class="hover:text-[#0047D4] transition-colors duration-150">Privacy</a>
                    <a href="#" class="hover:text-[#0047D4] transition-colors duration-150">Terms</a>
                </div>
            </div>
        </footer>
    </div>

    {{-- Settlement Modal --}}
    <div id="settle-modal" class="fixed inset-0 z-[60] flex items-center justify-center bg-gray-900/50 backdrop-blur-sm transition-opacity duration-300 hidden" onclick="if(event.target===this)closeSettleModal()">
        <div class="relative mx-4 w-full max-w-lg rounded-3xl border border-gray-100 bg-white p-0 shadow-lg shadow-blue-500/10 transition-transform duration-300 scale-95" id="settle-modal-content">
            {{-- Modal header --}}
            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                <h3 class="text-lg font-bold text-gray-900">Settle Payment</h3>
                <button type="button" onclick="closeSettleModal()" class="flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>

            {{-- Modal body --}}
            <div class="px-6 py-5">
                {{-- Booking summary --}}
                <div class="rounded-xl bg-gray-50 p-4">
                    <div class="flex items-center gap-3">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#0047D4] text-xs font-bold text-white" id="modal-initials"></span>
                        <div>
                            <p class="font-semibold text-gray-900" id="modal-customer"></p>
                            <p class="text-sm text-gray-500" id="modal-booking-info"></p>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center gap-2 text-sm text-gray-500">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        <span id="modal-datetime"></span>
                    </div>
                </div>

                {{-- Payment breakdown --}}
                <div class="mt-5 space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Total Price</span>
                        <span class="font-semibold text-gray-900" id="modal-total"></span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">DP Paid</span>
                        <span class="font-semibold text-emerald-600" id="modal-dp"></span>
                    </div>
                    <div class="h-px bg-gray-100"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-gray-900">Remaining Balance</span>
                        <span class="text-xl font-extrabold text-rose-600" id="modal-remaining"></span>
                    </div>
                </div>

                {{-- Payment method --}}
                <div class="mt-5">
                    <p class="text-sm font-semibold text-gray-700">Payment Method</p>
                    <div class="mt-2 flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-xl bg-[#0047D4]/5 border border-[#0047D4]/20 px-3 py-2 text-sm font-semibold text-[#0047D4]">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="5" height="5" x="3" y="3" rx="0.5"/><rect width="5" height="5" x="16" y="3" rx="0.5"/><rect width="5" height="5" x="3" y="16" rx="0.5"/><rect width="3" height="3" x="17" y="17" rx="0.5"/><path d="M10 5h2M5 10v2M10 19h2M19 10v2"/></svg>
                            QRIS
                        </span>
                    </div>
                </div>

                {{-- QRIS placeholder --}}
                <div class="mt-5 flex flex-col items-center rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 p-6">
                    <div class="flex h-36 w-36 items-center justify-center rounded-2xl bg-white shadow-xs">
                        <svg class="h-24 w-24 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="5" height="5" x="3" y="3" rx="0.5"/>
                            <rect width="5" height="5" x="16" y="3" rx="0.5"/>
                            <rect width="5" height="5" x="3" y="16" rx="0.5"/>
                            <rect width="3" height="3" x="17" y="17" rx="0.5"/>
                            <rect width="1" height="1" x="10" y="5"/>
                            <rect width="1" height="1" x="13" y="5"/>
                            <rect width="1" height="1" x="5" y="10"/>
                            <rect width="1" height="1" x="5" y="13"/>
                            <rect width="1" height="1" x="10" y="10"/>
                            <rect width="1" height="1" x="13" y="10"/>
                            <rect width="1" height="1" x="10" y="13"/>
                            <rect width="1" height="1" x="13" y="13"/>
                            <rect width="1" height="1" x="19" y="10"/>
                            <rect width="1" height="1" x="19" y="13"/>
                            <rect width="1" height="1" x="10" y="19"/>
                            <rect width="1" height="1" x="13" y="17"/>
                        </svg>
                    </div>
                    <p class="mt-3 text-sm font-medium text-gray-500">Scan QRIS to pay</p>
                    <p class="mt-1 text-xs text-gray-400">Show this code to the customer</p>
                </div>
            </div>

            {{-- Modal footer --}}
            <div class="flex items-center gap-3 border-t border-gray-100 px-6 py-4">
                <button type="button" onclick="closeSettleModal()" class="flex-1 rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-semibold text-gray-700 transition-colors duration-150 hover:bg-gray-50">
                    Cancel
                </button>
                <button type="button" onclick="confirmPayment()" class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-500/10 transition-colors duration-150 hover:bg-emerald-700">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Confirm Payment Received
                </button>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.remove('hidden');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.add('hidden');
        }

        // Settlement data for modal
        const settlements = @json($pendingSettlements);

        function formatRupiah(num) {
            return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function openSettleModal(index) {
            const s = settlements[index];
            const initials = s.customer.split(' ').map(w => w[0]).join('');

            document.getElementById('modal-initials').textContent = initials;
            document.getElementById('modal-customer').textContent = s.customer;
            document.getElementById('modal-booking-info').textContent = s.code + ' • ' + s.court + ' (' + s.sport + ')';
            document.getElementById('modal-datetime').textContent = s.date + ', ' + s.time;
            document.getElementById('modal-total').textContent = formatRupiah(s.total);
            document.getElementById('modal-dp').textContent = '- ' + formatRupiah(s.dp);
            document.getElementById('modal-remaining').textContent = formatRupiah(s.remaining);

            const modal = document.getElementById('settle-modal');
            const content = document.getElementById('settle-modal-content');
            modal.classList.remove('hidden');
            requestAnimationFrame(() => {
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            });
        }

        function closeSettleModal() {
            const modal = document.getElementById('settle-modal');
            const content = document.getElementById('settle-modal-content');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 200);
        }

        function confirmPayment() {
            alert('Payment confirmed! In production, this would update the booking status via API.');
            closeSettleModal();
        }

        // Recently settled toggle
        function toggleRecent() {
            const body = document.getElementById('recent-body');
            const chevron = document.getElementById('recent-chevron');
            body.classList.toggle('hidden');
            chevron.classList.toggle('rotate-180');
        }

        // Search filter
        document.getElementById('search-input').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('.settlement-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const searchText = row.getAttribute('data-search');
                const match = !query || searchText.includes(query);
                row.style.display = match ? '' : 'none';
                if (match) visibleCount++;
            });

            // Count is doubled because both table rows and mobile cards exist
            document.getElementById('visible-count').textContent = Math.ceil(visibleCount / 2);
        });
    </script>
</body>
</html>
