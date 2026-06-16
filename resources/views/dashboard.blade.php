<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SportOps</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    @php
        // $user and $upcomingBooking are provided by the DashboardController
        $quickActions = [
            ['label' => 'Book Court',      'href' => route('booking'),  'icon' => '<path d="M5 12h14M12 5v14"></path>'],
            ['label' => 'View Schedule',   'href' => '#schedule',       'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path>'],
            ['label' => 'My Bookings',     'href' => route('bookings'), 'icon' => '<path d="M3 3v5h5"></path><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"></path><path d="M12 7v5l4 2"></path>'],
            ['label' => 'Edit Profile',    'href' => '#profile',        'icon' => '<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>'],
        ];
    @endphp

    <!-- ============================ TOP NAVIGATION ============================ -->
    <header class="sticky top-0 z-50 border-b border-gray-100 bg-white/80 backdrop-blur-md">
        <nav class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
            <!-- Brand -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 select-none">
                <div class="bg-white border border-gray-150 p-1.5 rounded-xl shadow-xs">
                    <img class="h-7 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                </div>
                <span class="hidden text-lg font-extrabold tracking-tight text-gray-900 sm:inline">SportOps</span>
            </a>

            <!-- Center nav links -->
            <div class="hidden items-center gap-1 lg:flex">
                <a href="#" class="rounded-lg bg-blue-50 px-3.5 py-2 text-sm font-semibold text-[#0047D4]">Dashboard</a>
                <a href="{{ route('booking') }}" class="rounded-lg px-3.5 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-[#0047D4] transition-colors duration-150">Book a Court</a>
                <a href="{{ route('bookings') }}" class="rounded-lg px-3.5 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-[#0047D4] transition-colors duration-150">My Bookings</a>
                <a href="#schedule" class="rounded-lg px-3.5 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-[#0047D4] transition-colors duration-150">Schedule</a>
            </div>

            <!-- Right cluster -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Notifications -->
                <button type="button" class="relative inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs hover:text-[#0047D4] hover:border-blue-200 transition-colors duration-150" aria-label="Notifications">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.268 21a2 2 0 0 0 3.464 0"></path>
                        <path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"></path>
                    </svg>
                    <span class="absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-[#0047D4] text-[9px] font-bold text-white ring-2 ring-white">3</span>
                </button>

                <!-- Profile dropdown -->
                <div class="relative">
                    <button type="button" onclick="toggleProfileMenu()" class="flex items-center gap-2 rounded-xl border border-gray-150 bg-white p-1 pr-2 shadow-xs hover:border-blue-200 transition-colors duration-150">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $user['initials'] }}</span>
                        <span class="hidden text-sm font-semibold text-gray-700 sm:inline">{{ $user['first'] }}</span>
                        <svg class="hidden h-4 w-4 text-gray-400 sm:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"></path></svg>
                    </button>

                    <div id="profile-menu" class="hidden absolute right-0 mt-2 w-56 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl shadow-gray-900/10">
                        <div class="border-b border-gray-50 px-4 py-3">
                            <p class="text-sm font-bold text-gray-900">{{ $user['name'] }}</p>
                            <p class="truncate text-xs text-gray-500">{{ $user['email'] }}</p>
                        </div>
                        <div class="py-1">
                            <a href="#profile" class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]">My Profile</a>
                            <a href="{{ route('bookings') }}" class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]">My Bookings</a>
                            <a href="#" class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]">Settings</a>
                        </div>
                        <div class="border-t border-gray-50 py-1">
                            <a href="{{ route('login') }}" class="block px-4 py-2.5 text-sm font-medium text-rose-600 hover:bg-rose-50">Sign out</a>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu toggle -->
                <button type="button" onclick="toggleMobileMenu()" class="lg:hidden inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs" aria-label="Toggle menu">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="7" x2="20" y2="7"></line><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="17" x2="20" y2="17"></line></svg>
                </button>
            </div>
        </nav>

        <!-- Mobile nav links -->
        <div id="mobile-menu" class="hidden border-t border-gray-100 bg-white px-4 py-3 lg:hidden">
            <div class="flex flex-col gap-1">
                <a href="#" class="rounded-lg bg-blue-50 px-3 py-2.5 text-sm font-semibold text-[#0047D4]">Dashboard</a>
                <a href="{{ route('booking') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Book a Court</a>
                <a href="{{ route('bookings') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">My Bookings</a>
                <a href="#schedule" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Schedule</a>
            </div>
        </div>
    </header>

    <!-- ============================ PAGE BODY ============================ -->
    <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

        <!-- ---------------------- HERO WELCOME ---------------------- -->
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#00277a] via-[#0047D4] to-indigo-700 p-6 shadow-xl shadow-blue-900/10 sm:p-10">
            <!-- glassmorphism decorative orbs -->
            <div class="pointer-events-none absolute -right-10 -top-16 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>
            <div class="pointer-events-none absolute -bottom-20 right-24 h-56 w-56 rounded-full bg-[#D7F23D]/20 blur-3xl"></div>
            <div class="pointer-events-none absolute -left-12 bottom-0 h-48 w-48 rounded-full bg-sky-300/20 blur-2xl"></div>

            <div class="relative max-w-2xl">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold text-white/90 backdrop-blur">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#D7F23D]"></span> SportOps Arena · Today
                </span>
                <h1 class="mt-4 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    Welcome back, {{ $user['first'] }} 👋
                </h1>
                <p class="mt-2 text-base text-blue-100/90">Book your next game in seconds.</p>

                <!-- Primary CTA -->
                <div class="mt-6">
                    <a href="{{ route('booking') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#D7F23D] px-7 py-3.5 text-sm font-bold text-[#1c2a00] shadow-lg shadow-black/10 hover:bg-[#c8e62f] active:scale-[0.99] transition-all duration-200">
                        Book Now
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- ---------------------- MAIN GRID: content + sidebar ---------------------- -->
        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

            <!-- ============ SIDEBAR CARDS ============ -->

                <!-- Profile Summary -->
                <section id="profile" class="rounded-3xl border border-gray-100 bg-white p-6 shadow-xs">
                    <div class="flex items-center gap-4">
                        <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-[#0047D4] to-indigo-600 text-lg font-bold text-white shadow-lg shadow-blue-500/20">{{ $user['initials'] }}</span>
                        <div class="min-w-0">
                            <p class="truncate text-base font-bold text-gray-900">{{ $user['name'] }}</p>
                            <p class="truncate text-xs text-gray-500">{{ $user['email'] }}</p>
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="rounded-2xl bg-gray-50 p-3 text-center">
                            <p class="text-xl font-extrabold text-gray-900">{{ $user['bookings'] }}</p>
                            <p class="text-xs text-gray-500">Total bookings</p>
                        </div>
                    </div>
                    <a href="{{ route('bookings') }}" class="mt-4 inline-flex w-full items-center justify-center rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">
                        View my bookings
                    </a>
                </section>

                <!-- Upcoming Booking -->
                <section class="relative overflow-hidden rounded-3xl border border-blue-100 bg-gradient-to-br from-blue-50 to-white p-6 shadow-xs">
                    <div class="pointer-events-none absolute -right-8 -top-8 h-28 w-28 rounded-full bg-blue-200/40 blur-2xl"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-bold uppercase tracking-wider text-[#0047D4]">Upcoming Booking</h2>
                            @if($upcomingBooking)
                                <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">{{ ucfirst($upcomingBooking->status) }}</span>
                            @endif
                        </div>
                        
                        @if($upcomingBooking)
                            <p class="mt-3 text-lg font-extrabold text-gray-900">{{ $upcomingBooking->field ? $upcomingBooking->field->nama_lapangan : 'Court' }}</p>
                            <div class="mt-4 space-y-2.5 text-sm text-gray-600">
                                <div class="flex items-center gap-2.5">
                                    <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path></svg>
                                    {{ \Carbon\Carbon::parse($upcomingBooking->tanggal)->format('l, F j, Y') }}
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path></svg>
                                    {{ \Carbon\Carbon::parse($upcomingBooking->jam_mulai)->format('H:i') }} — {{ \Carbon\Carbon::parse($upcomingBooking->jam_selesai)->format('H:i') }}
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"></rect><path d="M2 10h20"></path></svg>
                                    Total: Rp{{ number_format($upcomingBooking->total_harga, 0, ',', '.') }}
                                </div>
                            </div>
                            <a href="{{ route('bookings') }}" class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#0047D4] px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                                View Details
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                            </a>
                        @else
                            <div class="mt-8 text-center">
                                <p class="text-sm text-gray-500">You don't have any upcoming bookings.</p>
                                <a href="{{ route('booking') }}" class="mt-4 inline-block rounded-xl border border-blue-200 bg-white px-4 py-2 text-xs font-semibold text-[#0047D4] shadow-xs hover:bg-blue-50">Book a Court</a>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Quick Actions -->
                <section>
                    <h2 class="text-sm font-bold uppercase tracking-wider text-gray-500">Quick Actions</h2>
                    <div class="mt-3 grid grid-cols-2 gap-3">
                        @foreach ($quickActions as $action)
                            <a href="{{ $action['href'] }}" class="group flex flex-col items-center justify-center gap-2 rounded-2xl border border-gray-100 bg-white p-4 text-center shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md">
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#0047D4] transition-colors duration-200 group-hover:bg-[#0047D4] group-hover:text-white">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $action['icon'] !!}</svg>
                                </span>
                                <span class="text-xs font-semibold text-gray-700">{{ $action['label'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </section>
        </div>

        <!-- ---------------------- SCHEDULE (date-aware; logged-in users browse any date) ---------------------- -->
        <x-schedule-board :authed="true" :inMain="true" title="Court Schedule" />
    </main>

    <!-- ============================ FOOTER ============================ -->
    <footer class="mt-8 border-t border-gray-100 bg-white">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-4 py-6 sm:flex-row sm:px-6 lg:px-8">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} SportOps. All rights reserved.</p>
            <div class="flex items-center gap-5 text-sm text-gray-400">
                <a href="#" class="hover:text-[#0047D4] transition-colors duration-150">Help</a>
                <a href="#" class="hover:text-[#0047D4] transition-colors duration-150">Privacy</a>
                <a href="#" class="hover:text-[#0047D4] transition-colors duration-150">Terms</a>
            </div>
        </div>
    </footer>

    <!-- Interactivity: profile dropdown + mobile menu -->
    <script>
        function toggleProfileMenu() {
            document.getElementById('profile-menu').classList.toggle('hidden');
        }
        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }
        // Close the profile dropdown when clicking outside of it
        document.addEventListener('click', function (e) {
            const menu = document.getElementById('profile-menu');
            const trigger = e.target.closest('[onclick="toggleProfileMenu()"]');
            if (!trigger && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
