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
        // ----------------------------- Placeholder data -----------------------------
        $user = [
            'name'       => 'Rizky Maulana',
            'first'      => 'Rizky',
            'email'      => 'rizky.maulana@example.com',
            'initials'   => 'RM',
            'membership' => 'Gold Member',
            'bookings'   => 24,
        ];

        // Icons reused across cards
        $icons = [
            'Futsal'         => '<circle cx="12" cy="12" r="9"></circle><path d="m12 3 2.5 4.5L12 12 9.5 7.5 12 3Z"></path><path d="m21 12-5 .8-2.5-4.3M3 12l5 .8 2.5-4.3M16.5 19.5 14 15l4.5-1.5M7.5 19.5 10 15 5.5 13.5"></path>',
            'Premium Futsal' => '<circle cx="12" cy="12" r="9"></circle><path d="m12 3 2.5 4.5L12 12 9.5 7.5 12 3Z"></path><path d="m21 12-5 .8-2.5-4.3M3 12l5 .8 2.5-4.3M16.5 19.5 14 15l4.5-1.5M7.5 19.5 10 15 5.5 13.5"></path>',
            'Badminton'      => '<path d="M14 3 4 13l3 3 4 4 10-10"></path><circle cx="6.5" cy="17.5" r="2.5"></circle><path d="m14 3 7 7"></path>',
            'Basketball'     => '<circle cx="12" cy="12" r="9"></circle><path d="M3 12h18M12 3v18M5.6 5.6c3.5 3.5 9.3 3.5 12.8 0M5.6 18.4c3.5-3.5 9.3-3.5 12.8 0"></path>',
        ];

        // SportOps Arena — one court per sport, matching the Home page (names, prices).
        $courts = [
            ['name' => 'Futsal — Synthetic Grass', 'sport' => 'Futsal',         'rating' => '4.9', 'price' => '120,000', 'status' => 'Available',   'badge' => 'open',    'gradient' => 'from-blue-500 via-blue-600 to-indigo-700'],
            ['name' => 'Premium Futsal — Vinyl',   'sport' => 'Premium Futsal', 'rating' => '4.8', 'price' => '180,000', 'status' => 'Popular',     'badge' => 'popular', 'gradient' => 'from-violet-500 via-purple-600 to-fuchsia-700'],
            ['name' => 'Badminton',                'sport' => 'Badminton',      'rating' => '4.8', 'price' => '50,000',  'status' => 'Available',   'badge' => 'open',    'gradient' => 'from-emerald-500 via-teal-600 to-cyan-700'],
            ['name' => 'Basketball',               'sport' => 'Basketball',     'rating' => '4.7', 'price' => '150,000', 'status' => '2 slots left', 'badge' => 'few',    'gradient' => 'from-orange-400 via-orange-500 to-rose-600'],
        ];

        $badgeStyles = [
            'open'    => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
            'few'     => 'bg-amber-50 text-amber-700 ring-amber-200',
            'popular' => 'bg-[#D7F23D] text-[#1c2a00] ring-[#c4dd2f]',
        ];

        $history = [
            ['id' => 'SPO-10482', 'court' => 'Futsal — Synthetic Grass', 'date' => 'Jun 02, 2026', 'pay' => 'Paid',     'status' => 'Completed'],
            ['id' => 'SPO-10455', 'court' => 'Basketball',               'date' => 'May 28, 2026', 'pay' => 'Paid',     'status' => 'Completed'],
            ['id' => 'SPO-10431', 'court' => 'Badminton',                'date' => 'May 21, 2026', 'pay' => 'Deposit',  'status' => 'Upcoming'],
            ['id' => 'SPO-10398', 'court' => 'Premium Futsal — Vinyl',   'date' => 'May 14, 2026', 'pay' => 'Refunded', 'status' => 'Cancelled'],
            ['id' => 'SPO-10377', 'court' => 'Futsal — Synthetic Grass', 'date' => 'May 09, 2026', 'pay' => 'Paid',     'status' => 'Completed'],
        ];

        $payStyles = [
            'Paid'     => 'bg-emerald-50 text-emerald-700',
            'Deposit'  => 'bg-blue-50 text-[#0047D4]',
            'Refunded' => 'bg-gray-100 text-gray-500',
        ];
        $statusStyles = [
            'Completed' => 'bg-emerald-50 text-emerald-700',
            'Upcoming'  => 'bg-amber-50 text-amber-700',
            'Cancelled' => 'bg-rose-50 text-rose-600',
        ];

        $quickActions = [
            ['label' => 'Book Court',      'href' => route('register'), 'icon' => '<path d="M5 12h14M12 5v14"></path>'],
            ['label' => 'View Schedule',   'href' => '#schedule',       'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path>'],
            ['label' => 'Booking History', 'href' => '#history',        'icon' => '<path d="M3 3v5h5"></path><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"></path><path d="M12 7v5l4 2"></path>'],
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
                <a href="#courts" class="rounded-lg px-3.5 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-[#0047D4] transition-colors duration-150">Explore Courts</a>
                <a href="#history" class="rounded-lg px-3.5 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-[#0047D4] transition-colors duration-150">My Bookings</a>
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
                            <a href="#history" class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]">My Bookings</a>
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
                <a href="#courts" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Explore Courts</a>
                <a href="#history" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">My Bookings</a>
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

                <!-- Search + CTA -->
                <form action="#" method="GET" class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <div class="relative flex-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>
                        </div>
                        <input type="text" placeholder="Search venue, sport, or location"
                            class="w-full rounded-2xl border border-white/30 bg-white/95 py-3.5 pl-12 pr-4 text-sm text-gray-900 placeholder-gray-400 shadow-lg backdrop-blur focus:border-white focus:ring-4 focus:ring-white/30 focus:outline-none transition-all duration-200">
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#D7F23D] px-7 py-3.5 text-sm font-bold text-[#1c2a00] shadow-lg shadow-black/10 hover:bg-[#c8e62f] active:scale-[0.99] transition-all duration-200">
                        Book Now
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                    </button>
                </form>
            </div>
        </section>

        <!-- ---------------------- COURT CATEGORIES (one per sport) ---------------------- -->
        <section class="mt-8">
            <div class="flex items-end justify-between">
                <div>
                    <h2 class="text-lg font-extrabold tracking-tight text-gray-900">Our Courts</h2>
                    <p class="mt-0.5 text-sm text-gray-500">One venue · one court per sport.</p>
                </div>
                <a href="#courts" class="text-sm font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors duration-150">See all courts</a>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-4">
                @foreach ($courts as $cat)
                    <a href="#courts" class="group flex items-center gap-3 rounded-2xl border border-gray-100 bg-white p-4 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#0047D4] transition-colors duration-200 group-hover:bg-[#0047D4] group-hover:text-white">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $icons[$cat['sport']] !!}</svg>
                        </span>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-bold text-gray-900">{{ $cat['sport'] }}</p>
                            <p class="text-xs text-gray-500">1 court available</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- ---------------------- MAIN GRID: content + sidebar ---------------------- -->
        <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-3">

            <!-- ============ LEFT / MAIN COLUMN ============ -->
            <div class="space-y-8 lg:col-span-2">

                <!-- Available Courts -->
                <section id="courts">
                    <div class="flex items-end justify-between">
                        <div>
                            <h2 class="text-lg font-extrabold tracking-tight text-gray-900">Available Courts</h2>
                            <p class="mt-0.5 text-sm text-gray-500">SportOps Arena · book any court by the hour.</p>
                        </div>
                        <a href="#schedule" class="hidden text-sm font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors duration-150 sm:inline">View schedule</a>
                    </div>

                    <div class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-2">
                        @foreach ($courts as $court)
                            <article class="group overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-xs transition-all duration-200 hover:-translate-y-1 hover:shadow-lg">
                                <!-- Image placeholder -->
                                <div class="relative h-36 bg-gradient-to-br {{ $court['gradient'] }}">
                                    <div class="absolute inset-0 bg-black/10"></div>
                                    <span class="absolute left-3 top-3 inline-flex items-center gap-1 rounded-full bg-white/90 px-2.5 py-1 text-[11px] font-bold text-gray-700 shadow-sm backdrop-blur">
                                        {{ $court['sport'] }}
                                    </span>
                                    <span class="absolute right-3 top-3 inline-flex items-center gap-1 rounded-full bg-white/90 px-2 py-1 shadow-sm backdrop-blur">
                                        <svg class="h-3.5 w-3.5 text-[#D7B400]" viewBox="0 0 24 24" fill="currentColor"><path d="m12 2 2.9 6.3 6.9.7-5.1 4.6 1.4 6.8L12 17.3 5.9 20.4l1.4-6.8L2.2 9l6.9-.7L12 2Z"></path></svg>
                                        <span class="text-xs font-bold text-gray-800">{{ $court['rating'] }}</span>
                                    </span>
                                </div>
                                <!-- Body -->
                                <div class="p-4">
                                    <div class="flex items-center justify-between gap-2">
                                        <h3 class="truncate text-base font-bold text-gray-900">{{ $court['name'] }}</h3>
                                        <span class="shrink-0 rounded-full px-2 py-0.5 text-[10px] font-bold ring-1 ring-inset {{ $badgeStyles[$court['badge']] }}">{{ $court['status'] }}</span>
                                    </div>
                                    <div class="mt-4 flex items-center justify-between">
                                        <p class="text-sm">
                                            <span class="text-lg font-extrabold text-[#0047D4]">Rp{{ $court['price'] }}</span>
                                            <span class="font-medium text-gray-400">/hr</span>
                                        </p>
                                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl bg-[#0047D4] px-4 py-2 text-xs font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] hover:shadow-blue-500/20 active:scale-[0.98] transition-all duration-200">
                                            Book Now
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <!-- Booking History -->
                <section id="history">
                    <div class="flex items-end justify-between">
                        <h2 class="text-lg font-extrabold tracking-tight text-gray-900">Booking History</h2>
                        <a href="#" class="text-sm font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors duration-150">Export</a>
                    </div>
                    <div class="mt-4 overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-xs">
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[640px] border-collapse text-sm">
                                <thead>
                                    <tr class="border-b border-gray-100 bg-gray-50/70 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                        <th class="px-5 py-3.5">Booking ID</th>
                                        <th class="px-5 py-3.5">Court</th>
                                        <th class="px-5 py-3.5">Date</th>
                                        <th class="px-5 py-3.5">Payment</th>
                                        <th class="px-5 py-3.5">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($history as $row)
                                        <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50/60 transition-colors duration-150">
                                            <td class="px-5 py-4 font-mono text-xs font-semibold text-gray-500">{{ $row['id'] }}</td>
                                            <td class="px-5 py-4 font-semibold text-gray-900">{{ $row['court'] }}</td>
                                            <td class="px-5 py-4 text-gray-500">{{ $row['date'] }}</td>
                                            <td class="px-5 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $payStyles[$row['pay']] }}">{{ $row['pay'] }}</span></td>
                                            <td class="px-5 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusStyles[$row['status']] }}">{{ $row['status'] }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

            <!-- ============ RIGHT / SIDEBAR COLUMN ============ -->
            <aside class="space-y-6">

                <!-- Profile Summary -->
                <section id="profile" class="rounded-3xl border border-gray-100 bg-white p-6 shadow-xs">
                    <div class="flex items-center gap-4">
                        <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-[#0047D4] to-indigo-600 text-lg font-bold text-white shadow-lg shadow-blue-500/20">{{ $user['initials'] }}</span>
                        <div class="min-w-0">
                            <p class="truncate text-base font-bold text-gray-900">{{ $user['name'] }}</p>
                            <p class="truncate text-xs text-gray-500">{{ $user['email'] }}</p>
                        </div>
                    </div>
                    <div class="mt-5 grid grid-cols-2 gap-3">
                        <div class="rounded-2xl bg-gray-50 p-3 text-center">
                            <p class="text-xl font-extrabold text-gray-900">{{ $user['bookings'] }}</p>
                            <p class="text-xs text-gray-500">Total bookings</p>
                        </div>
                        <div class="rounded-2xl bg-gradient-to-br from-amber-50 to-yellow-50 p-3 text-center ring-1 ring-amber-100">
                            <p class="flex items-center justify-center gap-1 text-sm font-extrabold text-amber-700">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="m12 2 2.9 6.3 6.9.7-5.1 4.6 1.4 6.8L12 17.3 5.9 20.4l1.4-6.8L2.2 9l6.9-.7L12 2Z"></path></svg>
                                Gold
                            </p>
                            <p class="text-xs text-amber-600/80">Membership</p>
                        </div>
                    </div>
                    <a href="#" class="mt-4 inline-flex w-full items-center justify-center rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">
                        Edit Profile
                    </a>
                </section>

                <!-- Upcoming Booking -->
                <section class="relative overflow-hidden rounded-3xl border border-blue-100 bg-gradient-to-br from-blue-50 to-white p-6 shadow-xs">
                    <div class="pointer-events-none absolute -right-8 -top-8 h-28 w-28 rounded-full bg-blue-200/40 blur-2xl"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-bold uppercase tracking-wider text-[#0047D4]">Upcoming Booking</h2>
                            <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">Confirmed</span>
                        </div>
                        <p class="mt-3 text-lg font-extrabold text-gray-900">Badminton</p>
                        <div class="mt-4 space-y-2.5 text-sm text-gray-600">
                            <div class="flex items-center gap-2.5">
                                <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path></svg>
                                Saturday, June 6, 2026
                            </div>
                            <div class="flex items-center gap-2.5">
                                <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path></svg>
                                11:00 — 12:00
                            </div>
                            <div class="flex items-center gap-2.5">
                                <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"></rect><path d="M2 10h20"></path></svg>
                                Deposit paid · Rp25,000
                            </div>
                        </div>
                        <a href="#" class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#0047D4] px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                            View Details
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                        </a>
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
            </aside>
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
