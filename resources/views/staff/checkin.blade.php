<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-In Management | SportOps</title>
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
            ['label' => 'Dashboard',        'route' => 'staff.dashboard',        'active' => false, 'icon' => '<rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/>'],
            ['label' => "Today's Schedule",  'route' => 'staff.schedule',         'active' => false, 'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01M16 18h.01"/>'],
            ['label' => 'Check-In',          'route' => 'staff.checkin',          'active' => true,  'icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>'],
            ['label' => 'Offline Booking',   'route' => 'staff.offline-booking',  'active' => false, 'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
            ['label' => 'Settlement',        'route' => 'staff.settlement',       'active' => false, 'icon' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>'],
        ];

        $pendingCheckins = [
            [
                'code'        => 'BK-20260610-002',
                'customer'    => 'Sarah Putri',
                'sport'       => 'Badminton',
                'court'       => 'Court B1',
                'date'        => '10 Jun 2026',
                'time'        => '11:00 – 12:00',
                'payment'     => 'DP Paid',
                'payColor'    => 'bg-amber-50 text-amber-700',
                'totalPrice'  => 200000,
                'paidAmount'  => 100000,
                'remaining'   => 100000,
                'warning'     => null,
            ],
            [
                'code'        => 'BK-20260610-003',
                'customer'    => 'Ahmad Fauzi',
                'sport'       => 'Basketball',
                'court'       => 'Court K1',
                'date'        => '10 Jun 2026',
                'time'        => '13:00 – 14:00',
                'payment'     => 'Fully Paid',
                'payColor'    => 'bg-emerald-50 text-emerald-700',
                'totalPrice'  => 300000,
                'paidAmount'  => 300000,
                'remaining'   => 0,
                'warning'     => null,
            ],
            [
                'code'        => 'BK-20260610-004',
                'customer'    => 'Dimas Pratama',
                'sport'       => 'Tennis',
                'court'       => 'Court T1',
                'date'        => '10 Jun 2026',
                'time'        => '14:00 – 15:00',
                'payment'     => 'Fully Paid',
                'payColor'    => 'bg-emerald-50 text-emerald-700',
                'totalPrice'  => 250000,
                'paidAmount'  => 250000,
                'remaining'   => 0,
                'warning'     => 'Court under maintenance — please reassign or inform customer',
            ],
            [
                'code'        => 'BK-20260610-005',
                'customer'    => 'Rina Wijaya',
                'sport'       => 'Futsal',
                'court'       => 'Court F2',
                'date'        => '10 Jun 2026',
                'time'        => '15:00 – 16:00',
                'payment'     => 'Fully Paid',
                'payColor'    => 'bg-emerald-50 text-emerald-700',
                'totalPrice'  => 350000,
                'paidAmount'  => 350000,
                'remaining'   => 0,
                'warning'     => null,
            ],
            [
                'code'        => 'BK-20260610-006',
                'customer'    => 'Fajar Hidayat',
                'sport'       => 'Volleyball',
                'court'       => 'Court V1',
                'date'        => '10 Jun 2026',
                'time'        => '16:00 – 17:00',
                'payment'     => 'DP Paid',
                'payColor'    => 'bg-amber-50 text-amber-700',
                'totalPrice'  => 280000,
                'paidAmount'  => 140000,
                'remaining'   => 140000,
                'warning'     => null,
            ],
        ];

        $checkedIn = [
            [
                'code'      => 'BK-20260610-001',
                'customer'  => 'Budi Santoso',
                'sport'     => 'Futsal',
                'court'     => 'Court F1',
                'time'      => '10:00 – 11:00',
                'checkedAt' => '09:55',
            ],
            [
                'code'      => 'BK-20260610-007',
                'customer'  => 'Riko Aditya',
                'sport'     => 'Futsal',
                'court'     => 'Court F3',
                'time'      => '08:00 – 09:00',
                'checkedAt' => '07:58',
            ],
            [
                'code'      => 'BK-20260610-008',
                'customer'  => 'Yoga Permana',
                'sport'     => 'Badminton',
                'court'     => 'Court B2',
                'time'      => '09:00 – 10:00',
                'checkedAt' => '08:52',
            ],
        ];
    @endphp

    {{-- Mobile sidebar overlay --}}
    <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm transition-opacity duration-300 lg:hidden hidden" onclick="closeSidebar()"></div>

    {{-- Sidebar --}}
    <aside id="sidebar" class="fixed left-0 top-0 z-50 flex h-full w-[280px] -translate-x-full flex-col border-r border-gray-100 bg-white transition-transform duration-300 ease-in-out lg:translate-x-0">
        {{-- Brand --}}
        <div class="flex items-center gap-3 border-b border-gray-100 px-6 py-5">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#0047D4] to-indigo-600 shadow-lg shadow-blue-500/20">
                <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            </div>
            <div>
                <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
                <p class="text-[11px] font-medium text-gray-400">Staff Panel</p>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto px-4 py-4">
            <p class="mb-2 px-3 text-[11px] font-bold uppercase tracking-widest text-gray-400">Menu</p>
            <div class="space-y-1">
                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}"
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

        {{-- Sidebar footer --}}
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
                        <h1 class="text-xl font-extrabold tracking-tight text-gray-900 sm:text-2xl">Check-In Management</h1>
                        <p class="text-sm text-gray-500">Manage today's court check-ins</p>
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

            {{-- Search section --}}
            <div class="mx-auto max-w-2xl">
                <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-lg shadow-blue-500/10 sm:p-8">
                    <div class="text-center mb-5">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50">
                            <svg class="h-6 w-6 text-[#0047D4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900">Quick Check-In</h2>
                        <p class="mt-1 text-sm text-gray-500">Search by booking code or customer name to check in</p>
                    </div>
                    <form class="flex flex-col gap-3 sm:flex-row">
                        <div class="relative flex-1">
                            <svg class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            <input type="text" placeholder="Enter booking code or customer name..." class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3.5 pl-12 pr-4 text-sm font-medium text-gray-900 placeholder-gray-400 outline-none transition-all duration-150 focus:border-[#0047D4] focus:bg-white focus:ring-2 focus:ring-blue-100">
                        </div>
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0047D4] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 transition-colors duration-150 hover:bg-[#003cb5]">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            Search
                        </button>
                    </form>
                </div>
            </div>

            {{-- Pending Check-In section --}}
            <div class="mt-8">
                <div class="mb-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-bold text-gray-900">Pending Check-In</h2>
                        <span class="inline-flex items-center justify-center rounded-full bg-[#0047D4] px-2.5 py-0.5 text-xs font-bold text-white">{{ count($pendingCheckins) }}</span>
                    </div>
                    <p class="text-sm text-gray-500">Today, {{ date('d M Y') }}</p>
                </div>

                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 xl:grid-cols-3">
                    @foreach ($pendingCheckins as $index => $booking)
                        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                            {{-- Warning banner --}}
                            @if ($booking['warning'])
                                <div class="mb-4 flex items-start gap-2 rounded-xl bg-rose-50 px-3 py-2.5">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    <p class="text-xs font-medium text-rose-700">{{ $booking['warning'] }}</p>
                                </div>
                            @endif

                            {{-- Header --}}
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-xs font-semibold text-[#0047D4]">{{ $booking['code'] }}</p>
                                    <p class="mt-1 text-base font-bold text-gray-900">{{ $booking['customer'] }}</p>
                                </div>
                                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $booking['payColor'] }}">{{ $booking['payment'] }}</span>
                            </div>

                            {{-- Details --}}
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6M9 9l6 6"/></svg>
                                    <span>{{ $booking['sport'] }} — {{ $booking['court'] }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    <span>{{ $booking['date'] }}, {{ $booking['time'] }}</span>
                                </div>
                            </div>

                            {{-- Action --}}
                            <div class="mt-5">
                                <button type="button"
                                        onclick="openCheckinModal({{ json_encode($booking) }})"
                                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/10 transition-colors duration-150 hover:bg-emerald-600">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                    Check In
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Already Checked In section (collapsible) --}}
            <div class="mt-8">
                <button type="button" onclick="toggleCheckedIn()" class="mb-4 flex items-center gap-3 group">
                    <h2 class="text-lg font-bold text-gray-900 group-hover:text-[#0047D4] transition-colors duration-150">Already Checked In</h2>
                    <span class="inline-flex items-center justify-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-bold text-emerald-700">{{ count($checkedIn) }}</span>
                    <svg id="checkedin-chevron" class="h-5 w-5 text-gray-400 transition-transform duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>

                <div id="checkedin-content" class="hidden">
                    <div class="rounded-2xl border border-gray-100 bg-white shadow-xs">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead>
                                    <tr class="border-b border-gray-100 text-xs font-bold uppercase tracking-wider text-gray-400">
                                        <th class="px-6 py-3.5">Booking Code</th>
                                        <th class="px-6 py-3.5">Customer</th>
                                        <th class="px-6 py-3.5">Court</th>
                                        <th class="px-6 py-3.5">Time</th>
                                        <th class="px-6 py-3.5">Checked In At</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach ($checkedIn as $entry)
                                        <tr class="transition-colors duration-100 hover:bg-gray-50/50">
                                            <td class="px-6 py-4">
                                                <span class="text-sm font-semibold text-[#0047D4]">{{ $entry['code'] }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-xs font-bold text-emerald-700">{{ collect(explode(' ', $entry['customer']))->map(fn($w) => mb_substr($w, 0, 1))->join('') }}</span>
                                                    <span class="font-semibold text-gray-900">{{ $entry['customer'] }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-gray-600">{{ $entry['sport'] }} — {{ $entry['court'] }}</td>
                                            <td class="px-6 py-4 text-gray-600">{{ $entry['time'] }}</td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                                    {{ $entry['checkedAt'] }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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

    {{-- Check-In Confirmation Modal --}}
    <div id="checkin-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-gray-900/50 backdrop-blur-sm p-4">
        <div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl sm:p-8" onclick="event.stopPropagation()">
            {{-- Modal header --}}
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg font-bold text-gray-900">Confirm Check-In</h3>
                <button type="button" onclick="closeCheckinModal()" class="flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors duration-150 hover:bg-gray-100 hover:text-gray-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            {{-- Booking details --}}
            <div class="rounded-2xl bg-gray-50 p-4 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">Booking Code</span>
                    <span id="modal-code" class="text-sm font-bold text-[#0047D4]"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">Customer</span>
                    <span id="modal-customer" class="text-sm font-semibold text-gray-900"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">Court</span>
                    <span id="modal-court" class="text-sm font-medium text-gray-700"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">Time</span>
                    <span id="modal-time" class="text-sm font-medium text-gray-700"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">Payment</span>
                    <span id="modal-payment" class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold"></span>
                </div>
            </div>

            {{-- DP Warning --}}
            <div id="modal-dp-warning" class="mt-4 hidden rounded-xl border border-amber-200 bg-amber-50 p-4">
                <div class="flex items-start gap-3">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    <div>
                        <p class="text-sm font-semibold text-amber-800">Remaining Balance</p>
                        <p class="mt-0.5 text-sm text-amber-700">Customer has remaining balance of <span id="modal-remaining" class="font-bold"></span></p>
                        <a href="{{ route('staff.settlement') }}" id="modal-settlement-link" class="mt-2 inline-flex items-center gap-1 text-sm font-semibold text-amber-700 underline decoration-amber-300 underline-offset-2 hover:text-amber-800">
                            Go to Settlement
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="mt-6 flex items-center gap-3">
                <button type="button" onclick="closeCheckinModal()" class="flex-1 rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-semibold text-gray-700 transition-colors duration-150 hover:bg-gray-50">
                    Cancel
                </button>
                <button type="button" onclick="confirmCheckin()" class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-500 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-500/10 transition-colors duration-150 hover:bg-emerald-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Confirm Check-In
                </button>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.remove('hidden');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.add('hidden');
        }

        function toggleCheckedIn() {
            const content = document.getElementById('checkedin-content');
            const chevron = document.getElementById('checkedin-chevron');
            content.classList.toggle('hidden');
            chevron.classList.toggle('rotate-180');
        }

        function openCheckinModal(booking) {
            const modal = document.getElementById('checkin-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('modal-code').textContent = booking.code;
            document.getElementById('modal-customer').textContent = booking.customer;
            document.getElementById('modal-court').textContent = booking.sport + ' — ' + booking.court;
            document.getElementById('modal-time').textContent = booking.date + ', ' + booking.time;

            const paymentEl = document.getElementById('modal-payment');
            paymentEl.textContent = booking.payment;
            paymentEl.className = 'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ' + booking.payColor;

            const dpWarning = document.getElementById('modal-dp-warning');
            if (booking.remaining > 0) {
                dpWarning.classList.remove('hidden');
                document.getElementById('modal-remaining').textContent = 'Rp ' + booking.remaining.toLocaleString('id-ID');
            } else {
                dpWarning.classList.add('hidden');
            }
        }

        function closeCheckinModal() {
            const modal = document.getElementById('checkin-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function confirmCheckin() {
            closeCheckinModal();
            // In production, this would submit to the server
        }

        // Close modal on backdrop click
        document.getElementById('checkin-modal').addEventListener('click', function(e) {
            if (e.target === this) closeCheckinModal();
        });
    </script>
</body>
</html>
