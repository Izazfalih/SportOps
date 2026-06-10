<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings Management | SportOps Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    @php
        $admin = ['name' => 'Admin SportOps', 'initials' => 'AS', 'email' => 'admin@sportops.id'];

        $sidebarNav = [
            ['label' => 'Dashboard',         'route' => 'admin.dashboard', 'icon' => '<rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/>'],
            ['label' => 'Courts Management', 'route' => 'admin.courts',    'icon' => '<rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 12h18"/><path d="M12 3v18"/>'],
            ['label' => 'Bookings',          'route' => 'admin.bookings',  'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/>'],
            ['label' => 'Users',             'route' => 'admin.users',     'icon' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
            ['label' => 'Financial Reports', 'route' => 'admin.reports',   'icon' => '<path d="M3 3v18h18"/><path d="M7 16l4-8 4 4 4-6"/>'],
            ['label' => 'Settings',          'route' => 'admin.settings',  'icon' => '<circle cx="12" cy="12" r="3"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>'],
        ];

        $activeRoute = 'admin.bookings';

        $statuses = ['All', 'Pending Payment', 'DP Paid', 'Fully Paid', 'Checked In', 'Completed', 'Cancelled'];
        $sports = ['All', 'Futsal', 'Badminton', 'Tennis', 'Basketball', 'Volleyball'];

        $summaryCards = [
            ['label' => 'Total Bookings',      'value' => 156, 'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',                         'color' => 'blue'],
            ['label' => 'Pending Payment',      'value' => 12,  'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',                                                    'color' => 'amber'],
            ['label' => 'Active Today',         'value' => 8,   'icon' => '<path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/>', 'color' => 'green'],
            ['label' => 'Completed This Month', 'value' => 89,  'icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/>',                                  'color' => 'indigo'],
        ];

        $cardColors = [
            'blue'   => ['bg' => 'bg-blue-50',   'text' => 'text-[#0047D4]',    'icon' => 'text-[#0047D4]'],
            'amber'  => ['bg' => 'bg-amber-50',   'text' => 'text-amber-700',    'icon' => 'text-amber-600'],
            'green'  => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700',  'icon' => 'text-emerald-600'],
            'indigo' => ['bg' => 'bg-indigo-50',  'text' => 'text-indigo-700',   'icon' => 'text-indigo-600'],
        ];

        $bookings = [
            ['code' => 'BK-20260610-001', 'customer' => 'Ahmad Fauzi',      'sport' => 'Futsal',      'date' => '10 Jun 2026', 'time' => '14:00-15:00', 'price' => 'Rp 150.000', 'payment' => 'Fully Paid',      'status' => 'Confirmed',       'phone' => '0812-3456-7890', 'court' => 'Lapangan Futsal A', 'dp' => 'Rp 75.000',  'remaining' => 'Rp 0'],
            ['code' => 'BK-20260610-002', 'customer' => 'Sarah Putri',      'sport' => 'Badminton',    'date' => '10 Jun 2026', 'time' => '16:00-17:00', 'price' => 'Rp 75.000',  'payment' => 'DP Paid',         'status' => 'DP Paid',         'phone' => '0813-2345-6789', 'court' => 'Lapangan Badminton 1', 'dp' => 'Rp 37.500',  'remaining' => 'Rp 37.500'],
            ['code' => 'BK-20260610-003', 'customer' => 'Budi Santoso',     'sport' => 'Futsal',      'date' => '10 Jun 2026', 'time' => '18:00-19:00', 'price' => 'Rp 200.000', 'payment' => 'Fully Paid',      'status' => 'Checked In',      'phone' => '0857-1234-5678', 'court' => 'Lapangan Futsal B (Premium)', 'dp' => 'Rp 100.000', 'remaining' => 'Rp 0'],
            ['code' => 'BK-20260610-004', 'customer' => 'Dewi Anggraini',   'sport' => 'Tennis',       'date' => '10 Jun 2026', 'time' => '08:00-09:00', 'price' => 'Rp 120.000', 'payment' => 'Fully Paid',      'status' => 'Completed',       'phone' => '0878-9012-3456', 'court' => 'Lapangan Tenis 1', 'dp' => 'Rp 60.000',  'remaining' => 'Rp 0'],
            ['code' => 'BK-20260610-005', 'customer' => 'Eko Prasetyo',     'sport' => 'Basketball',   'date' => '10 Jun 2026', 'time' => '19:00-20:00', 'price' => 'Rp 180.000', 'payment' => 'Pending',         'status' => 'Pending Payment', 'phone' => '0856-7890-1234', 'court' => 'Lapangan Basket Indoor', 'dp' => 'Rp 0',      'remaining' => 'Rp 180.000'],
            ['code' => 'BK-20260610-006', 'customer' => 'Fitria Handayani', 'sport' => 'Badminton',    'date' => '10 Jun 2026', 'time' => '10:00-11:00', 'price' => 'Rp 75.000',  'payment' => 'Fully Paid',      'status' => 'Completed',       'phone' => '0821-4567-8901', 'court' => 'Lapangan Badminton 2', 'dp' => 'Rp 37.500',  'remaining' => 'Rp 0'],
            ['code' => 'BK-20260609-007', 'customer' => 'Gunawan Wijaya',   'sport' => 'Volleyball',   'date' => '09 Jun 2026', 'time' => '15:00-16:00', 'price' => 'Rp 160.000', 'payment' => 'Fully Paid',      'status' => 'Completed',       'phone' => '0838-5678-9012', 'court' => 'Lapangan Voli Indoor', 'dp' => 'Rp 80.000',  'remaining' => 'Rp 0'],
            ['code' => 'BK-20260609-008', 'customer' => 'Hana Permata',     'sport' => 'Futsal',      'date' => '09 Jun 2026', 'time' => '20:00-21:00', 'price' => 'Rp 150.000', 'payment' => 'Fully Paid',      'status' => 'Cancelled',       'phone' => '0852-6789-0123', 'court' => 'Lapangan Futsal A', 'dp' => 'Rp 75.000',  'remaining' => 'Rp 75.000'],
            ['code' => 'BK-20260609-009', 'customer' => 'Irfan Hakim',      'sport' => 'Tennis',       'date' => '09 Jun 2026', 'time' => '07:00-08:00', 'price' => 'Rp 120.000', 'payment' => 'DP Paid',         'status' => 'DP Paid',         'phone' => '0819-7890-1234', 'court' => 'Lapangan Tenis 2', 'dp' => 'Rp 60.000',  'remaining' => 'Rp 60.000'],
            ['code' => 'BK-20260608-010', 'customer' => 'Jasmine Rahayu',   'sport' => 'Badminton',    'date' => '08 Jun 2026', 'time' => '13:00-14:00', 'price' => 'Rp 75.000',  'payment' => 'Fully Paid',      'status' => 'Completed',       'phone' => '0823-8901-2345', 'court' => 'Lapangan Badminton 3', 'dp' => 'Rp 37.500',  'remaining' => 'Rp 0'],
        ];

        $paymentBadge = [
            'Fully Paid' => 'bg-emerald-50 text-emerald-700',
            'DP Paid'    => 'bg-amber-50 text-amber-700',
            'Pending'    => 'bg-gray-100 text-gray-500',
        ];

        $statusBadge = [
            'Pending Payment' => 'bg-gray-100 text-gray-600',
            'DP Paid'         => 'bg-amber-50 text-amber-700',
            'Confirmed'       => 'bg-emerald-50 text-emerald-700',
            'Fully Paid'      => 'bg-emerald-50 text-emerald-700',
            'Checked In'      => 'bg-purple-50 text-purple-700',
            'Completed'       => 'bg-blue-50 text-[#0047D4]',
            'Cancelled'       => 'bg-rose-50 text-rose-600',
        ];
    @endphp

    <div class="flex h-full min-h-screen">

        {{-- ======================== SIDEBAR (Desktop) ======================== --}}
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col border-r border-gray-100 bg-white transition-transform duration-300 lg:translate-x-0">
            {{-- Brand --}}
            <div class="flex h-16 shrink-0 items-center gap-2.5 border-b border-gray-100 px-5">
                <div class="rounded-xl border border-gray-150 bg-white p-1.5 shadow-xs">
                    <img class="h-7 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                </div>
                <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
                <span class="ml-auto rounded-lg bg-[#0047D4]/10 px-2 py-0.5 text-[10px] font-bold text-[#0047D4]">ADMIN</span>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto px-3 py-4">
                <ul class="space-y-1">
                    @foreach ($sidebarNav as $item)
                        @php $isActive = $item['route'] === $activeRoute; @endphp
                        <li>
                            <a href="{{ route($item['route']) }}"
                               class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors duration-150
                                      {{ $isActive ? 'bg-[#0047D4] text-white shadow-lg shadow-blue-500/10' : 'text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]' }}">
                                <svg class="h-5 w-5 shrink-0 {{ $isActive ? 'text-white' : 'text-gray-400 group-hover:text-[#0047D4]' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $item['icon'] !!}</svg>
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            {{-- Bottom: admin info + logout --}}
            <div class="shrink-0 border-t border-gray-100 p-3">
                <div class="flex items-center gap-3 rounded-xl px-3 py-2">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $admin['initials'] }}</span>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-gray-900">{{ $admin['name'] }}</p>
                        <p class="truncate text-xs text-gray-400">{{ $admin['email'] }}</p>
                    </div>
                </div>
                <form method="POST" action="/logout" class="mt-1">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-500 hover:bg-rose-50 hover:text-rose-600 transition-colors duration-150">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Log Out
                    </button>
                </form>
            </div>
        </aside>

        {{-- Sidebar overlay (mobile) --}}
        <div id="sidebar-overlay" class="fixed inset-0 z-30 hidden bg-gray-900/50 backdrop-blur-sm lg:hidden" onclick="closeSidebar()"></div>

        {{-- ======================== MAIN CONTENT ======================== --}}
        <div class="flex flex-1 flex-col lg:pl-64">

            {{-- Top bar --}}
            <header class="sticky top-0 z-20 flex h-16 shrink-0 items-center gap-4 border-b border-gray-100 bg-white/80 px-4 backdrop-blur-md sm:px-6">
                <button type="button" onclick="openSidebar()" class="inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2 text-gray-500 shadow-xs lg:hidden" aria-label="Open sidebar">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
                </button>

                <nav class="hidden items-center gap-1.5 text-xs font-medium text-gray-400 sm:flex">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#0047D4] transition-colors">Admin</a>
                    <span>/</span>
                    <span class="text-gray-600">Bookings</span>
                </nav>

                <div class="ml-auto flex items-center gap-3">
                    <span class="hidden text-sm font-semibold text-gray-700 sm:inline">{{ $admin['name'] }}</span>
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $admin['initials'] }}</span>
                </div>
            </header>

            {{-- Page content --}}
            <main class="flex-1 overflow-y-auto px-4 py-6 sm:px-6 sm:py-8">

                {{-- -------- Page Header -------- --}}
                <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Bookings Management</h1>
                        <p class="mt-1 text-sm text-gray-500">View, filter, and manage all court bookings.</p>
                    </div>
                </div>

                {{-- -------- Filter Bar -------- --}}
                <div class="mt-6 rounded-2xl border border-gray-100 bg-white p-4 shadow-xs sm:p-5">
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">
                        {{-- Date From --}}
                        <div>
                            <label class="mb-1 block text-xs font-semibold text-gray-500">From</label>
                            <input type="date" value="2026-06-01" class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs outline-none focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/10 transition">
                        </div>
                        {{-- Date To --}}
                        <div>
                            <label class="mb-1 block text-xs font-semibold text-gray-500">To</label>
                            <input type="date" value="2026-06-10" class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs outline-none focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/10 transition">
                        </div>
                        {{-- Status --}}
                        <div>
                            <label class="mb-1 block text-xs font-semibold text-gray-500">Status</label>
                            <select class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs outline-none focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/10 transition">
                                @foreach ($statuses as $s)
                                    <option>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Sport --}}
                        <div>
                            <label class="mb-1 block text-xs font-semibold text-gray-500">Sport</label>
                            <select class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs outline-none focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/10 transition">
                                @foreach ($sports as $sp)
                                    <option>{{ $sp }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Search --}}
                        <div class="xl:col-span-1 sm:col-span-2 lg:col-span-1">
                            <label class="mb-1 block text-xs font-semibold text-gray-500">Search</label>
                            <div class="relative">
                                <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                <input type="text" placeholder="Name or code..." class="w-full rounded-xl border border-gray-200 bg-white py-2.5 pl-9 pr-3 text-sm text-gray-700 shadow-xs outline-none focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/10 transition">
                            </div>
                        </div>
                        {{-- Apply --}}
                        <div class="flex items-end sm:col-span-2 lg:col-span-5 xl:col-span-1">
                            <button type="button" class="w-full rounded-xl bg-[#0047D4] px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </div>

                {{-- -------- Summary Cards -------- --}}
                <div class="mt-5 grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4">
                    @foreach ($summaryCards as $card)
                        @php $c = $cardColors[$card['color']]; @endphp
                        <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs sm:p-5">
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $c['bg'] }}">
                                    <svg class="h-5 w-5 {{ $c['icon'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $card['icon'] !!}</svg>
                                </span>
                                <div class="min-w-0">
                                    <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl">{{ number_format($card['value']) }}</p>
                                    <p class="truncate text-xs font-medium text-gray-500">{{ $card['label'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- -------- Bookings Table (Desktop) -------- --}}
                <div class="mt-5 hidden overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xs lg:block">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[960px] border-collapse text-sm">
                            <thead>
                                <tr class="border-b border-gray-100 bg-gray-50/70 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    <th class="px-5 py-3.5">Booking Code</th>
                                    <th class="px-5 py-3.5">Customer Name</th>
                                    <th class="px-5 py-3.5">Sport</th>
                                    <th class="px-5 py-3.5">Date</th>
                                    <th class="px-5 py-3.5">Time</th>
                                    <th class="px-5 py-3.5">Total Price</th>
                                    <th class="px-5 py-3.5">Payment</th>
                                    <th class="px-5 py-3.5">Status</th>
                                    <th class="px-5 py-3.5 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $i => $b)
                                    <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50/60 transition-colors duration-150">
                                        <td class="px-5 py-4 font-mono text-xs font-semibold text-gray-500">{{ $b['code'] }}</td>
                                        <td class="px-5 py-4 font-semibold text-gray-900">{{ $b['customer'] }}</td>
                                        <td class="px-5 py-4 text-gray-600">{{ $b['sport'] }}</td>
                                        <td class="px-5 py-4 text-gray-500">{{ $b['date'] }}</td>
                                        <td class="px-5 py-4 text-gray-500">{{ $b['time'] }}</td>
                                        <td class="px-5 py-4 font-semibold text-gray-700">{{ $b['price'] }}</td>
                                        <td class="px-5 py-4"><span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $paymentBadge[$b['payment']] }}">{{ $b['payment'] }}</span></td>
                                        <td class="px-5 py-4"><span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusBadge[$b['status']] }}">{{ $b['status'] }}</span></td>
                                        <td class="px-5 py-4 text-right">
                                            <button type="button" onclick="openModal({{ $i }})" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- -------- Bookings Cards (Mobile / Tablet) -------- --}}
                <div class="mt-5 space-y-3 lg:hidden">
                    @foreach ($bookings as $i => $b)
                        <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-semibold text-gray-400">{{ $b['code'] }}</span>
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusBadge[$b['status']] }}">{{ $b['status'] }}</span>
                            </div>
                            <p class="mt-2 text-base font-bold text-gray-900">{{ $b['customer'] }}</p>
                            <p class="mt-0.5 text-sm text-gray-500">{{ $b['sport'] }} · {{ $b['court'] }}</p>
                            <div class="mt-2 flex items-center gap-3 text-xs text-gray-500">
                                <span>{{ $b['date'] }}</span>
                                <span>·</span>
                                <span>{{ $b['time'] }}</span>
                            </div>
                            <div class="mt-3 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-bold text-gray-900">{{ $b['price'] }}</span>
                                    <span class="inline-flex rounded-full px-2 py-0.5 text-[10px] font-semibold {{ $paymentBadge[$b['payment']] }}">{{ $b['payment'] }}</span>
                                </div>
                                <button type="button" onclick="openModal({{ $i }})" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">
                                    View
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- -------- Pagination -------- --}}
                <div class="mt-5 flex flex-col items-center justify-between gap-3 sm:flex-row">
                    <p class="text-sm text-gray-500">Showing <span class="font-semibold text-gray-700">1–10</span> of <span class="font-semibold text-gray-700">156</span> bookings</p>
                    <div class="flex items-center gap-1">
                        <button type="button" disabled class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-300 shadow-xs">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                        </button>
                        <button type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-[#0047D4] text-sm font-semibold text-white shadow-lg shadow-blue-500/10">1</button>
                        <button type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors">2</button>
                        <button type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors">3</button>
                        <span class="px-1 text-gray-400">…</span>
                        <button type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors">16</button>
                        <button type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </button>
                    </div>
                </div>

            </main>
        </div>
    </div>

    {{-- ======================== BOOKING DETAIL MODAL ======================== --}}
    <div id="booking-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900/50 backdrop-blur-sm p-4" role="dialog" aria-modal="true">
        <div class="relative w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-3xl border border-gray-100 bg-white shadow-2xl">
            {{-- Modal header --}}
            <div class="sticky top-0 z-10 flex items-center justify-between border-b border-gray-100 bg-white px-6 py-4 rounded-t-3xl">
                <h2 class="text-lg font-extrabold text-gray-900">Booking Details</h2>
                <button type="button" onclick="closeModal()" class="inline-flex h-8 w-8 items-center justify-center rounded-xl text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Modal body --}}
            <div class="px-6 py-5 space-y-5">
                {{-- Booking code + status --}}
                <div class="flex items-center justify-between">
                    <span id="modal-code" class="font-mono text-sm font-bold text-gray-900"></span>
                    <span id="modal-status-badge" class="inline-flex rounded-full px-3 py-1 text-xs font-semibold"></span>
                </div>

                {{-- Customer info --}}
                <div class="rounded-2xl bg-gray-50 p-4 space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Customer Information</h3>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-xs text-gray-400">Name</p>
                            <p id="modal-customer" class="font-semibold text-gray-900"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Phone</p>
                            <p id="modal-phone" class="font-semibold text-gray-900"></p>
                        </div>
                    </div>
                </div>

                {{-- Booking info --}}
                <div class="rounded-2xl bg-gray-50 p-4 space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Booking Information</h3>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-xs text-gray-400">Sport</p>
                            <p id="modal-sport" class="font-semibold text-gray-900"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Court</p>
                            <p id="modal-court" class="font-semibold text-gray-900"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Date</p>
                            <p id="modal-date" class="font-semibold text-gray-900"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Time</p>
                            <p id="modal-time" class="font-semibold text-gray-900"></p>
                        </div>
                    </div>
                </div>

                {{-- Payment breakdown --}}
                <div class="rounded-2xl bg-gray-50 p-4 space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Payment Breakdown</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Total Price</span>
                            <span id="modal-price" class="font-bold text-gray-900"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">DP Amount Paid</span>
                            <span id="modal-dp" class="font-semibold text-gray-700"></span>
                        </div>
                        <div class="flex justify-between border-t border-gray-200 pt-2">
                            <span class="font-semibold text-gray-700">Remaining Balance</span>
                            <span id="modal-remaining" class="font-bold text-gray-900"></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 pt-1">
                        <span class="text-xs text-gray-400">Payment Status:</span>
                        <span id="modal-payment-badge" class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold"></span>
                    </div>
                </div>

                {{-- Status Timeline --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Status Timeline</h3>
                    <div id="modal-timeline" class="mt-3 space-y-0"></div>
                </div>
            </div>

            {{-- Modal footer --}}
            <div class="sticky bottom-0 flex justify-end gap-2 border-t border-gray-100 bg-white px-6 py-4 rounded-b-3xl">
                <button type="button" onclick="closeModal()" class="rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-600 shadow-xs hover:bg-gray-50 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        // Sidebar mobile toggle
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.remove('hidden');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.add('hidden');
        }

        // Booking data for modal
        const bookings = @json($bookings);

        const paymentBadgeClasses = {
            'Fully Paid': 'bg-emerald-50 text-emerald-700',
            'DP Paid': 'bg-amber-50 text-amber-700',
            'Pending': 'bg-gray-100 text-gray-500',
        };

        const statusBadgeClasses = {
            'Pending Payment': 'bg-gray-100 text-gray-600',
            'DP Paid': 'bg-amber-50 text-amber-700',
            'Confirmed': 'bg-emerald-50 text-emerald-700',
            'Fully Paid': 'bg-emerald-50 text-emerald-700',
            'Checked In': 'bg-purple-50 text-purple-700',
            'Completed': 'bg-blue-50 text-blue-700',
            'Cancelled': 'bg-rose-50 text-rose-600',
        };

        const timelineByStatus = {
            'Pending Payment': [
                { label: 'Booking Created', time: '10 Jun 2026, 09:15', active: true },
            ],
            'DP Paid': [
                { label: 'Booking Created', time: '10 Jun 2026, 09:15', active: true },
                { label: 'DP Payment Received', time: '10 Jun 2026, 09:22', active: true },
            ],
            'Confirmed': [
                { label: 'Booking Created', time: '10 Jun 2026, 08:30', active: true },
                { label: 'DP Payment Received', time: '10 Jun 2026, 08:35', active: true },
                { label: 'Full Payment Confirmed', time: '10 Jun 2026, 10:00', active: true },
                { label: 'Booking Confirmed', time: '10 Jun 2026, 10:01', active: true },
            ],
            'Checked In': [
                { label: 'Booking Created', time: '10 Jun 2026, 07:00', active: true },
                { label: 'Full Payment Confirmed', time: '10 Jun 2026, 07:10', active: true },
                { label: 'Booking Confirmed', time: '10 Jun 2026, 07:11', active: true },
                { label: 'Customer Checked In', time: '10 Jun 2026, 17:55', active: true },
            ],
            'Completed': [
                { label: 'Booking Created', time: '09 Jun 2026, 08:00', active: true },
                { label: 'Full Payment Confirmed', time: '09 Jun 2026, 08:15', active: true },
                { label: 'Booking Confirmed', time: '09 Jun 2026, 08:16', active: true },
                { label: 'Customer Checked In', time: '09 Jun 2026, 14:50', active: true },
                { label: 'Session Completed', time: '09 Jun 2026, 16:00', active: true },
            ],
            'Cancelled': [
                { label: 'Booking Created', time: '09 Jun 2026, 12:00', active: true },
                { label: 'DP Payment Received', time: '09 Jun 2026, 12:10', active: true },
                { label: 'Booking Cancelled', time: '09 Jun 2026, 18:30', active: true },
            ],
            'Fully Paid': [
                { label: 'Booking Created', time: '10 Jun 2026, 08:30', active: true },
                { label: 'Full Payment Confirmed', time: '10 Jun 2026, 08:45', active: true },
            ],
        };

        function openModal(index) {
            const b = bookings[index];
            const modal = document.getElementById('booking-modal');

            document.getElementById('modal-code').textContent = b.code;
            document.getElementById('modal-customer').textContent = b.customer;
            document.getElementById('modal-phone').textContent = b.phone;
            document.getElementById('modal-sport').textContent = b.sport;
            document.getElementById('modal-court').textContent = b.court;
            document.getElementById('modal-date').textContent = b.date;
            document.getElementById('modal-time').textContent = b.time;
            document.getElementById('modal-price').textContent = b.price;
            document.getElementById('modal-dp').textContent = b.dp;
            document.getElementById('modal-remaining').textContent = b.remaining;

            const statusBadge = document.getElementById('modal-status-badge');
            statusBadge.textContent = b.status;
            statusBadge.className = 'inline-flex rounded-full px-3 py-1 text-xs font-semibold ' + (statusBadgeClasses[b.status] || 'bg-gray-100 text-gray-600');

            const paymentBadge = document.getElementById('modal-payment-badge');
            paymentBadge.textContent = b.payment;
            paymentBadge.className = 'inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold ' + (paymentBadgeClasses[b.payment] || 'bg-gray-100 text-gray-500');

            // Build timeline
            const timelineEl = document.getElementById('modal-timeline');
            const steps = timelineByStatus[b.status] || timelineByStatus['Pending Payment'];
            timelineEl.innerHTML = steps.map((step, i) => {
                const isLast = i === steps.length - 1;
                return '<div class="relative flex gap-3 ' + (isLast ? '' : 'pb-5') + '">' +
                    (!isLast ? '<div class="absolute left-[7px] top-4 bottom-0 w-px bg-gray-200"></div>' : '') +
                    '<div class="relative mt-1 flex h-4 w-4 shrink-0 items-center justify-center">' +
                        '<span class="h-3 w-3 rounded-full ' + (isLast ? 'bg-[#0047D4] ring-4 ring-blue-50' : 'bg-gray-300') + '"></span>' +
                    '</div>' +
                    '<div>' +
                        '<p class="text-sm font-semibold text-gray-900">' + step.label + '</p>' +
                        '<p class="text-xs text-gray-400">' + step.time + '</p>' +
                    '</div>' +
                '</div>';
            }).join('');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('booking-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        // Close modal on backdrop click
        document.getElementById('booking-modal').addEventListener('click', function (e) {
            if (e.target === this) closeModal();
        });

        // Close modal on Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>
</body>
</html>
