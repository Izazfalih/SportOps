<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Staff') | SportOps</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-circle.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    @php
        $staffUser = [
            'name'     => Auth::user()->name ?? 'Staff',
            'initials' => collect(explode(' ', Auth::user()->name ?? 'S'))->map(fn($w) => mb_substr($w, 0, 1))->take(2)->join(''),
            'role'     => 'Field Keeper',
        ];

        $sidebarNav = [
            ['label' => 'Dashboard',        'route' => 'staff.dashboard',       'icon' => '<rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/>'],
            ['label' => "Today's Schedule",  'route' => 'staff.schedule',        'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
            ['label' => 'Verification',          'route' => 'staff.verification',         'icon' => '<path d="M20 6 9 17l-5-5"/>'],
            ['label' => 'Offline Booking',   'route' => 'staff.offline-booking', 'icon' => '<path d="M5 12h14M12 5v14"/>'],
            ['label' => 'Settlement',        'route' => 'staff.settlement',      'icon' => '<rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/>'],
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
                <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
                <p class="text-[11px] font-medium text-gray-400">Staff Panel</p>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto px-4 py-5">
            <p class="mb-3 px-3 text-[11px] font-bold uppercase tracking-widest text-gray-400">Menu</p>
            <ul class="space-y-1">
                @foreach ($sidebarNav as $item)
                    @php $isActive = request()->routeIs($item['route']); @endphp
                    <li>
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-colors duration-150
                                  {{ $isActive
                                      ? 'bg-blue-50 font-semibold text-[#0047D4]'
                                      : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]' }}">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg {{ $isActive ? 'bg-[#0047D4] text-white shadow-lg shadow-blue-500/20' : 'bg-gray-100 text-gray-500' }}">
                                <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $item['icon'] !!}</svg>
                            </span>
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        {{-- Sidebar footer --}}
        <div class="border-t border-gray-100 px-4 py-4">
            <div class="mb-3 flex items-center gap-3 rounded-xl bg-gray-50 px-3 py-2.5">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $staffUser['initials'] }}</span>
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-gray-900">{{ $staffUser['name'] }}</p>
                    <p class="truncate text-xs text-gray-500">{{ $staffUser['role'] }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
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

        {{-- Top bar --}}
        <header class="sticky top-0 z-30 border-b border-gray-100 bg-white/80 backdrop-blur-md">
            <div class="flex items-center justify-between gap-4 px-4 py-3.5 sm:px-6 lg:px-8">
                {{-- Mobile hamburger --}}
                <button type="button" onclick="openSidebar()" class="inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs lg:hidden" aria-label="Open sidebar">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
                </button>

                {{-- Page title --}}
                <div class="min-w-0">
                    <h1 class="text-lg font-extrabold tracking-tight text-gray-900 sm:text-xl">@yield('page-title', 'Staff Dashboard')</h1>
                    <p class="text-xs text-gray-400">@yield('page-subtitle', now()->format('l, d F Y'))</p>
                </div>

                {{-- Right cluster (Notif + Avatar) --}}
                <div class="flex items-center gap-3">
                    {{-- Notifications --}}
                    <div class="relative">
                        <button type="button" onclick="toggleStaffNotifMenu()" class="relative inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs hover:text-[#0047D4] hover:border-blue-200 transition-colors duration-150" aria-label="Notifications">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10.268 21a2 2 0 0 0 3.464 0"/>
                                <path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"/>
                            </svg>
                            <span id="staff-notif-badge" class="absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-[#0047D4] text-[9px] font-bold text-white ring-2 ring-white">2</span>
                        </button>

                        <div id="staff-notif-menu" class="hidden absolute right-0 mt-2 w-72 sm:w-80 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl shadow-gray-900/10">
                            <div class="border-b border-gray-50 px-4 py-3 flex items-center justify-between">
                                <p class="text-sm font-bold text-gray-900">Notifications</p>
                                <span class="text-xs text-[#0047D4] cursor-pointer hover:underline">Mark all as read</span>
                            </div>
                            <div class="max-h-64 overflow-y-auto">
                                <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-50 last:border-0 transition-colors">
                                    <p class="text-sm font-semibold text-gray-900">New Booking Check-in</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Booking BK-20260015 has been checked in.</p>
                                    <p class="text-[10px] text-gray-400 mt-1">Just now</p>
                                </a>
                                <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-50 last:border-0 transition-colors">
                                    <p class="text-sm font-semibold text-gray-900">Schedule Update</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Futsal Court B is scheduled for maintenance.</p>
                                    <p class="text-[10px] text-gray-400 mt-1">2 hours ago</p>
                                </a>
                            </div>
                            <div class="border-t border-gray-50 py-2 text-center">
                                <a href="#" class="text-xs font-semibold text-[#0047D4] hover:underline">View all notifications</a>
                            </div>
                        </div>
                    </div>

                    {{-- Staff avatar --}}
                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-semibold text-gray-900">{{ $staffUser['name'] }}</p>
                        <p class="text-xs text-gray-400">{{ $staffUser['role'] }}</p>
                    </div>
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white shadow-lg shadow-blue-500/10">{{ $staffUser['initials'] }}</span>
                </div>
            </div>
        </header>

        {{-- Page content --}}
        <main class="px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="mt-4 border-t border-gray-100 bg-white">
            <div class="flex flex-col items-center justify-between gap-3 px-4 py-5 sm:flex-row sm:px-6 lg:px-8">
                <p class="text-xs text-gray-400">&copy; {{ date('Y') }} SportOps. All rights reserved.</p>
                <p class="text-xs text-gray-400">Staff Panel v1.0</p>
            </div>
        </footer>
    </div>

    {{-- ==================== SIDEBAR TOGGLE SCRIPTS ==================== --}}
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

        const staffNotifMenu = document.getElementById('staff-notif-menu');
        const staffNotifBadge = document.getElementById('staff-notif-badge');

        function toggleStaffNotifMenu() {
            if (staffNotifMenu) {
                staffNotifMenu.classList.toggle('hidden');
                // Hide badge when opened
                if (!staffNotifMenu.classList.contains('hidden') && staffNotifBadge) {
                    staffNotifBadge.classList.add('hidden');
                }
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInsideNotif = event.target.closest('#staff-notif-menu') || event.target.closest('[onclick="toggleStaffNotifMenu()"]');
            if (!isClickInsideNotif && staffNotifMenu && !staffNotifMenu.classList.contains('hidden')) {
                staffNotifMenu.classList.add('hidden');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
