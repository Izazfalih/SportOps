<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | Admin — SportOps</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    @php
        $admin = [
            'name'     => 'Admin SportOps',
            'email'    => 'admin@sportops.id',
            'initials' => 'AS',
        ];

        $venue = [
            'name'    => 'SportOps Arena',
            'address' => 'Jl. Olahraga No. 12, Jakarta Selatan 12345',
            'phone'   => '+62 21 1234 5678',
            'email'   => 'hello@sportops.id',
            'open'    => '08:00',
            'close'   => '23:00',
        ];

        $payment = [
            'dp_percentage' => 50,
            'expiry'        => '1_hour',
            'merchant_name' => 'SportOps Arena',
        ];

        $notifications = [
            'new_bookings'  => true,
            'payments'      => true,
            'cancellations' => false,
        ];

        $navItems = [
            ['label' => 'Dashboard',         'route' => 'admin.dashboard', 'icon' => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9z"/><polyline points="9 22 9 12 15 12 15 22"/>'],
            ['label' => 'Courts Management', 'route' => 'admin.courts',    'icon' => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>'],
            ['label' => 'Bookings',          'route' => 'admin.bookings',  'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
            ['label' => 'Users',             'route' => 'admin.users',     'icon' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
            ['label' => 'Financial Reports', 'route' => 'admin.reports',   'icon' => '<path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/>'],
            ['label' => 'Settings',          'route' => 'admin.settings',  'icon' => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>'],
        ];
    @endphp

    <div class="flex h-full">

        {{-- ======================== SIDEBAR (DESKTOP) ======================== --}}
        <aside class="hidden lg:flex lg:flex-col lg:w-[260px] lg:shrink-0 bg-white border-r border-gray-100">
            {{-- Brand --}}
            <div class="flex items-center gap-2.5 px-5 py-5 border-b border-gray-100">
                <div class="bg-white border border-gray-150 p-1.5 rounded-xl shadow-xs">
                    <img class="h-7 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                </div>
                <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
                @foreach ($navItems as $item)
                    @php $isActive = $item['route'] === 'admin.settings'; @endphp
                    <a href="{{ route($item['route']) }}"
                       class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors duration-150
                              {{ $isActive
                                  ? 'bg-blue-50 text-[#0047D4] font-semibold'
                                  : 'text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]' }}">
                        <svg class="h-5 w-5 shrink-0 {{ $isActive ? 'text-[#0047D4]' : 'text-gray-400 group-hover:text-[#0047D4]' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $item['icon'] !!}</svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            {{-- Admin profile + Logout --}}
            <div class="border-t border-gray-100 px-3 py-4">
                <div class="flex items-center gap-3 px-3 mb-3">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $admin['initials'] }}</span>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-gray-900">{{ $admin['name'] }}</p>
                        <p class="truncate text-xs text-gray-500">{{ $admin['email'] }}</p>
                    </div>
                </div>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-rose-600 hover:bg-rose-50 transition-colors duration-150">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- ======================== MOBILE HEADER ======================== --}}
        <div class="flex flex-1 flex-col min-h-0">
            <header class="lg:hidden sticky top-0 z-50 border-b border-gray-100 bg-white/80 backdrop-blur-md">
                <div class="flex items-center justify-between px-4 py-3">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 select-none">
                        <div class="bg-white border border-gray-150 p-1.5 rounded-xl shadow-xs">
                            <img class="h-7 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                        </div>
                        <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
                    </a>
                    <button type="button" onclick="toggleMobileSidebar()" class="inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs" aria-label="Toggle menu">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
                    </button>
                </div>

                {{-- Mobile nav drawer --}}
                <div id="mobile-sidebar" class="hidden border-t border-gray-100 bg-white px-4 py-3">
                    <nav class="space-y-1">
                        @foreach ($navItems as $item)
                            @php $isActive = $item['route'] === 'admin.settings'; @endphp
                            <a href="{{ route($item['route']) }}"
                               class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors duration-150
                                      {{ $isActive
                                          ? 'bg-blue-50 text-[#0047D4] font-semibold'
                                          : 'text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]' }}">
                                <svg class="h-5 w-5 shrink-0 {{ $isActive ? 'text-[#0047D4]' : 'text-gray-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $item['icon'] !!}</svg>
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </nav>
                    <div class="mt-3 border-t border-gray-100 pt-3">
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-rose-600 hover:bg-rose-50 transition-colors duration-150">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- ======================== MAIN CONTENT ======================== --}}
            <main class="flex-1 overflow-y-auto">
                <div class="mx-auto max-w-4xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

                    {{-- Page header --}}
                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Settings</h1>

                    {{-- ==================== TABS ==================== --}}
                    <div class="mt-6 border-b border-gray-200">
                        <nav class="-mb-px flex gap-1 overflow-x-auto" aria-label="Settings tabs">
                            <button type="button" data-tab="general"
                                    class="settings-tab active whitespace-nowrap rounded-t-xl px-4 py-2.5 text-sm font-semibold transition-colors duration-150 border-b-2 border-[#0047D4] text-[#0047D4]">
                                General
                            </button>
                            <button type="button" data-tab="payment"
                                    class="settings-tab whitespace-nowrap rounded-t-xl px-4 py-2.5 text-sm font-medium transition-colors duration-150 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                Payment
                            </button>
                            <button type="button" data-tab="notifications"
                                    class="settings-tab whitespace-nowrap rounded-t-xl px-4 py-2.5 text-sm font-medium transition-colors duration-150 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                Notifications
                            </button>
                            <button type="button" data-tab="account"
                                    class="settings-tab whitespace-nowrap rounded-t-xl px-4 py-2.5 text-sm font-medium transition-colors duration-150 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                Account
                            </button>
                        </nav>
                    </div>

                    {{-- ==================== GENERAL TAB ==================== --}}
                    <div id="tab-general" class="settings-panel mt-6">
                        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-xs sm:p-8">
                            <h2 class="text-lg font-bold text-gray-900">General Settings</h2>
                            <p class="mt-1 text-sm text-gray-500">Configure your venue's basic information.</p>

                            <form class="mt-6 space-y-5">
                                {{-- Venue Name --}}
                                <div>
                                    <label for="venue-name" class="block text-sm font-semibold text-gray-700">Venue Name</label>
                                    <input type="text" id="venue-name" value="{{ $venue['name'] }}"
                                           class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                                </div>

                                {{-- Venue Address --}}
                                <div>
                                    <label for="venue-address" class="block text-sm font-semibold text-gray-700">Venue Address</label>
                                    <textarea id="venue-address" rows="3"
                                              class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150 resize-none">{{ $venue['address'] }}</textarea>
                                </div>

                                {{-- Contact Phone --}}
                                <div>
                                    <label for="venue-phone" class="block text-sm font-semibold text-gray-700">Contact Phone</label>
                                    <input type="tel" id="venue-phone" value="{{ $venue['phone'] }}"
                                           class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                                </div>

                                {{-- Contact Email --}}
                                <div>
                                    <label for="venue-email" class="block text-sm font-semibold text-gray-700">Contact Email</label>
                                    <input type="email" id="venue-email" value="{{ $venue['email'] }}"
                                           class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                                </div>

                                {{-- Operating Hours --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700">Operating Hours</label>
                                    <div class="mt-1.5 flex items-center gap-3">
                                        <div class="flex-1">
                                            <label for="hours-from" class="sr-only">From</label>
                                            <div class="relative">
                                                <input type="time" id="hours-from" value="{{ $venue['open'] }}"
                                                       class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                                            </div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-400">to</span>
                                        <div class="flex-1">
                                            <label for="hours-to" class="sr-only">To</label>
                                            <div class="relative">
                                                <input type="time" id="hours-to" value="{{ $venue['close'] }}"
                                                       class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Save --}}
                                <div class="flex justify-end pt-2">
                                    <button type="button"
                                            class="inline-flex items-center justify-center rounded-xl bg-[#0047D4] px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- ==================== PAYMENT TAB ==================== --}}
                    <div id="tab-payment" class="settings-panel mt-6 hidden">
                        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-xs sm:p-8">
                            <h2 class="text-lg font-bold text-gray-900">Payment Settings</h2>
                            <p class="mt-1 text-sm text-gray-500">Manage payment methods and down-payment rules.</p>

                            <form class="mt-6 space-y-5">
                                {{-- Payment Method (read-only) --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700">Payment Method</label>
                                    <div class="mt-1.5 flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50 px-4 py-3">
                                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50">
                                            <svg class="h-5 w-5 text-[#0047D4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">QRIS Only</p>
                                            <p class="text-xs text-gray-500">All payments are processed via QRIS</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Down Payment Percentage --}}
                                <div>
                                    <label for="dp-percentage" class="block text-sm font-semibold text-gray-700">Down Payment Percentage</label>
                                    <div class="relative mt-1.5">
                                        <input type="number" id="dp-percentage" value="{{ $payment['dp_percentage'] }}" min="0" max="100"
                                               class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 pr-12 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-sm font-medium text-gray-400">%</span>
                                    </div>
                                    <p class="mt-1.5 text-xs text-gray-500">Percentage of total booking cost required as deposit.</p>
                                </div>

                                {{-- Payment Expiry Time --}}
                                <div>
                                    <label for="payment-expiry" class="block text-sm font-semibold text-gray-700">Payment Expiry Time</label>
                                    <select id="payment-expiry"
                                            class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150 appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2220%22%20height%3D%2220%22%20fill%3D%22none%22%20stroke%3D%22%239ca3af%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpath%20d%3D%22m6%208%204%204%204-4%22%2F%3E%3C%2Fsvg%3E')] bg-[length:20px] bg-[right_12px_center] bg-no-repeat">
                                        <option value="30_min" {{ $payment['expiry'] === '30_min' ? 'selected' : '' }}>30 minutes</option>
                                        <option value="1_hour" {{ $payment['expiry'] === '1_hour' ? 'selected' : '' }}>1 hour</option>
                                        <option value="2_hours" {{ $payment['expiry'] === '2_hours' ? 'selected' : '' }}>2 hours</option>
                                        <option value="24_hours" {{ $payment['expiry'] === '24_hours' ? 'selected' : '' }}>24 hours</option>
                                    </select>
                                    <p class="mt-1.5 text-xs text-gray-500">How long customers have to complete their payment.</p>
                                </div>

                                {{-- QRIS Configuration --}}
                                <div class="border-t border-gray-100 pt-5">
                                    <h3 class="text-sm font-bold text-gray-900">QRIS Configuration</h3>
                                    <p class="mt-1 text-xs text-gray-500">Set up your QRIS merchant details.</p>

                                    <div class="mt-4 space-y-4">
                                        {{-- Merchant Name --}}
                                        <div>
                                            <label for="merchant-name" class="block text-sm font-semibold text-gray-700">Merchant Name</label>
                                            <input type="text" id="merchant-name" value="{{ $payment['merchant_name'] }}"
                                                   class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                                        </div>

                                        {{-- QRIS Image Upload --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700">QRIS Image</label>
                                            <div class="mt-1.5 flex items-center justify-center rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50/50 p-8 transition-colors duration-150 hover:border-[#0047D4]/40 hover:bg-blue-50/30">
                                                <div class="text-center">
                                                    <svg class="mx-auto h-10 w-10 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <rect width="18" height="18" x="3" y="3" rx="2"/>
                                                        <circle cx="9" cy="9" r="2"/>
                                                        <path d="m21 15-3.1-3.1a2 2 0 0 0-2.8 0L6 21"/>
                                                    </svg>
                                                    <p class="mt-3 text-sm font-medium text-gray-600">
                                                        <span class="text-[#0047D4] cursor-pointer hover:underline">Upload QRIS image</span>
                                                        or drag and drop
                                                    </p>
                                                    <p class="mt-1 text-xs text-gray-400">PNG, JPG up to 2MB</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Save --}}
                                <div class="flex justify-end pt-2">
                                    <button type="button"
                                            class="inline-flex items-center justify-center rounded-xl bg-[#0047D4] px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- ==================== NOTIFICATIONS TAB ==================== --}}
                    <div id="tab-notifications" class="settings-panel mt-6 hidden">
                        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-xs sm:p-8">
                            <h2 class="text-lg font-bold text-gray-900">Notification Settings</h2>
                            <p class="mt-1 text-sm text-gray-500">Choose which email notifications you'd like to receive.</p>

                            <form class="mt-6 space-y-1">
                                {{-- New Bookings Toggle --}}
                                <div class="flex items-center justify-between rounded-xl px-4 py-4 hover:bg-gray-50 transition-colors duration-150">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">New booking notifications</p>
                                        <p class="mt-0.5 text-xs text-gray-500">Receive an email when a new booking is made.</p>
                                    </div>
                                    <label class="relative inline-flex cursor-pointer items-center">
                                        <input type="checkbox" class="peer sr-only" {{ $notifications['new_bookings'] ? 'checked' : '' }}>
                                        <div class="h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:bg-white after:shadow-sm after:transition-all after:duration-200 peer-checked:bg-[#0047D4] peer-checked:after:translate-x-full peer-focus:ring-2 peer-focus:ring-[#0047D4]/20"></div>
                                    </label>
                                </div>

                                {{-- Payment Toggle --}}
                                <div class="flex items-center justify-between rounded-xl px-4 py-4 hover:bg-gray-50 transition-colors duration-150">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Payment notifications</p>
                                        <p class="mt-0.5 text-xs text-gray-500">Receive an email when a payment is completed.</p>
                                    </div>
                                    <label class="relative inline-flex cursor-pointer items-center">
                                        <input type="checkbox" class="peer sr-only" {{ $notifications['payments'] ? 'checked' : '' }}>
                                        <div class="h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:bg-white after:shadow-sm after:transition-all after:duration-200 peer-checked:bg-[#0047D4] peer-checked:after:translate-x-full peer-focus:ring-2 peer-focus:ring-[#0047D4]/20"></div>
                                    </label>
                                </div>

                                {{-- Cancellation Toggle --}}
                                <div class="flex items-center justify-between rounded-xl px-4 py-4 hover:bg-gray-50 transition-colors duration-150">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Cancellation notifications</p>
                                        <p class="mt-0.5 text-xs text-gray-500">Receive an email when a booking is cancelled.</p>
                                    </div>
                                    <label class="relative inline-flex cursor-pointer items-center">
                                        <input type="checkbox" class="peer sr-only" {{ $notifications['cancellations'] ? 'checked' : '' }}>
                                        <div class="h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:bg-white after:shadow-sm after:transition-all after:duration-200 peer-checked:bg-[#0047D4] peer-checked:after:translate-x-full peer-focus:ring-2 peer-focus:ring-[#0047D4]/20"></div>
                                    </label>
                                </div>

                                {{-- Save --}}
                                <div class="flex justify-end pt-4">
                                    <button type="button"
                                            class="inline-flex items-center justify-center rounded-xl bg-[#0047D4] px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- ==================== ACCOUNT TAB ==================== --}}
                    <div id="tab-account" class="settings-panel mt-6 hidden">
                        {{-- Profile Info --}}
                        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-xs sm:p-8">
                            <h2 class="text-lg font-bold text-gray-900">Account Settings</h2>
                            <p class="mt-1 text-sm text-gray-500">Manage your admin profile and security.</p>

                            <form class="mt-6 space-y-5">
                                {{-- Admin Profile --}}
                                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-gray-50 p-4">
                                    <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-[#0047D4] to-indigo-600 text-lg font-bold text-white shadow-lg shadow-blue-500/20">{{ $admin['initials'] }}</span>
                                    <div class="min-w-0">
                                        <p class="truncate text-base font-bold text-gray-900">{{ $admin['name'] }}</p>
                                        <p class="truncate text-sm text-gray-500">{{ $admin['email'] }}</p>
                                    </div>
                                </div>

                                {{-- Name --}}
                                <div>
                                    <label for="admin-name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                                    <input type="text" id="admin-name" value="{{ $admin['name'] }}"
                                           class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label for="admin-email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                                    <input type="email" id="admin-email" value="{{ $admin['email'] }}"
                                           class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                                </div>

                                {{-- Change Password section --}}
                                <div class="border-t border-gray-100 pt-5">
                                    <h3 class="text-sm font-bold text-gray-900">Change Password</h3>
                                    <p class="mt-1 text-xs text-gray-500">Leave blank if you don't want to change your password.</p>

                                    <div class="mt-4 space-y-4">
                                        <div>
                                            <label for="current-password" class="block text-sm font-semibold text-gray-700">Current Password</label>
                                            <input type="password" id="current-password" placeholder="Enter current password"
                                                   class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                                        </div>
                                        <div>
                                            <label for="new-password" class="block text-sm font-semibold text-gray-700">New Password</label>
                                            <input type="password" id="new-password" placeholder="Enter new password"
                                                   class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                                        </div>
                                        <div>
                                            <label for="confirm-password" class="block text-sm font-semibold text-gray-700">Confirm New Password</label>
                                            <input type="password" id="confirm-password" placeholder="Confirm new password"
                                                   class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                                        </div>
                                    </div>
                                </div>

                                {{-- Save --}}
                                <div class="flex justify-end pt-2">
                                    <button type="button"
                                            class="inline-flex items-center justify-center rounded-xl bg-[#0047D4] px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <script>
        function toggleMobileSidebar() {
            document.getElementById('mobile-sidebar').classList.toggle('hidden');
        }

        document.querySelectorAll('.settings-tab').forEach(function (tab) {
            tab.addEventListener('click', function () {
                document.querySelectorAll('.settings-tab').forEach(function (t) {
                    t.classList.remove('border-[#0047D4]', 'text-[#0047D4]', 'font-semibold');
                    t.classList.add('border-transparent', 'text-gray-500', 'font-medium');
                });
                tab.classList.remove('border-transparent', 'text-gray-500', 'font-medium');
                tab.classList.add('border-[#0047D4]', 'text-[#0047D4]', 'font-semibold');

                document.querySelectorAll('.settings-panel').forEach(function (panel) {
                    panel.classList.add('hidden');
                });
                document.getElementById('tab-' + tab.dataset.tab).classList.remove('hidden');
            });
        });
    </script>
</body>
</html>
