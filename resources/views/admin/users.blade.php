<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management | SportOps Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    @php
        $users = [
            ['name' => 'Ahmad Fauzi', 'email' => 'ahmad.fauzi@gmail.com', 'phone' => '0812-3456-7890', 'role' => 'Admin', 'status' => 'Active', 'joined' => '2024-01-15'],
            ['name' => 'Siti Nurhaliza', 'email' => 'siti.nurhaliza@yahoo.com', 'phone' => '0856-1234-5678', 'role' => 'User', 'status' => 'Active', 'joined' => '2024-03-22'],
            ['name' => 'Budi Santoso', 'email' => 'budi.santoso@gmail.com', 'phone' => '0878-9012-3456', 'role' => 'Staff', 'status' => 'Active', 'joined' => '2024-02-10'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi.lestari@outlook.com', 'phone' => '0813-5678-9012', 'role' => 'User', 'status' => 'Disabled', 'joined' => '2024-05-18'],
            ['name' => 'Rizky Maulana', 'email' => 'rizky.maulana@gmail.com', 'phone' => '0821-3456-7890', 'role' => 'User', 'status' => 'Active', 'joined' => '2024-04-07'],
            ['name' => 'Putri Ayu Wulandari', 'email' => 'putri.ayu@gmail.com', 'phone' => '0857-6789-0123', 'role' => 'Staff', 'status' => 'Active', 'joined' => '2024-06-01'],
            ['name' => 'Hendra Wijaya', 'email' => 'hendra.wijaya@yahoo.com', 'phone' => '0896-1234-5678', 'role' => 'User', 'status' => 'Active', 'joined' => '2025-01-12'],
            ['name' => 'Mega Puspitasari', 'email' => 'mega.puspita@gmail.com', 'phone' => '0812-8901-2345', 'role' => 'User', 'status' => 'Disabled', 'joined' => '2025-02-28'],
            ['name' => 'Irfan Hakim', 'email' => 'irfan.hakim@gmail.com', 'phone' => '0878-2345-6789', 'role' => 'Admin', 'status' => 'Active', 'joined' => '2024-01-15'],
            ['name' => 'Rina Marlina', 'email' => 'rina.marlina@outlook.com', 'phone' => '0856-7890-1234', 'role' => 'User', 'status' => 'Active', 'joined' => '2025-06-03'],
        ];

        $stats = [
            'total_users' => 328,
            'active_staff' => 4,
            'new_this_month' => 28,
        ];

        $navItems = [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline>'],
            ['label' => 'Courts Management', 'route' => 'admin.courts', 'icon' => '<rect x="2" y="3" width="20" height="14" rx="2"></rect><path d="M12 3v14M2 10h20"></path>'],
            ['label' => 'Bookings', 'route' => 'admin.bookings', 'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path>'],
            ['label' => 'Users', 'route' => 'admin.users', 'icon' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>'],
            ['label' => 'Financial Reports', 'route' => 'admin.reports', 'icon' => '<path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path>'],
            ['label' => 'Settings', 'route' => 'admin.settings', 'icon' => '<circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>'],
        ];

        $activeRoute = 'admin.users';
    @endphp

    <div class="flex h-full min-h-screen">

        {{-- ======================== SIDEBAR (DESKTOP) ======================== --}}
        <aside class="hidden lg:flex lg:flex-col lg:w-[260px] lg:fixed lg:inset-y-0 bg-white border-r border-gray-100 z-40">
            {{-- Brand --}}
            <div class="flex items-center gap-2.5 px-5 py-5 border-b border-gray-100">
                <div class="bg-white border border-gray-150 p-1.5 rounded-xl shadow-xs">
                    <img class="h-7 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                </div>
                <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
                <span class="ml-auto rounded-lg bg-blue-50 px-2 py-0.5 text-[10px] font-bold text-[#0047D4]">Admin</span>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors duration-150
                              {{ $item['route'] === $activeRoute
                                  ? 'bg-blue-50 text-[#0047D4] font-semibold'
                                  : 'text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]' }}">
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $item['icon'] !!}</svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            {{-- Logout --}}
            <div class="border-t border-gray-100 px-3 py-4">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 hover:bg-rose-50 hover:text-rose-600 transition-colors duration-150">
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- ======================== MOBILE HEADER ======================== --}}
        <div class="lg:hidden fixed top-0 inset-x-0 z-40 bg-white/80 backdrop-blur-md border-b border-gray-100">
            <div class="flex items-center justify-between px-4 py-3">
                <div class="flex items-center gap-2.5">
                    <div class="bg-white border border-gray-150 p-1.5 rounded-xl shadow-xs">
                        <img class="h-6 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                    </div>
                    <span class="text-base font-extrabold tracking-tight text-gray-900">SportOps</span>
                    <span class="rounded-lg bg-blue-50 px-2 py-0.5 text-[10px] font-bold text-[#0047D4]">Admin</span>
                </div>
                <button type="button" onclick="toggleSidebar()" class="inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2 text-gray-500 shadow-xs" aria-label="Toggle menu">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="7" x2="20" y2="7"></line><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="17" x2="20" y2="17"></line></svg>
                </button>
            </div>
        </div>

        {{-- Mobile sidebar overlay --}}
        <div id="sidebar-overlay" class="hidden fixed inset-0 z-40 bg-gray-900/50 lg:hidden" onclick="toggleSidebar()"></div>
        <aside id="mobile-sidebar" class="hidden fixed inset-y-0 left-0 z-50 w-[280px] bg-white shadow-xl lg:hidden overflow-y-auto">
            <div class="flex items-center justify-between px-5 py-5 border-b border-gray-100">
                <div class="flex items-center gap-2.5">
                    <div class="bg-white border border-gray-150 p-1.5 rounded-xl shadow-xs">
                        <img class="h-7 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                    </div>
                    <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
                </div>
                <button type="button" onclick="toggleSidebar()" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <nav class="px-3 py-4 space-y-1">
                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors duration-150
                              {{ $item['route'] === $activeRoute
                                  ? 'bg-blue-50 text-[#0047D4] font-semibold'
                                  : 'text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]' }}">
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $item['icon'] !!}</svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
            <div class="border-t border-gray-100 px-3 py-4">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 hover:bg-rose-50 hover:text-rose-600 transition-colors duration-150">
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- ======================== MAIN CONTENT ======================== --}}
        <main class="flex-1 lg:ml-[260px] pt-16 lg:pt-0">
            <div class="px-4 py-6 sm:px-6 lg:px-8 lg:py-8 max-w-7xl mx-auto">

                {{-- Page header --}}
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">User Management</h1>
                        <p class="mt-1 text-sm text-gray-500">Manage all users, staff, and admin accounts.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="button" onclick="openModal('create-user-modal')" class="inline-flex items-center gap-2 rounded-xl bg-[#0047D4] px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5v14"></path></svg>
                            Add User
                        </button>
                        <button type="button" onclick="openModal('create-user-modal'); setTimeout(() => document.getElementById('create-role').value = 'Staff', 50)" class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5v14"></path></svg>
                            Add Staff
                        </button>
                    </div>
                </div>

                {{-- Filter / Search bar --}}
                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="relative flex-1">
                        <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>
                        <input type="text" placeholder="Search by name or email..." class="w-full rounded-xl border border-gray-200 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-900 shadow-xs placeholder:text-gray-400 focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-colors duration-150">
                    </div>
                    <select class="rounded-xl border border-gray-200 bg-white py-2.5 px-4 pr-9 text-sm font-medium text-gray-700 shadow-xs focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-colors duration-150">
                        <option>All Roles</option>
                        <option>User</option>
                        <option>Admin</option>
                        <option>Staff</option>
                    </select>
                    <select class="rounded-xl border border-gray-200 bg-white py-2.5 px-4 pr-9 text-sm font-medium text-gray-700 shadow-xs focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-colors duration-150">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Disabled</option>
                    </select>
                </div>

                {{-- Summary cards --}}
                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
                    {{-- Total Users --}}
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50">
                                <svg class="h-5 w-5 text-[#0047D4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Users</p>
                                <p class="text-2xl font-extrabold text-gray-900">{{ $stats['total_users'] }}</p>
                            </div>
                        </div>
                    </div>
                    {{-- Active Staff --}}
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-50">
                                <svg class="h-5 w-5 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Active Staff</p>
                                <p class="text-2xl font-extrabold text-gray-900">{{ $stats['active_staff'] }}</p>
                            </div>
                        </div>
                    </div>
                    {{-- New Users This Month --}}
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50">
                                <svg class="h-5 w-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><line x1="19" y1="8" x2="19" y2="14"></line><line x1="22" y1="11" x2="16" y2="11"></line></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">New Users This Month</p>
                                <p class="text-2xl font-extrabold text-gray-900">{{ $stats['new_this_month'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Users table --}}
                <div class="mt-6 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xs">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="border-b border-gray-100 bg-gray-50/60">
                                <tr>
                                    <th class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wider text-gray-500">Name</th>
                                    <th class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wider text-gray-500">Email</th>
                                    <th class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wider text-gray-500">Phone</th>
                                    <th class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wider text-gray-500">Role</th>
                                    <th class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                                    <th class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wider text-gray-500">Joined</th>
                                    <th class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach ($users as $index => $u)
                                    <tr class="hover:bg-gray-50/50 transition-colors duration-100">
                                        <td class="whitespace-nowrap px-5 py-3.5">
                                            <div class="flex items-center gap-3">
                                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">
                                                    {{ collect(explode(' ', $u['name']))->map(fn($w) => strtoupper(mb_substr($w, 0, 1)))->take(2)->join('') }}
                                                </span>
                                                <span class="font-semibold text-gray-900">{{ $u['name'] }}</span>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-5 py-3.5 text-gray-600">{{ $u['email'] }}</td>
                                        <td class="whitespace-nowrap px-5 py-3.5 text-gray-600">{{ $u['phone'] }}</td>
                                        <td class="whitespace-nowrap px-5 py-3.5">
                                            @if ($u['role'] === 'Admin')
                                                <span class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-semibold text-[#0047D4]">Admin</span>
                                            @elseif ($u['role'] === 'Staff')
                                                <span class="inline-flex items-center rounded-lg bg-purple-50 px-2.5 py-1 text-xs font-semibold text-purple-700">Staff</span>
                                            @else
                                                <span class="inline-flex items-center rounded-lg bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-600">User</span>
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-5 py-3.5">
                                            @if ($u['status'] === 'Active')
                                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Active
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-rose-600">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span> Disabled
                                                </span>
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-5 py-3.5 text-gray-500">{{ \Carbon\Carbon::parse($u['joined'])->format('M d, Y') }}</td>
                                        <td class="whitespace-nowrap px-5 py-3.5 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button type="button" onclick="openEditModal({{ $index }})" class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">Edit</button>
                                                @if ($u['status'] === 'Active')
                                                    <button type="button" class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-rose-600 hover:bg-rose-50 hover:border-rose-200 transition-colors duration-150">Disable</button>
                                                @else
                                                    <button type="button" class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-emerald-600 hover:bg-emerald-50 hover:border-emerald-200 transition-colors duration-150">Enable</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="flex flex-col items-center justify-between gap-3 border-t border-gray-100 px-5 py-4 sm:flex-row">
                        <p class="text-sm text-gray-500">Showing <span class="font-semibold text-gray-700">1</span> to <span class="font-semibold text-gray-700">10</span> of <span class="font-semibold text-gray-700">328</span> users</p>
                        <div class="flex items-center gap-1.5">
                            <button class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-sm font-medium text-gray-400 cursor-not-allowed" disabled>Previous</button>
                            <button class="rounded-lg bg-[#0047D4] px-3 py-1.5 text-sm font-semibold text-white shadow-xs">1</button>
                            <button class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">2</button>
                            <button class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">3</button>
                            <span class="px-1 text-gray-400">...</span>
                            <button class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">33</button>
                            <button class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- ======================== CREATE USER MODAL ======================== --}}
    <div id="create-user-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm" onclick="closeModal('create-user-modal')"></div>
        <div class="relative w-full max-w-lg rounded-3xl bg-white p-6 shadow-xl sm:p-8">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-extrabold text-gray-900">Create User</h2>
                <button type="button" onclick="closeModal('create-user-modal')" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors duration-150">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form class="mt-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Name</label>
                    <input type="text" placeholder="Full name" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder:text-gray-400 focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-colors duration-150">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" placeholder="email@example.com" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder:text-gray-400 focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-colors duration-150">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Phone</label>
                    <input type="tel" placeholder="0812-xxxx-xxxx" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder:text-gray-400 focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-colors duration-150">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Role</label>
                    <select id="create-role" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 shadow-xs focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-colors duration-150">
                        <option>User</option>
                        <option>Admin</option>
                        <option>Staff</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <input type="password" placeholder="Min. 8 characters" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder:text-gray-400 focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-colors duration-150">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Confirm Password</label>
                    <input type="password" placeholder="Repeat password" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder:text-gray-400 focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-colors duration-150">
                </div>
                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal('create-user-modal')" class="rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors duration-150">Cancel</button>
                    <button type="submit" class="rounded-xl bg-[#0047D4] px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">Create</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ======================== EDIT USER MODAL ======================== --}}
    <div id="edit-user-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm" onclick="closeModal('edit-user-modal')"></div>
        <div class="relative w-full max-w-lg rounded-3xl bg-white p-6 shadow-xl sm:p-8">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-extrabold text-gray-900">Edit User</h2>
                <button type="button" onclick="closeModal('edit-user-modal')" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors duration-150">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form class="mt-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Name</label>
                    <input type="text" id="edit-name" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-colors duration-150">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" id="edit-email" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-colors duration-150">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Phone</label>
                    <input type="tel" id="edit-phone" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-colors duration-150">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Role</label>
                    <select id="edit-role" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 shadow-xs focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-colors duration-150">
                        <option>User</option>
                        <option>Admin</option>
                        <option>Staff</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
                    <div class="flex items-center gap-3">
                        <button type="button" id="edit-status-toggle" onclick="toggleEditStatus()" class="relative inline-flex h-6 w-11 items-center rounded-full bg-emerald-500 transition-colors duration-200">
                            <span id="edit-status-dot" class="inline-block h-4 w-4 translate-x-6 rounded-full bg-white shadow-sm transition-transform duration-200"></span>
                        </button>
                        <span id="edit-status-label" class="text-sm font-medium text-emerald-700">Active</span>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal('edit-user-modal')" class="rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors duration-150">Cancel</button>
                    <button type="submit" class="rounded-xl bg-[#0047D4] px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const usersData = @json($users);
        let editStatusActive = true;

        function toggleSidebar() {
            document.getElementById('mobile-sidebar').classList.toggle('hidden');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
        }

        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = '';
        }

        function openEditModal(index) {
            const user = usersData[index];
            document.getElementById('edit-name').value = user.name;
            document.getElementById('edit-email').value = user.email;
            document.getElementById('edit-phone').value = user.phone;
            document.getElementById('edit-role').value = user.role;

            editStatusActive = user.status === 'Active';
            updateStatusToggle();
            openModal('edit-user-modal');
        }

        function toggleEditStatus() {
            editStatusActive = !editStatusActive;
            updateStatusToggle();
        }

        function updateStatusToggle() {
            const toggle = document.getElementById('edit-status-toggle');
            const dot = document.getElementById('edit-status-dot');
            const label = document.getElementById('edit-status-label');

            if (editStatusActive) {
                toggle.className = 'relative inline-flex h-6 w-11 items-center rounded-full bg-emerald-500 transition-colors duration-200';
                dot.className = 'inline-block h-4 w-4 translate-x-6 rounded-full bg-white shadow-sm transition-transform duration-200';
                label.textContent = 'Active';
                label.className = 'text-sm font-medium text-emerald-700';
            } else {
                toggle.className = 'relative inline-flex h-6 w-11 items-center rounded-full bg-gray-300 transition-colors duration-200';
                dot.className = 'inline-block h-4 w-4 translate-x-1 rounded-full bg-white shadow-sm transition-transform duration-200';
                label.textContent = 'Disabled';
                label.className = 'text-sm font-medium text-rose-600';
            }
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeModal('create-user-modal');
                closeModal('edit-user-modal');
            }
        });
    </script>
</body>
</html>
