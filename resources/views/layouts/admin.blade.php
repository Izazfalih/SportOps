<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | SportOps</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-circle.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    @php
        $adminUser = [
            'name'     => Auth::user()->name ?? 'Admin',
            'initials' => collect(explode(' ', Auth::user()->name ?? 'A'))->map(fn($w) => mb_substr($w, 0, 1))->take(2)->join(''),
            'email'    => Auth::user()->email ?? 'admin@sportops.id',
        ];

        $sidebarNav = [
            ['label' => 'Dashboard',         'route' => 'admin.dashboard', 'icon' => '<rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/>'],
            ['label' => 'Courts Management', 'route' => 'admin.courts.index',    'icon' => '<rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 12h18"/><path d="M12 3v18"/>'],
            ['label' => 'Bookings',          'route' => 'admin.bookings',  'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/>'],
            ['label' => 'Users',             'route' => 'admin.users',     'icon' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
            ['label' => 'Financial Reports', 'route' => 'admin.reports',   'icon' => '<path d="M3 3v18h18"/><path d="M7 16l4-8 4 4 4-6"/>'],
            ['label' => 'Settings',          'route' => 'admin.settings',  'icon' => '<path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/>'],
        ];
    @endphp

    {{-- ==================== MOBILE SIDEBAR OVERLAY ==================== --}}
    <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm transition-opacity duration-300 opacity-0 pointer-events-none lg:hidden" onclick="closeSidebar()"></div>

    {{-- ==================== SIDEBAR ==================== --}}
    <aside id="sidebar" class="group fixed inset-y-0 left-0 z-50 flex w-72 flex-col bg-white border-r border-gray-100 shadow-lg shadow-gray-200/50 transition-all duration-300 ease-in-out -translate-x-full lg:translate-x-0 lg:w-20 hover:lg:w-72 lg:shadow-xs overflow-hidden">

        {{-- Brand --}}
        <div class="flex items-center gap-3 border-b border-gray-100 px-5 py-5 min-w-[18rem]">
            <img src="{{ asset('images/logo.png') }}" alt="SportOps" class="h-10 w-10 shrink-0 object-contain">
            <div class="transition-opacity duration-300 opacity-100 lg:opacity-0 group-hover:lg:opacity-100">
                <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
                <p class="text-[11px] font-medium text-gray-400">Admin Panel</p>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto overflow-x-hidden px-3 py-5">
            <p class="mb-3 px-3 text-[11px] font-bold uppercase tracking-widest text-gray-400 whitespace-nowrap transition-opacity duration-300 opacity-100 lg:opacity-0 group-hover:lg:opacity-100">Menu</p>
            <ul class="space-y-1 min-w-[15rem]">
                @foreach ($sidebarNav as $item)
                    @php $isActive = request()->routeIs($item['route']); @endphp
                    <li>
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-colors duration-150 relative
                                  {{ $isActive
                                      ? 'bg-blue-50 font-semibold text-[#0047D4]'
                                      : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]' }}">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg {{ $isActive ? 'bg-[#0047D4] text-white shadow-lg shadow-blue-500/20' : 'bg-gray-50 text-gray-500' }}">
                                <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $item['icon'] !!}</svg>
                            </span>
                            <span class="whitespace-nowrap transition-opacity duration-300 opacity-100 lg:opacity-0 group-hover:lg:opacity-100">
                                {{ $item['label'] }}
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        {{-- Sidebar footer --}}
        <div class="border-t border-gray-100 px-3 py-4 min-w-[18rem] overflow-hidden">
            <div class="mb-3 flex items-center gap-3 rounded-xl bg-gray-50 px-3 py-2.5">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $adminUser['initials'] }}</span>
                <div class="min-w-0 transition-opacity duration-300 opacity-100 lg:opacity-0 group-hover:lg:opacity-100">
                    <p class="truncate text-sm font-semibold text-gray-900">{{ $adminUser['name'] }}</p>
                    <p class="truncate text-xs text-gray-500">{{ $adminUser['email'] }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-[15rem] items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 transition-colors duration-150 hover:bg-rose-50 hover:text-rose-600">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-gray-50 text-gray-500">
                        <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    </span>
                    <span class="whitespace-nowrap transition-opacity duration-300 opacity-100 lg:opacity-0 group-hover:lg:opacity-100">
                        Logout
                    </span>
                </button>
            </form>
        </div>
    </aside>

    {{-- ==================== MAIN CONTENT ==================== --}}
    <div id="main-content" class="min-h-full transition-all duration-300 lg:ml-20">

        {{-- Top header bar --}}
        <header class="sticky top-0 z-30 border-b border-gray-100 bg-white/80 backdrop-blur-md">
            <div class="flex items-center justify-between px-4 py-3.5 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3">
                    {{-- Mobile hamburger --}}
                    <button type="button" onclick="openSidebar()" class="inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs lg:hidden" aria-label="Open sidebar">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
                    </button>
                    <div>
                        <h1 class="text-xl font-extrabold tracking-tight text-gray-900 sm:text-2xl">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-sm text-gray-500">@yield('page-subtitle', "Welcome back, {$adminUser['name']}")</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    {{-- Notifications --}}
                    <div class="relative">
                        <button type="button" onclick="toggleAdminNotifMenu()" class="relative inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs hover:text-[#0047D4] hover:border-blue-200 transition-colors duration-150" aria-label="Notifications">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10.268 21a2 2 0 0 0 3.464 0"/>
                                <path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"/>
                            </svg>
                            <span id="admin-notif-badge" class="absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-[#0047D4] text-[9px] font-bold text-white ring-2 ring-white">5</span>
                        </button>

                        <div id="admin-notif-menu" class="hidden absolute right-0 mt-2 w-72 sm:w-80 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl shadow-gray-900/10">
                            <div class="border-b border-gray-50 px-4 py-3 flex items-center justify-between">
                                <p class="text-sm font-bold text-gray-900">Notifications</p>
                                <span class="text-xs text-[#0047D4] cursor-pointer hover:underline">Mark all as read</span>
                            </div>
                            <div id="admin-notif-list" class="max-h-64 overflow-y-auto">
                                <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-50 last:border-0 transition-colors">
                                    <p class="text-sm font-semibold text-gray-900">New Booking Created</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Booking BK-20260021 has been successfully created.</p>
                                    <p class="text-[10px] text-gray-400 mt-1">10 mins ago</p>
                                </a>
                                <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-50 last:border-0 transition-colors">
                                    <p class="text-sm font-semibold text-gray-900">New User Registered</p>
                                    <p class="text-xs text-gray-500 mt-0.5">A new user has just registered on the platform.</p>
                                    <p class="text-[10px] text-gray-400 mt-1">1 hour ago</p>
                                </a>
                            </div>
                            <div id="admin-view-all-container" class="border-t border-gray-50 py-2 text-center">
                                <a href="#" onclick="expandAdminNotifList(event)" class="text-xs font-semibold text-[#0047D4] hover:underline">View all notifications</a>
                            </div>
                        </div>
                    </div>

                    {{-- Admin Profile dropdown --}}
                    <div class="relative">
                        <button type="button" onclick="toggleAdminProfileMenu()" class="flex items-center gap-2 rounded-xl border border-gray-150 bg-white p-1 pr-2 shadow-xs hover:border-blue-200 transition-colors duration-150">
                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $adminUser['initials'] }}</span>
                            <span class="hidden text-sm font-semibold text-gray-700 sm:inline">{{ $adminUser['name'] }}</span>
                            <svg class="hidden h-4 w-4 text-gray-400 sm:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"></path></svg>
                        </button>

                        <div id="admin-profile-menu" class="hidden absolute right-0 mt-2 w-56 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl shadow-gray-900/10">
                            <div class="border-b border-gray-50 px-4 py-3">
                                <p class="text-sm font-bold text-gray-900">{{ $adminUser['name'] }}</p>
                                <p class="truncate text-xs text-gray-500">{{ $adminUser['email'] }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]">My Profile</a>
                                <a href="{{ route('admin.settings') }}" class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]">Settings</a>
                            </div>
                            <div class="border-t border-gray-50 py-1">
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-rose-600 hover:bg-rose-50">Sign out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- Page content --}}
        <main class="px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="mt-4 border-t border-gray-100 bg-white">
            <div class="flex flex-col items-center justify-between gap-3 px-4 py-6 sm:flex-row sm:px-6 lg:px-8">
                <p class="text-sm text-gray-400">&copy; {{ date('Y') }} SportOps. All rights reserved.</p>
                <div class="flex items-center gap-5 text-sm text-gray-400">
                    <span>Jl. Olahraga No. 12, Jakarta</span>
                </div>
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

        const adminNotifMenu = document.getElementById('admin-notif-menu');
        const adminNotifBadge = document.getElementById('admin-notif-badge');

        if (localStorage.getItem('admin_notif_read') === 'true') {
            if (adminNotifBadge) adminNotifBadge.classList.add('hidden');
        }

        function toggleAdminNotifMenu() {
            if (adminNotifMenu) {
                adminNotifMenu.classList.toggle('hidden');
                // Hide badge when opened
                if (!adminNotifMenu.classList.contains('hidden') && adminNotifBadge) {
                    adminNotifBadge.classList.add('hidden');
                    localStorage.setItem('admin_notif_read', 'true');
                }
            }
        }
        function expandAdminNotifList(e) {
            e.preventDefault();
            const list = document.getElementById('admin-notif-list');
            if (list) {
                list.classList.remove('max-h-64');
                list.classList.add('max-h-96');
                const dummyItem = `
                <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-50 last:border-0 transition-colors opacity-60">
                    <p class="text-sm font-semibold text-gray-900">Laporan Bulanan Siap</p>
                    <p class="text-xs text-gray-500 mt-0.5">Laporan pendapatan bulan lalu sudah bisa diunduh.</p>
                    <p class="text-[10px] text-gray-400 mt-1">3 days ago</p>
                </a>
                <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-50 last:border-0 transition-colors opacity-60">
                    <p class="text-sm font-semibold text-gray-900">Pemesanan Dibatalkan</p>
                    <p class="text-xs text-gray-500 mt-0.5">Pemesanan #BK-0089 telah dibatalkan.</p>
                    <p class="text-[10px] text-gray-400 mt-1">4 days ago</p>
                </a>
                <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-50 last:border-0 transition-colors opacity-60">
                    <p class="text-sm font-semibold text-gray-900">Pengingat Jadwal</p>
                    <p class="text-xs text-gray-500 mt-0.5">Ada 5 pemesanan untuk lapangan hari ini.</p>
                    <p class="text-[10px] text-gray-400 mt-1">1 week ago</p>
                </a>`;
                list.innerHTML += dummyItem;
            }
            const container = document.getElementById('admin-view-all-container');
            if (container) container.style.display = 'none';
        }

        function toggleAdminProfileMenu() {
            const profileMenu = document.getElementById('admin-profile-menu');
            if (profileMenu) {
                profileMenu.classList.toggle('hidden');
                if (adminNotifMenu) adminNotifMenu.classList.add('hidden');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const profileMenu = document.getElementById('admin-profile-menu');
            const isClickInsideNotif = event.target.closest('#admin-notif-menu') || event.target.closest('[onclick="toggleAdminNotifMenu()"]');
            const isClickInsideProfile = event.target.closest('#admin-profile-menu') || event.target.closest('[onclick="toggleAdminProfileMenu()"]');

            if (!isClickInsideNotif && adminNotifMenu && !adminNotifMenu.classList.contains('hidden')) {
                adminNotifMenu.classList.add('hidden');
            }
            if (!isClickInsideProfile && profileMenu && !profileMenu.classList.contains('hidden')) {
                profileMenu.classList.add('hidden');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>