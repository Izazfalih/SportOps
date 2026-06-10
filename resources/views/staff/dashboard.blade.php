<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard | SportOps</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    @php
        $staff = [
            'name'     => 'Pak Joko',
            'initials' => 'PJ',
            'role'     => 'Field Keeper',
        ];

        $kpis = [
            ['label' => "Today's Bookings", 'value' => 8, 'color' => 'blue',  'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
            ['label' => 'Checked In',       'value' => 3, 'color' => 'green', 'icon' => '<path d="M20 6 9 17l-5-5"/>'],
            ['label' => 'Pending Check-In',  'value' => 4, 'color' => 'amber', 'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>'],
            ['label' => 'Pending Settlement','value' => 2, 'color' => 'rose',  'icon' => '<rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/>'],
        ];

        $kpiStyles = [
            'blue'  => ['bg' => 'bg-blue-50',  'text' => 'text-[#0047D4]', 'icon_bg' => 'bg-blue-100'],
            'green' => ['bg' => 'bg-emerald-50','text' => 'text-emerald-600','icon_bg' => 'bg-emerald-100'],
            'amber' => ['bg' => 'bg-amber-50',  'text' => 'text-amber-600', 'icon_bg' => 'bg-amber-100'],
            'rose'  => ['bg' => 'bg-rose-50',   'text' => 'text-rose-600',  'icon_bg' => 'bg-rose-100'],
        ];

        $schedule = [
            ['time' => '10:00 – 11:00', 'customer' => 'Budi Santoso',  'sport' => 'Futsal',     'payment' => 'Fully Paid',  'payment_color' => 'emerald', 'status' => 'Checked In', 'status_color' => 'emerald'],
            ['time' => '11:00 – 12:00', 'customer' => 'Sarah Putri',   'sport' => 'Badminton',  'payment' => 'DP Paid',     'payment_color' => 'amber',   'status' => 'Booked',     'status_color' => 'amber'],
            ['time' => '13:00 – 14:00', 'customer' => 'Ahmad Fauzi',   'sport' => 'Basketball', 'payment' => 'Fully Paid',  'payment_color' => 'emerald', 'status' => 'Booked',     'status_color' => 'blue'],
            ['time' => '14:00 – 15:00', 'customer' => 'Dimas Pratama', 'sport' => 'Tennis',     'payment' => 'Pending',     'payment_color' => 'gray',    'status' => 'Booked',     'status_color' => 'gray'],
            ['time' => '15:00 – 16:00', 'customer' => 'Rina Wijaya',   'sport' => 'Futsal',     'payment' => 'Fully Paid',  'payment_color' => 'emerald', 'status' => 'Booked',     'status_color' => 'blue'],
        ];

        $badgeStyles = [
            'emerald' => 'bg-emerald-50 text-emerald-700',
            'amber'   => 'bg-amber-50 text-amber-700',
            'blue'    => 'bg-blue-50 text-[#0047D4]',
            'gray'    => 'bg-gray-100 text-gray-600',
            'rose'    => 'bg-rose-50 text-rose-700',
        ];

        $courts = [
            ['name' => 'Futsal Court',     'status' => 'In Use',      'color' => 'emerald'],
            ['name' => 'Badminton Court',   'status' => 'Available',   'color' => 'blue'],
            ['name' => 'Tennis Court',      'status' => 'Maintenance', 'color' => 'rose'],
            ['name' => 'Basketball Court',  'status' => 'Booked Next', 'color' => 'amber'],
            ['name' => 'Volleyball Court',  'status' => 'Available',   'color' => 'blue'],
        ];

        $courtDot = [
            'emerald' => 'bg-emerald-500',
            'blue'    => 'bg-blue-500',
            'rose'    => 'bg-rose-500',
            'amber'   => 'bg-amber-500',
        ];

        $courtBadge = [
            'emerald' => 'bg-emerald-50 text-emerald-700',
            'blue'    => 'bg-blue-50 text-[#0047D4]',
            'rose'    => 'bg-rose-50 text-rose-700',
            'amber'   => 'bg-amber-50 text-amber-700',
        ];

        $navItems = [
            ['label' => 'Dashboard',        'route' => 'staff.dashboard',        'active' => true,  'icon' => '<rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/>'],
            ['label' => "Today's Schedule",  'route' => 'staff.schedule',         'active' => false, 'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
            ['label' => 'Check-In',          'route' => 'staff.checkin',          'active' => false, 'icon' => '<path d="M20 6 9 17l-5-5"/>'],
            ['label' => 'Offline Booking',   'route' => 'staff.offline-booking',  'active' => false, 'icon' => '<path d="M5 12h14M12 5v14"/>'],
            ['label' => 'Settlement',        'route' => 'staff.settlement',       'active' => false, 'icon' => '<rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/>'],
        ];
    @endphp

    {{-- ==================== MOBILE SIDEBAR OVERLAY ==================== --}}
    <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm transition-opacity duration-300 opacity-0 pointer-events-none lg:hidden" onclick="closeSidebar()"></div>

    {{-- ==================== SIDEBAR ==================== --}}
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 flex w-[280px] flex-col bg-white border-r border-gray-100 shadow-lg shadow-gray-200/50 transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 lg:shadow-xs">

        {{-- Brand --}}
        <div class="flex items-center gap-3 border-b border-gray-100 px-6 py-5">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#0047D4] to-indigo-600 shadow-lg shadow-blue-500/20">
                <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m8 12 3 3 5-6"/></svg>
            </div>
            <div>
                <p class="text-base font-extrabold tracking-tight text-gray-900">SportOps</p>
                <p class="text-xs font-medium text-gray-400">Staff Panel</p>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto px-4 py-5">
            <p class="mb-3 px-3 text-[11px] font-bold uppercase tracking-widest text-gray-400">Menu</p>
            <ul class="space-y-1">
                @foreach ($navItems as $item)
                    <li>
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-colors duration-150
                                  {{ $item['active']
                                      ? 'bg-blue-50 text-[#0047D4] font-semibold'
                                      : 'text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]' }}">
                            <span class="flex h-8 w-8 items-center justify-center rounded-lg {{ $item['active'] ? 'bg-[#0047D4] text-white' : 'bg-gray-100 text-gray-500' }}">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $item['icon'] !!}</svg>
                            </span>
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        {{-- Logout --}}
        <div class="border-t border-gray-100 px-4 py-4">
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-gray-600 transition-colors duration-150 hover:bg-rose-50 hover:text-rose-600">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-500">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    </span>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ==================== MAIN CONTENT ==================== --}}
    <div class="transition-all duration-300 lg:ml-[280px]">

        {{-- Top bar --}}
        <header class="sticky top-0 z-30 border-b border-gray-100 bg-white/80 backdrop-blur-md">
            <div class="flex items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
                {{-- Mobile hamburger --}}
                <button type="button" onclick="openSidebar()" class="inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs lg:hidden" aria-label="Open sidebar">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
                </button>

                {{-- Page title + date --}}
                <div class="min-w-0">
                    <h1 class="text-lg font-extrabold tracking-tight text-gray-900 sm:text-xl">Staff Dashboard</h1>
                    <p class="text-xs text-gray-400">Tuesday, 10 June 2026</p>
                </div>

                {{-- Staff avatar --}}
                <div class="flex items-center gap-3">
                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-semibold text-gray-900">{{ $staff['name'] }}</p>
                        <p class="text-xs text-gray-400">{{ $staff['role'] }}</p>
                    </div>
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white shadow-lg shadow-blue-500/10">{{ $staff['initials'] }}</span>
                </div>
            </div>
        </header>

        {{-- Page body --}}
        <main class="px-4 py-6 sm:px-6 lg:px-8">

            {{-- ============ WELCOME BANNER ============ --}}
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#00277a] via-[#0047D4] to-indigo-700 p-5 shadow-lg shadow-blue-900/10 sm:p-6">
                <div class="pointer-events-none absolute -right-8 -top-12 h-48 w-48 rounded-full bg-white/10 blur-2xl"></div>
                <div class="pointer-events-none absolute -bottom-12 right-16 h-40 w-40 rounded-full bg-sky-300/20 blur-3xl"></div>
                <div class="relative flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-xl font-extrabold text-white sm:text-2xl">Good morning, {{ $staff['name'] }} 👋</h2>
                        <p class="mt-1 text-sm text-blue-100/90">You have <span class="font-bold text-white">8 bookings</span> today</p>
                    </div>
                    <a href="{{ route('staff.schedule') }}" class="mt-3 inline-flex items-center justify-center gap-2 self-start rounded-xl bg-white/15 px-4 py-2 text-sm font-semibold text-white backdrop-blur-sm transition-colors duration-150 hover:bg-white/25 sm:mt-0">
                        View Schedule
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </section>

            {{-- ============ KPI CARDS ============ --}}
            <div class="mt-6 grid grid-cols-2 gap-4 lg:grid-cols-4">
                @foreach ($kpis as $kpi)
                    @php $s = $kpiStyles[$kpi['color']]; @endphp
                    <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs sm:p-5">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl {{ $s['icon_bg'] }} {{ $s['text'] }}">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $kpi['icon'] !!}</svg>
                            </span>
                            <div class="min-w-0">
                                <p class="text-2xl font-extrabold text-gray-900">{{ $kpi['value'] }}</p>
                                <p class="truncate text-xs text-gray-500">{{ $kpi['label'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ============ SCHEDULE + QUICK ACTIONS ROW ============ --}}
            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- Today's Quick Schedule --}}
                <div class="lg:col-span-2 rounded-2xl border border-gray-100 bg-white shadow-xs">
                    <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4 sm:px-6">
                        <div>
                            <h3 class="text-sm font-bold text-gray-900">Today's Quick Schedule</h3>
                            <p class="text-xs text-gray-400">Next 5 upcoming bookings</p>
                        </div>
                        <a href="{{ route('staff.schedule') }}" class="text-xs font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors duration-150">View All →</a>
                    </div>

                    {{-- Desktop table --}}
                    <div class="hidden sm:block overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-400">
                                    <th class="px-5 py-3 sm:px-6">Time</th>
                                    <th class="px-5 py-3 sm:px-6">Customer</th>
                                    <th class="px-5 py-3 sm:px-6">Sport</th>
                                    <th class="px-5 py-3 sm:px-6">Payment</th>
                                    <th class="px-5 py-3 sm:px-6">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach ($schedule as $row)
                                    <tr class="hover:bg-gray-50/50 transition-colors duration-100">
                                        <td class="whitespace-nowrap px-5 py-3.5 sm:px-6 font-medium text-gray-900">{{ $row['time'] }}</td>
                                        <td class="whitespace-nowrap px-5 py-3.5 sm:px-6 text-gray-700">{{ $row['customer'] }}</td>
                                        <td class="whitespace-nowrap px-5 py-3.5 sm:px-6 text-gray-700">{{ $row['sport'] }}</td>
                                        <td class="whitespace-nowrap px-5 py-3.5 sm:px-6">
                                            <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $badgeStyles[$row['payment_color']] }}">{{ $row['payment'] }}</span>
                                        </td>
                                        <td class="whitespace-nowrap px-5 py-3.5 sm:px-6">
                                            <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $badgeStyles[$row['status_color']] }}">{{ $row['status'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Mobile cards --}}
                    <div class="sm:hidden divide-y divide-gray-50">
                        @foreach ($schedule as $row)
                            <div class="px-5 py-4">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold text-gray-900">{{ $row['customer'] }}</p>
                                    <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $badgeStyles[$row['status_color']] }}">{{ $row['status'] }}</span>
                                </div>
                                <div class="mt-1.5 flex items-center gap-3 text-xs text-gray-500">
                                    <span>{{ $row['time'] }}</span>
                                    <span>·</span>
                                    <span>{{ $row['sport'] }}</span>
                                    <span>·</span>
                                    <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold {{ $badgeStyles[$row['payment_color']] }}">{{ $row['payment'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs sm:p-6">
                    <h3 class="text-sm font-bold text-gray-900">Quick Actions</h3>
                    <p class="text-xs text-gray-400">Common staff operations</p>

                    <div class="mt-5 space-y-3">
                        <a href="{{ route('staff.checkin') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-white p-3.5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition-colors duration-200 group-hover:bg-emerald-600 group-hover:text-white">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Check-In Customer</p>
                                <p class="text-xs text-gray-400">Verify & confirm arrival</p>
                            </div>
                        </a>

                        <a href="{{ route('staff.offline-booking') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-white p-3.5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#0047D4] transition-colors duration-200 group-hover:bg-[#0047D4] group-hover:text-white">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5v14"/></svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">New Walk-In Booking</p>
                                <p class="text-xs text-gray-400">Register on-site customer</p>
                            </div>
                        </a>

                        <a href="{{ route('staff.settlement') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-white p-3.5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:border-amber-200 hover:shadow-md">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600 transition-colors duration-200 group-hover:bg-amber-600 group-hover:text-white">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/></svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Settle Payment</p>
                                <p class="text-xs text-gray-400">Complete remaining balances</p>
                            </div>
                        </a>

                        <a href="{{ route('staff.schedule') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-white p-3.5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-md">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 transition-colors duration-200 group-hover:bg-indigo-600 group-hover:text-white">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">View Full Schedule</p>
                                <p class="text-xs text-gray-400">All today's bookings</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- ============ COURT STATUS ============ --}}
            <section class="mt-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">Court Status</h3>
                        <p class="text-xs text-gray-400">Real-time court availability</p>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
                    @foreach ($courts as $court)
                        <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs transition-all duration-200 hover:shadow-md">
                            <div class="flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full {{ $courtDot[$court['color']] }}"></span>
                                <span class="inline-flex rounded-full px-2.5 py-0.5 text-[11px] font-semibold {{ $courtBadge[$court['color']] }}">{{ $court['status'] }}</span>
                            </div>
                            <p class="mt-3 text-sm font-bold text-gray-900">{{ $court['name'] }}</p>
                            <div class="mt-2">
                                <svg class="h-5 w-5 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    @if ($court['status'] === 'In Use')
                                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                                    @elseif ($court['status'] === 'Available')
                                        <path d="M20 6 9 17l-5-5"/>
                                    @elseif ($court['status'] === 'Maintenance')
                                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                    @else
                                        <rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
                                    @endif
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

        </main>

        {{-- Footer --}}
        <footer class="mt-4 border-t border-gray-100 bg-white">
            <div class="flex flex-col items-center justify-between gap-3 px-4 py-5 sm:flex-row sm:px-6 lg:px-8">
                <p class="text-xs text-gray-400">&copy; {{ date('Y') }} SportOps. All rights reserved.</p>
                <p class="text-xs text-gray-400">Staff Panel v1.0</p>
            </div>
        </footer>
    </div>

    {{-- ==================== SIDEBAR TOGGLE SCRIPT ==================== --}}
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100', 'pointer-events-auto');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            overlay.classList.remove('opacity-100', 'pointer-events-auto');
        }
    </script>
</body>
</html>
