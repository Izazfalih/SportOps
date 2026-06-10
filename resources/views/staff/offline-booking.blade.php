<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline Booking | SportOps</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    @php
        $staff = [
            'name'     => 'Dewi Sartika',
            'initials' => 'DS',
            'email'    => 'dewi@sportops.id',
        ];

        $navItems = [
            ['label' => 'Dashboard',        'route' => 'staff.dashboard',        'active' => false, 'icon' => '<rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/>'],
            ['label' => "Today's Schedule",  'route' => 'staff.schedule',         'active' => false, 'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01M16 18h.01"/>'],
            ['label' => 'Check-In',          'route' => 'staff.checkin',          'active' => false, 'icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>'],
            ['label' => 'Offline Booking',   'route' => 'staff.offline-booking',  'active' => true,  'icon' => '<path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/><circle cx="12" cy="12" r="4"/>'],
            ['label' => 'Settlement',        'route' => 'staff.settlement',       'active' => false, 'icon' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>'],
        ];

        $sports = [
            ['id' => 'futsal',      'name' => 'Futsal',      'price' => 150000, 'icon' => '⚽', 'available' => true],
            ['id' => 'badminton',   'name' => 'Badminton',   'price' => 75000,  'icon' => '🏸', 'available' => true],
            ['id' => 'tennis',      'name' => 'Tennis',      'price' => 120000, 'icon' => '🎾', 'available' => false, 'note' => 'Maintenance'],
            ['id' => 'basketball',  'name' => 'Basketball',  'price' => 200000, 'icon' => '🏀', 'available' => true],
            ['id' => 'volleyball',  'name' => 'Volleyball',  'price' => 100000, 'icon' => '🏐', 'available' => true],
        ];

        $timeSlots = [
            ['time' => '08:00 – 09:00', 'hour' => '08:00', 'status' => 'available'],
            ['time' => '09:00 – 10:00', 'hour' => '09:00', 'status' => 'booked'],
            ['time' => '10:00 – 11:00', 'hour' => '10:00', 'status' => 'available'],
            ['time' => '11:00 – 12:00', 'hour' => '11:00', 'status' => 'available'],
            ['time' => '12:00 – 13:00', 'hour' => '12:00', 'status' => 'booked'],
            ['time' => '13:00 – 14:00', 'hour' => '13:00', 'status' => 'available'],
            ['time' => '14:00 – 15:00', 'hour' => '14:00', 'status' => 'booked'],
            ['time' => '15:00 – 16:00', 'hour' => '15:00', 'status' => 'available'],
            ['time' => '16:00 – 17:00', 'hour' => '16:00', 'status' => 'available'],
            ['time' => '17:00 – 18:00', 'hour' => '17:00', 'status' => 'available'],
            ['time' => '18:00 – 19:00', 'hour' => '18:00', 'status' => 'booked'],
            ['time' => '19:00 – 20:00', 'hour' => '19:00', 'status' => 'available'],
            ['time' => '20:00 – 21:00', 'hour' => '20:00', 'status' => 'available'],
            ['time' => '21:00 – 22:00', 'hour' => '21:00', 'status' => 'available'],
        ];

        $courtSchedules = [
            [
                'court' => 'Futsal Court A',
                'sport' => 'Futsal',
                'color' => 'bg-blue-500',
                'slots' => [
                    ['time' => '09:00 – 10:00', 'customer' => 'Ahmad Fauzi'],
                    ['time' => '12:00 – 13:00', 'customer' => 'Budi Santoso'],
                    ['time' => '14:00 – 15:00', 'customer' => 'Rina A.'],
                    ['time' => '18:00 – 19:00', 'customer' => 'Dimas P.'],
                ],
            ],
            [
                'court' => 'Badminton Court 1',
                'sport' => 'Badminton',
                'color' => 'bg-emerald-500',
                'slots' => [
                    ['time' => '10:00 – 11:00', 'customer' => 'Sarah Putri'],
                    ['time' => '15:00 – 16:00', 'customer' => 'Fajar H.'],
                ],
            ],
            [
                'court' => 'Basketball Court',
                'sport' => 'Basketball',
                'color' => 'bg-amber-500',
                'slots' => [
                    ['time' => '09:00 – 10:00', 'customer' => 'Team Alpha'],
                    ['time' => '14:00 – 15:00', 'customer' => 'Team Bravo'],
                    ['time' => '18:00 – 19:00', 'customer' => 'Team Charlie'],
                ],
            ],
            [
                'court' => 'Volleyball Court',
                'sport' => 'Volleyball',
                'color' => 'bg-violet-500',
                'slots' => [
                    ['time' => '11:00 – 12:00', 'customer' => 'Club Merpati'],
                ],
            ],
            [
                'court' => 'Tennis Court',
                'sport' => 'Tennis',
                'color' => 'bg-rose-400',
                'slots' => [],
                'note'  => 'Under Maintenance',
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

    {{-- ==================== MAIN CONTENT ==================== --}}
    <div class="min-h-full transition-all duration-300 lg:ml-[280px]">

        {{-- Top header bar --}}
        <header class="sticky top-0 z-30 border-b border-gray-100 bg-white/80 backdrop-blur-md">
            <div class="flex items-center justify-between px-4 py-3.5 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3">
                    <button type="button" onclick="openSidebar()" class="inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs lg:hidden" aria-label="Open sidebar">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
                    </button>
                    <div>
                        <h1 class="text-xl font-extrabold tracking-tight text-gray-900 sm:text-2xl">Offline Booking</h1>
                        <p class="text-sm text-gray-500">Create walk-in bookings for customers</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" class="relative inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs hover:text-[#0047D4] hover:border-blue-200 transition-colors duration-150" aria-label="Notifications">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.268 21a2 2 0 0 0 3.464 0"/>
                            <path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"/>
                        </svg>
                        <span class="absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-[#0047D4] text-[9px] font-bold text-white ring-2 ring-white">2</span>
                    </button>

                    <div class="flex items-center gap-2.5 rounded-xl border border-gray-150 bg-white p-1 pr-3 shadow-xs">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $staff['initials'] }}</span>
                        <span class="hidden text-sm font-semibold text-gray-700 sm:inline">{{ $staff['name'] }}</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Page content --}}
        <main class="px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

            {{-- ============ BOOKING FORM + COURT OVERVIEW — TWO COLUMN ============ --}}
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-5">

                {{-- ===================== LEFT COLUMN: Walk-In Booking Form ===================== --}}
                <div class="xl:col-span-3">

                    {{-- Form card --}}
                    <div id="booking-form-card" class="rounded-2xl border border-gray-100 bg-white shadow-xs">
                        <div class="border-b border-gray-100 px-6 py-5">
                            <h2 class="text-lg font-bold text-gray-900">Create Walk-In Booking</h2>
                            <p class="mt-1 text-sm text-gray-500">Fill in the details below to book a court for a walk-in customer.</p>
                        </div>

                        <form id="booking-form" class="p-6 space-y-6" onsubmit="return false;">

                            {{-- Customer Info --}}
                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="customer-name" class="block text-sm font-semibold text-gray-700 mb-1.5">Customer Name <span class="text-rose-500">*</span></label>
                                    <input type="text" id="customer-name" required placeholder="e.g. Ahmad Fauzi"
                                           class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-xs transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10 focus:outline-none">
                                </div>
                                <div>
                                    <label for="phone-number" class="block text-sm font-semibold text-gray-700 mb-1.5">Phone Number <span class="text-rose-500">*</span></label>
                                    <input type="tel" id="phone-number" required placeholder="e.g. 08123456789"
                                           class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-xs transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10 focus:outline-none">
                                </div>
                            </div>

                            {{-- Sport Selection --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Select Sport <span class="text-rose-500">*</span></label>
                                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">
                                    @foreach ($sports as $sport)
                                        <button type="button"
                                                data-sport="{{ $sport['id'] }}"
                                                data-price="{{ $sport['price'] }}"
                                                data-name="{{ $sport['name'] }}"
                                                onclick="{{ $sport['available'] ? 'selectSport(this)' : '' }}"
                                                class="sport-card group relative flex flex-col items-center gap-2 rounded-2xl border-2 p-4 text-center transition-all duration-200
                                                       {{ $sport['available']
                                                           ? 'border-gray-100 bg-white hover:border-blue-200 hover:shadow-md hover:-translate-y-0.5 cursor-pointer'
                                                           : 'border-gray-100 bg-gray-50 opacity-60 cursor-not-allowed' }}"
                                                {{ !$sport['available'] ? 'disabled' : '' }}>
                                            <span class="text-2xl">{{ $sport['icon'] }}</span>
                                            <span class="text-sm font-bold text-gray-900">{{ $sport['name'] }}</span>
                                            <span class="text-xs font-medium text-gray-500">Rp {{ number_format($sport['price'], 0, ',', '.') }}/hr</span>
                                            @if (!$sport['available'])
                                                <span class="absolute -top-2 -right-2 rounded-full bg-rose-100 px-2 py-0.5 text-[10px] font-bold text-rose-600">{{ $sport['note'] ?? 'Unavailable' }}</span>
                                            @endif
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Date Picker --}}
                            <div>
                                <label for="booking-date" class="block text-sm font-semibold text-gray-700 mb-1.5">Date</label>
                                <input type="date" id="booking-date" value="{{ date('Y-m-d') }}"
                                       class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-xs transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10 focus:outline-none sm:max-w-xs">
                            </div>

                            {{-- Available Time Slots --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Available Time Slots</label>
                                <p class="text-xs text-gray-400 mb-3">Click on an available slot to select it</p>
                                <div class="grid grid-cols-2 gap-2.5 sm:grid-cols-4 lg:grid-cols-7">
                                    @foreach ($timeSlots as $slot)
                                        @if ($slot['status'] === 'booked')
                                            <div class="flex flex-col items-center justify-center rounded-xl border-2 border-gray-100 bg-gray-50 px-2 py-3 cursor-not-allowed">
                                                <span class="text-sm font-semibold text-gray-400">{{ $slot['hour'] }}</span>
                                                <span class="mt-0.5 text-[10px] font-bold uppercase tracking-wide text-gray-400">Booked</span>
                                            </div>
                                        @else
                                            <button type="button"
                                                    data-time="{{ $slot['time'] }}"
                                                    data-hour="{{ $slot['hour'] }}"
                                                    onclick="selectTimeSlot(this)"
                                                    class="time-slot flex flex-col items-center justify-center rounded-xl border-2 border-blue-100 bg-blue-50/40 px-2 py-3 transition-all duration-200 hover:border-[#0047D4] hover:bg-blue-50 hover:shadow-md cursor-pointer">
                                                <span class="text-sm font-semibold text-gray-700">{{ $slot['hour'] }}</span>
                                                <span class="mt-0.5 text-[10px] font-medium text-blue-600">Available</span>
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            {{-- Payment Type --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Payment Type <span class="text-rose-500">*</span></label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="payment-option group">
                                        <input type="radio" name="payment-type" value="dp" class="peer sr-only" checked onchange="updateSummary()">
                                        <div class="flex items-center gap-3 rounded-xl border-2 border-gray-100 bg-white px-5 py-3.5 cursor-pointer transition-all duration-200 peer-checked:border-[#0047D4] peer-checked:bg-blue-50/50 peer-checked:shadow-lg peer-checked:shadow-blue-500/10 hover:border-blue-200">
                                            <span class="flex h-5 w-5 items-center justify-center rounded-full border-2 border-gray-300 transition-colors duration-200 peer-checked:border-[#0047D4] peer-checked:bg-[#0047D4] group-has-[:checked]:border-[#0047D4] group-has-[:checked]:bg-[#0047D4]">
                                                <svg class="h-3 w-3 text-white opacity-0 transition-opacity duration-200 group-has-[:checked]:opacity-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                            </span>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900">Down Payment (50%)</p>
                                                <p class="text-xs text-gray-500">Pay half now, rest later</p>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="payment-option group">
                                        <input type="radio" name="payment-type" value="full" class="peer sr-only" onchange="updateSummary()">
                                        <div class="flex items-center gap-3 rounded-xl border-2 border-gray-100 bg-white px-5 py-3.5 cursor-pointer transition-all duration-200 peer-checked:border-[#0047D4] peer-checked:bg-blue-50/50 peer-checked:shadow-lg peer-checked:shadow-blue-500/10 hover:border-blue-200">
                                            <span class="flex h-5 w-5 items-center justify-center rounded-full border-2 border-gray-300 transition-colors duration-200 group-has-[:checked]:border-[#0047D4] group-has-[:checked]:bg-[#0047D4]">
                                                <svg class="h-3 w-3 text-white opacity-0 transition-opacity duration-200 group-has-[:checked]:opacity-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                            </span>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900">Full Payment</p>
                                                <p class="text-xs text-gray-500">Pay full amount now</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            {{-- Booking Summary --}}
                            <div id="booking-summary" class="hidden rounded-2xl border border-blue-100 bg-gradient-to-br from-blue-50/60 to-white p-5">
                                <h3 class="text-sm font-bold uppercase tracking-wider text-[#0047D4]">Booking Summary</h3>
                                <div class="mt-4 space-y-3">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Court</span>
                                        <span id="summary-court" class="font-semibold text-gray-900">—</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Date</span>
                                        <span id="summary-date" class="font-semibold text-gray-900">—</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Time</span>
                                        <span id="summary-time" class="font-semibold text-gray-900">—</span>
                                    </div>
                                    <div class="h-px bg-blue-100"></div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Price</span>
                                        <span id="summary-price" class="font-semibold text-gray-900">—</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-bold text-gray-900">Payment Amount</span>
                                        <span id="summary-payment" class="text-lg font-extrabold text-[#0047D4]">—</span>
                                    </div>
                                    <p id="summary-payment-label" class="text-right text-xs text-gray-400"></p>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button type="button" id="submit-booking" onclick="createBooking()"
                                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#0047D4] px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-500/10 transition-all duration-200 hover:bg-[#003cb5] active:scale-[0.99]">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5v14"/></svg>
                                Create Booking
                            </button>
                        </form>
                    </div>

                    {{-- ============ SUCCESS STATE ============ --}}
                    <div id="booking-success" class="hidden rounded-2xl border border-gray-100 bg-white shadow-xs">
                        <div class="flex flex-col items-center px-6 py-12 text-center">
                            {{-- Animated checkmark --}}
                            <div class="flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 ring-8 ring-emerald-50/50">
                                <svg class="h-10 w-10 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>

                            <h2 class="mt-6 text-2xl font-extrabold tracking-tight text-gray-900">Booking Created Successfully!</h2>
                            <p class="mt-2 text-sm text-gray-500">The walk-in booking has been confirmed.</p>

                            {{-- Booking code --}}
                            <div class="mt-6 rounded-2xl border border-dashed border-blue-200 bg-blue-50/50 px-8 py-4">
                                <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Booking Code</p>
                                <p id="success-code" class="mt-1 text-2xl font-extrabold tracking-widest text-[#0047D4]">WLK-240610-001</p>
                            </div>

                            {{-- Summary details --}}
                            <div class="mt-6 w-full max-w-sm space-y-2.5 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Customer</span>
                                    <span id="success-customer" class="font-semibold text-gray-900">—</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Court</span>
                                    <span id="success-court" class="font-semibold text-gray-900">—</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Date & Time</span>
                                    <span id="success-datetime" class="font-semibold text-gray-900">—</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Payment</span>
                                    <span id="success-payment" class="font-semibold text-emerald-600">—</span>
                                </div>
                            </div>

                            {{-- Action buttons --}}
                            <div class="mt-8 flex flex-col gap-3 w-full max-w-sm sm:flex-row">
                                <button type="button" onclick="resetForm()"
                                        class="flex flex-1 items-center justify-center gap-2 rounded-xl bg-[#0047D4] px-5 py-3 text-sm font-bold text-white shadow-lg shadow-blue-500/10 transition-all duration-200 hover:bg-[#003cb5] active:scale-[0.99]">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5v14"/></svg>
                                    Create Another Booking
                                </button>
                                <button type="button" onclick="window.print()"
                                        class="flex flex-1 items-center justify-center gap-2 rounded-xl border-2 border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-700 transition-all duration-200 hover:border-[#0047D4] hover:text-[#0047D4]">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
                                    Print Receipt
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===================== RIGHT COLUMN: Court Availability Overview ===================== --}}
                <div class="xl:col-span-2 space-y-6">

                    {{-- Today's stats --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                            <div class="flex items-center gap-2.5">
                                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-[#0047D4]">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                </span>
                                <div>
                                    <p class="text-xl font-extrabold text-gray-900">10</p>
                                    <p class="text-xs text-gray-500">Today's Bookings</p>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                            <div class="flex items-center gap-2.5">
                                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                </span>
                                <div>
                                    <p class="text-xl font-extrabold text-gray-900">46</p>
                                    <p class="text-xs text-gray-500">Slots Available</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Court Availability Card --}}
                    <div class="rounded-2xl border border-gray-100 bg-white shadow-xs">
                        <div class="border-b border-gray-100 px-5 py-4">
                            <h2 class="text-base font-bold text-gray-900">Court Availability</h2>
                            <p class="mt-0.5 text-xs text-gray-400">Today, {{ date('d M Y') }}</p>
                        </div>

                        <div class="divide-y divide-gray-50">
                            @foreach ($courtSchedules as $court)
                                <div class="px-5 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <span class="h-2.5 w-2.5 rounded-full {{ $court['color'] }}"></span>
                                        <h3 class="text-sm font-bold text-gray-900">{{ $court['court'] }}</h3>
                                        @if (!empty($court['note']))
                                            <span class="ml-auto rounded-full bg-rose-50 px-2 py-0.5 text-[10px] font-bold text-rose-600">{{ $court['note'] }}</span>
                                        @endif
                                    </div>

                                    @if (count($court['slots']) > 0)
                                        <div class="mt-2.5 flex flex-wrap gap-1.5">
                                            @foreach ($court['slots'] as $slot)
                                                <div class="rounded-lg bg-gray-50 px-2.5 py-1.5">
                                                    <p class="text-[11px] font-semibold text-gray-700">{{ $slot['time'] }}</p>
                                                    <p class="text-[10px] text-gray-400">{{ $slot['customer'] }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @elseif (empty($court['note']))
                                        <p class="mt-2 text-xs text-emerald-600 font-medium">All slots available</p>
                                    @else
                                        <p class="mt-2 text-xs text-gray-400">No bookings — court is closed</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Quick Legend --}}
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs">
                        <h3 class="text-sm font-bold text-gray-900 mb-3">Time Slot Legend</h3>
                        <div class="space-y-2.5">
                            <div class="flex items-center gap-2.5">
                                <span class="h-4 w-8 rounded border-2 border-blue-100 bg-blue-50/40"></span>
                                <span class="text-xs text-gray-600">Available — tap to select</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <span class="h-4 w-8 rounded border-2 border-[#0047D4] bg-[#0047D4]"></span>
                                <span class="text-xs text-gray-600">Selected</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <span class="h-4 w-8 rounded border-2 border-gray-100 bg-gray-50"></span>
                                <span class="text-xs text-gray-600">Booked — unavailable</span>
                            </div>
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

    {{-- ==================== SCRIPTS ==================== --}}
    <script>
        let selectedSport = null;
        let selectedPrice = 0;
        let selectedTime = null;

        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.remove('hidden');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.add('hidden');
        }

        function selectSport(el) {
            document.querySelectorAll('.sport-card').forEach(card => {
                card.classList.remove('border-[#0047D4]', 'bg-blue-50/50', 'shadow-lg', 'shadow-blue-500/10');
                card.classList.add('border-gray-100', 'bg-white');
            });
            el.classList.remove('border-gray-100', 'bg-white');
            el.classList.add('border-[#0047D4]', 'bg-blue-50/50', 'shadow-lg', 'shadow-blue-500/10');

            selectedSport = el.dataset.name;
            selectedPrice = parseInt(el.dataset.price);
            updateSummary();
        }

        function selectTimeSlot(el) {
            document.querySelectorAll('.time-slot').forEach(slot => {
                slot.classList.remove('border-[#0047D4]', 'bg-[#0047D4]');
                slot.classList.add('border-blue-100', 'bg-blue-50/40');
                slot.querySelector('span:first-child').classList.remove('text-white');
                slot.querySelector('span:first-child').classList.add('text-gray-700');
                slot.querySelector('span:last-child').classList.remove('text-blue-100');
                slot.querySelector('span:last-child').classList.add('text-blue-600');
                slot.querySelector('span:last-child').textContent = 'Available';
            });

            el.classList.remove('border-blue-100', 'bg-blue-50/40');
            el.classList.add('border-[#0047D4]', 'bg-[#0047D4]');
            el.querySelector('span:first-child').classList.remove('text-gray-700');
            el.querySelector('span:first-child').classList.add('text-white');
            el.querySelector('span:last-child').classList.remove('text-blue-600');
            el.querySelector('span:last-child').classList.add('text-blue-100');
            el.querySelector('span:last-child').textContent = 'Selected';

            selectedTime = el.dataset.time;
            updateSummary();
        }

        function updateSummary() {
            const summary = document.getElementById('booking-summary');
            if (selectedSport && selectedTime) {
                summary.classList.remove('hidden');

                document.getElementById('summary-court').textContent = selectedSport;

                const dateInput = document.getElementById('booking-date');
                const dateObj = new Date(dateInput.value + 'T00:00:00');
                const formatted = dateObj.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                document.getElementById('summary-date').textContent = formatted;

                document.getElementById('summary-time').textContent = selectedTime;
                document.getElementById('summary-price').textContent = 'Rp ' + selectedPrice.toLocaleString('id-ID');

                const paymentType = document.querySelector('input[name="payment-type"]:checked').value;
                const paymentAmount = paymentType === 'dp' ? Math.round(selectedPrice / 2) : selectedPrice;
                document.getElementById('summary-payment').textContent = 'Rp ' + paymentAmount.toLocaleString('id-ID');
                document.getElementById('summary-payment-label').textContent = paymentType === 'dp' ? 'Down Payment (50%)' : 'Full Payment';
            } else {
                summary.classList.add('hidden');
            }
        }

        function createBooking() {
            const name = document.getElementById('customer-name').value.trim();
            const phone = document.getElementById('phone-number').value.trim();

            if (!name || !phone) {
                alert('Please fill in customer name and phone number.');
                return;
            }
            if (!selectedSport) {
                alert('Please select a sport.');
                return;
            }
            if (!selectedTime) {
                alert('Please select a time slot.');
                return;
            }

            const paymentType = document.querySelector('input[name="payment-type"]:checked').value;
            const paymentAmount = paymentType === 'dp' ? Math.round(selectedPrice / 2) : selectedPrice;

            const dateInput = document.getElementById('booking-date');
            const dateObj = new Date(dateInput.value + 'T00:00:00');
            const formatted = dateObj.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });

            const code = 'WLK-' + dateInput.value.replace(/-/g, '').slice(2) + '-' + String(Math.floor(Math.random() * 999) + 1).padStart(3, '0');

            document.getElementById('success-code').textContent = code;
            document.getElementById('success-customer').textContent = name;
            document.getElementById('success-court').textContent = selectedSport;
            document.getElementById('success-datetime').textContent = formatted + ', ' + selectedTime;
            document.getElementById('success-payment').textContent = (paymentType === 'dp' ? 'DP ' : 'Full ') + 'Rp ' + paymentAmount.toLocaleString('id-ID');

            document.getElementById('booking-form-card').classList.add('hidden');
            document.getElementById('booking-success').classList.remove('hidden');
            document.getElementById('booking-success').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function resetForm() {
            document.getElementById('booking-form').reset();
            document.getElementById('booking-date').value = new Date().toISOString().split('T')[0];

            document.querySelectorAll('.sport-card').forEach(card => {
                card.classList.remove('border-[#0047D4]', 'bg-blue-50/50', 'shadow-lg', 'shadow-blue-500/10');
                if (!card.disabled) {
                    card.classList.add('border-gray-100', 'bg-white');
                }
            });
            document.querySelectorAll('.time-slot').forEach(slot => {
                slot.classList.remove('border-[#0047D4]', 'bg-[#0047D4]');
                slot.classList.add('border-blue-100', 'bg-blue-50/40');
                slot.querySelector('span:first-child').classList.remove('text-white');
                slot.querySelector('span:first-child').classList.add('text-gray-700');
                slot.querySelector('span:last-child').classList.remove('text-blue-100');
                slot.querySelector('span:last-child').classList.add('text-blue-600');
                slot.querySelector('span:last-child').textContent = 'Available';
            });

            selectedSport = null;
            selectedPrice = 0;
            selectedTime = null;

            document.getElementById('booking-summary').classList.add('hidden');
            document.getElementById('booking-success').classList.add('hidden');
            document.getElementById('booking-form-card').classList.remove('hidden');
            document.getElementById('booking-form-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        document.getElementById('booking-date').addEventListener('change', updateSummary);
    </script>
</body>
</html>
