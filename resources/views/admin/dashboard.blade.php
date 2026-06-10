<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SportOps</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    @php
        $admin = [
            'name'     => 'Admin Utama',
            'initials' => 'AU',
            'email'    => 'admin@sportops.id',
        ];

        $navItems = [
            ['label' => 'Dashboard',         'href' => route('admin.dashboard'), 'active' => true,  'icon' => '<rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/>'],
            ['label' => 'Courts Management', 'href' => route('admin.courts'), 'active' => false, 'icon' => '<rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 12h18"/><path d="M12 3v18"/>'],
            ['label' => 'Bookings',          'href' => route('admin.bookings'), 'active' => false, 'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01M16 18h.01"/>'],
            ['label' => 'Users',             'href' => route('admin.users'), 'active' => false, 'icon' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
            ['label' => 'Financial Reports', 'href' => route('admin.reports'), 'active' => false, 'icon' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>'],
            ['label' => 'Settings',          'href' => route('admin.settings'), 'active' => false, 'icon' => '<path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/>'],
        ];

        $kpis = [
            [
                'label'   => "Today's Bookings",
                'value'   => '12',
                'change'  => '+18%',
                'up'      => true,
                'color'   => 'blue',
                'bgClass' => 'bg-blue-50',
                'txtClass'=> 'text-[#0047D4]',
                'icon'    => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
            ],
            [
                'label'   => 'Active Bookings',
                'value'   => '5',
                'change'  => '+2',
                'up'      => true,
                'color'   => 'emerald',
                'bgClass' => 'bg-emerald-50',
                'txtClass'=> 'text-emerald-600',
                'icon'    => '<path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2"/>',
            ],
            [
                'label'   => 'Total Revenue',
                'value'   => 'Rp 45,800,000',
                'change'  => '+12%',
                'up'      => true,
                'color'   => 'violet',
                'bgClass' => 'bg-violet-50',
                'txtClass'=> 'text-violet-600',
                'icon'    => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
            ],
            [
                'label'   => 'Total Users',
                'value'   => '328',
                'change'  => '+24',
                'up'      => true,
                'color'   => 'amber',
                'bgClass' => 'bg-amber-50',
                'txtClass'=> 'text-amber-600',
                'icon'    => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
            ],
            [
                'label'   => 'Court Utilization',
                'value'   => '78%',
                'change'  => '+5%',
                'up'      => true,
                'color'   => 'rose',
                'bgClass' => 'bg-rose-50',
                'txtClass'=> 'text-rose-600',
                'icon'    => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>',
            ],
        ];

        $activities = [
            [
                'title'   => 'New booking by Ahmad Fauzi',
                'desc'    => 'Futsal, Today 14:00–15:00',
                'time'    => '5 min ago',
                'color'   => 'bg-blue-500',
                'icon'    => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
            ],
            [
                'title'   => 'Payment received',
                'desc'    => 'Rp 150,000 from Sarah Putri',
                'time'    => '12 min ago',
                'color'   => 'bg-emerald-500',
                'icon'    => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
            ],
            [
                'title'   => 'New user registered',
                'desc'    => 'Dimas Pratama',
                'time'    => '1 hour ago',
                'color'   => 'bg-violet-500',
                'icon'    => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>',
            ],
            [
                'title'   => 'Booking completed',
                'desc'    => 'Basketball, Budi Santoso',
                'time'    => '2 hours ago',
                'color'   => 'bg-amber-500',
                'icon'    => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>',
            ],
            [
                'title'   => 'Court Tennis deactivated',
                'desc'    => 'Scheduled maintenance',
                'time'    => '3 hours ago',
                'color'   => 'bg-rose-500',
                'icon'    => '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>',
            ],
        ];

        $quickStats = [
            ['label' => 'Courts Available', 'value' => '8 / 12',  'color' => 'text-emerald-600'],
            ['label' => 'Pending Payments',  'value' => '3',       'color' => 'text-amber-600'],
            ['label' => 'Revenue Today',     'value' => 'Rp 2.4M', 'color' => 'text-[#0047D4]'],
            ['label' => 'New Users (Week)',  'value' => '14',       'color' => 'text-violet-600'],
        ];

        $bookings = [
            [
                'name'      => 'Ahmad Fauzi',
                'sport'     => 'Futsal',
                'date'      => '10 Jun 2026',
                'time'      => '14:00 – 15:00',
                'payment'   => 'Fully Paid',
                'payColor'  => 'bg-emerald-50 text-emerald-700',
                'status'    => 'Confirmed',
                'statColor' => 'bg-blue-50 text-[#0047D4]',
            ],
            [
                'name'      => 'Sarah Putri',
                'sport'     => 'Badminton',
                'date'      => '10 Jun 2026',
                'time'      => '15:00 – 16:00',
                'payment'   => 'DP Paid',
                'payColor'  => 'bg-amber-50 text-amber-700',
                'status'    => 'Confirmed',
                'statColor' => 'bg-blue-50 text-[#0047D4]',
            ],
            [
                'name'      => 'Budi Santoso',
                'sport'     => 'Basketball',
                'date'      => '10 Jun 2026',
                'time'      => '16:00 – 17:00',
                'payment'   => 'Pending',
                'payColor'  => 'bg-gray-100 text-gray-600',
                'status'    => 'Pending Payment',
                'statColor' => 'bg-amber-50 text-amber-700',
            ],
            [
                'name'      => 'Dimas Pratama',
                'sport'     => 'Tennis',
                'date'      => '10 Jun 2026',
                'time'      => '17:00 – 18:00',
                'payment'   => 'Fully Paid',
                'payColor'  => 'bg-emerald-50 text-emerald-700',
                'status'    => 'Checked In',
                'statColor' => 'bg-purple-50 text-purple-700',
            ],
            [
                'name'      => 'Rina Anggraini',
                'sport'     => 'Futsal',
                'date'      => '11 Jun 2026',
                'time'      => '09:00 – 10:00',
                'payment'   => 'DP Paid',
                'payColor'  => 'bg-amber-50 text-amber-700',
                'status'    => 'Confirmed',
                'statColor' => 'bg-blue-50 text-[#0047D4]',
            ],
            [
                'name'      => 'Fajar Hidayat',
                'sport'     => 'Badminton',
                'date'      => '11 Jun 2026',
                'time'      => '10:00 – 11:00',
                'payment'   => 'Pending',
                'payColor'  => 'bg-gray-100 text-gray-600',
                'status'    => 'Pending Payment',
                'statColor' => 'bg-amber-50 text-amber-700',
            ],
        ];
    @endphp

    {{-- ==================== MOBILE SIDEBAR OVERLAY ==================== --}}
    <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm transition-opacity duration-300 lg:hidden hidden" onclick="closeSidebar()"></div>

    {{-- ==================== SIDEBAR ==================== --}}
    <aside id="sidebar" class="fixed left-0 top-0 z-50 flex h-full w-[280px] -translate-x-full flex-col border-r border-gray-100 bg-white transition-transform duration-300 ease-in-out lg:translate-x-0">
        {{-- Brand --}}
        <div class="flex items-center gap-3 border-b border-gray-100 px-6 py-5">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#0047D4] to-indigo-600 shadow-lg shadow-blue-500/20">
                <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            </div>
            <div>
                <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
                <p class="text-[11px] font-medium text-gray-400">Admin Panel</p>
            </div>
        </div>

        {{-- Navigation --}}
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

        {{-- Sidebar footer: Admin info + Logout --}}
        <div class="border-t border-gray-100 px-4 py-4">
            <div class="mb-3 flex items-center gap-3 rounded-xl bg-gray-50 px-3 py-2.5">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $admin['initials'] }}</span>
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-gray-900">{{ $admin['name'] }}</p>
                    <p class="truncate text-xs text-gray-500">{{ $admin['email'] }}</p>
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

    {{-- ==================== MAIN CONTENT ==================== --}}
    <div class="min-h-full transition-all duration-300 lg:ml-[280px]">

        {{-- Top header bar --}}
        <header class="sticky top-0 z-30 border-b border-gray-100 bg-white/80 backdrop-blur-md">
            <div class="flex items-center justify-between px-4 py-3.5 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3">
                    {{-- Mobile hamburger --}}
                    <button type="button" onclick="openSidebar()" class="inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs lg:hidden" aria-label="Open sidebar">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
                    </button>
                    <div>
                        <h1 class="text-xl font-extrabold tracking-tight text-gray-900 sm:text-2xl">Dashboard</h1>
                        <p class="text-sm text-gray-500">Welcome back, {{ $admin['name'] }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    {{-- Notifications --}}
                    <button type="button" class="relative inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs hover:text-[#0047D4] hover:border-blue-200 transition-colors duration-150" aria-label="Notifications">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.268 21a2 2 0 0 0 3.464 0"/>
                            <path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"/>
                        </svg>
                        <span class="absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-[#0047D4] text-[9px] font-bold text-white ring-2 ring-white">5</span>
                    </button>

                    {{-- Admin avatar --}}
                    <div class="flex items-center gap-2.5 rounded-xl border border-gray-150 bg-white p-1 pr-3 shadow-xs">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $admin['initials'] }}</span>
                        <span class="hidden text-sm font-semibold text-gray-700 sm:inline">{{ $admin['name'] }}</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Page content --}}
        <main class="px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

            {{-- ============ KPI METRIC CARDS ============ --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
                @foreach ($kpis as $kpi)
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                        <div class="flex items-center justify-between">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl {{ $kpi['bgClass'] }} {{ $kpi['txtClass'] }}">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $kpi['icon'] !!}</svg>
                            </span>
                            <span class="inline-flex items-center gap-1 rounded-full {{ $kpi['up'] ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }} px-2 py-0.5 text-xs font-semibold">
                                @if ($kpi['up'])
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                                @else
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                @endif
                                {{ $kpi['change'] }}
                            </span>
                        </div>
                        <p class="mt-3 text-2xl font-extrabold tracking-tight text-gray-900">{{ $kpi['value'] }}</p>
                        <p class="mt-1 text-sm text-gray-500">{{ $kpi['label'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- ============ TWO-COLUMN: ACTIVITIES + QUICK STATS ============ --}}
            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- Recent Activities (2/3) --}}
                <div class="lg:col-span-2 rounded-2xl border border-gray-100 bg-white p-6 shadow-xs">
                    <div class="flex items-center justify-between">
                        <h2 class="text-base font-bold text-gray-900">Recent Activities</h2>
                        <a href="#" class="text-sm font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors duration-150">View all</a>
                    </div>

                    <div class="mt-5 space-y-0">
                        @foreach ($activities as $i => $activity)
                            <div class="relative flex gap-4 {{ $i < count($activities) - 1 ? 'pb-6' : '' }}">
                                {{-- Timeline line --}}
                                @if ($i < count($activities) - 1)
                                    <div class="absolute left-[17px] top-10 bottom-0 w-px bg-gray-100"></div>
                                @endif

                                {{-- Icon dot --}}
                                <span class="relative z-10 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg {{ $activity['color'] }} text-white shadow-lg shadow-{{ explode('-', $activity['color'])[1] }}-500/20">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $activity['icon'] !!}</svg>
                                </span>

                                {{-- Content --}}
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-semibold text-gray-900">{{ $activity['title'] }}</p>
                                    <p class="text-sm text-gray-500">{{ $activity['desc'] }}</p>
                                    <p class="mt-1 text-xs text-gray-400">{{ $activity['time'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Quick Stats (1/3) --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-xs">
                    <h2 class="text-base font-bold text-gray-900">Quick Stats</h2>
                    <p class="mt-1 text-sm text-gray-500">Today's summary at a glance</p>

                    <div class="mt-5 space-y-4">
                        @foreach ($quickStats as $stat)
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-sm text-gray-500">{{ $stat['label'] }}</p>
                                <p class="mt-1 text-xl font-extrabold {{ $stat['color'] }}">{{ $stat['value'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    {{-- Mini chart placeholder --}}
                    <div class="mt-5 rounded-xl border border-dashed border-gray-200 p-4 text-center">
                        <div class="flex items-center justify-center gap-1">
                            @foreach ([40, 65, 45, 80, 55, 70, 90] as $h)
                                <div class="w-4 rounded-sm bg-[#0047D4]/{{ $h > 60 ? '80' : '30' }}" style="height: {{ $h }}px"></div>
                            @endforeach
                        </div>
                        <p class="mt-3 text-xs font-medium text-gray-400">Revenue — Last 7 days</p>
                    </div>
                </div>
            </div>

            {{-- ============ UPCOMING BOOKINGS TABLE ============ --}}
            <div class="mt-6 rounded-2xl border border-gray-100 bg-white shadow-xs">
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <h2 class="text-base font-bold text-gray-900">Upcoming Bookings</h2>
                    <a href="#" class="inline-flex items-center gap-1.5 rounded-xl bg-[#0047D4] px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] transition-colors duration-150">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5v14"/></svg>
                        Add Booking
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-gray-100 text-xs font-bold uppercase tracking-wider text-gray-400">
                                <th class="px-6 py-3.5">Customer Name</th>
                                <th class="px-6 py-3.5">Sport</th>
                                <th class="px-6 py-3.5">Date</th>
                                <th class="px-6 py-3.5">Time</th>
                                <th class="px-6 py-3.5">Payment Status</th>
                                <th class="px-6 py-3.5">Booking Status</th>
                                <th class="px-6 py-3.5">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($bookings as $booking)
                                <tr class="transition-colors duration-100 hover:bg-gray-50/50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gray-100 text-xs font-bold text-gray-600">{{ collect(explode(' ', $booking['name']))->map(fn($w) => mb_substr($w, 0, 1))->join('') }}</span>
                                            <span class="font-semibold text-gray-900">{{ $booking['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $booking['sport'] }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $booking['date'] }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $booking['time'] }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $booking['payColor'] }}">{{ $booking['payment'] }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $booking['statColor'] }}">{{ $booking['status'] }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-semibold text-gray-700 transition-colors duration-150 hover:border-[#0047D4] hover:text-[#0047D4]">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Table footer --}}
                <div class="flex items-center justify-between border-t border-gray-100 px-6 py-3.5">
                    <p class="text-sm text-gray-500">Showing <span class="font-semibold text-gray-700">{{ count($bookings) }}</span> upcoming bookings</p>
                    <a href="#" class="text-sm font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors duration-150">View all bookings →</a>
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

    {{-- ==================== SIDEBAR TOGGLE SCRIPTS ==================== --}}
    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.remove('hidden');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.add('hidden');
        }
    </script>
</body>
</html>
