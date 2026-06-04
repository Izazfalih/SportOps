<!DOCTYPE html>
<html lang="en" class="h-full bg-white scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportOps — Book your court by the hour</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    <!-- ============================ NAVBAR ============================ -->
    <header class="sticky top-0 z-50 border-b border-gray-100 bg-white/80 backdrop-blur-md">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3.5 sm:px-6 lg:px-8">
            <!-- Brand -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 select-none">
                <div class="bg-white border border-gray-150 p-1.5 rounded-xl shadow-xs">
                    <img class="h-7 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                </div>
                <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
            </a>

            <!-- Center links -->
            <div class="hidden items-center gap-8 lg:flex">
                <a href="#schedule" class="text-sm font-medium text-gray-600 hover:text-[#0047D4] transition-colors duration-150">Schedule</a>
                <a href="#pricing" class="text-sm font-medium text-gray-600 hover:text-[#0047D4] transition-colors duration-150">Pricing</a>
                <a href="#contact" class="text-sm font-medium text-gray-600 hover:text-[#0047D4] transition-colors duration-150">Contact</a>
            </div>

            <!-- Right actions -->
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ route('login') }}" class="hidden sm:inline-block px-4 py-2 text-sm font-semibold text-gray-700 hover:text-[#0047D4] transition-colors duration-150">
                    Log In
                </a>
                <a href="{{ route('register') }}" class="hidden sm:inline-flex items-center rounded-xl bg-[#0047D4] px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] hover:shadow-blue-500/20 active:scale-[0.99] transition-all duration-200">
                    Sign Up Free
                </a>
                <!-- Mobile menu toggle -->
                <button type="button" onclick="toggleMobileMenu()" class="lg:hidden inline-flex items-center justify-center rounded-lg p-2 text-gray-600 hover:bg-gray-100 transition-colors duration-150" aria-label="Toggle menu">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="4" y1="7" x2="20" y2="7"></line>
                        <line x1="4" y1="12" x2="20" y2="12"></line>
                        <line x1="4" y1="17" x2="20" y2="17"></line>
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden border-t border-gray-100 bg-white px-4 py-4 lg:hidden">
            <div class="flex flex-col gap-1">
                <a href="#schedule" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Schedule</a>
                <a href="#pricing" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Pricing</a>
                <a href="#contact" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Contact</a>
                <div class="mt-3 flex flex-col gap-2 border-t border-gray-100 pt-3">
                    <a href="{{ route('login') }}" class="rounded-xl border border-gray-200 px-4 py-2.5 text-center text-sm font-semibold text-gray-700 hover:bg-gray-50">Log In</a>
                    <a href="{{ route('register') }}" class="rounded-xl bg-[#0047D4] px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-[#003cb5]">Sign Up Free</a>
                </div>
            </div>
        </div>
    </header>

    <!-- ============================ HERO ============================ -->
    <section class="relative overflow-hidden">
        <!-- Decorative gradient blobs -->
        <div class="pointer-events-none absolute -top-24 right-0 h-[28rem] w-[28rem] rounded-full bg-blue-300/30 blur-3xl"></div>
        <div class="pointer-events-none absolute top-72 -left-24 h-[26rem] w-[26rem] rounded-full bg-[#D7F23D]/40 blur-3xl"></div>

        <div class="relative mx-auto max-w-3xl px-4 pt-20 pb-12 text-center sm:px-6 sm:pt-28 lg:px-8">
            <!-- Pill badge -->
            <div class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white/70 px-4 py-1.5 shadow-xs backdrop-blur">
                <span class="h-2 w-2 rounded-full bg-[#A8C70E]"></span>
                <span class="text-xs font-semibold text-gray-700">SportOps Arena · 4 courts, one venue</span>
            </div>

            <!-- Headline -->
            <h1 class="mt-7 text-4xl font-extrabold leading-[1.1] tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                Book your perfect court.<br>
                Play your best game.
            </h1>

            <!-- Sub copy -->
            <p class="mx-auto mt-5 max-w-xl text-base text-gray-500 leading-relaxed">
                See exactly which slots are open today across every court, then reserve your time
                in seconds. No phone calls, no double bookings.
            </p>

            <!-- CTA buttons -->
            <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                <a href="#schedule" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#0047D4] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] hover:shadow-blue-500/20 active:scale-[0.99] transition-all duration-200 sm:w-auto">
                    View Today's Schedule
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"></path></svg>
                </a>
                <a href="#pricing" class="inline-flex w-full items-center justify-center rounded-xl border border-gray-200 bg-white px-6 py-3.5 text-sm font-semibold text-gray-700 hover:border-[#0047D4] hover:text-[#0047D4] active:scale-[0.99] transition-all duration-200 sm:w-auto">
                    See Pricing
                </a>
            </div>
        </div>
    </section>

    <!-- ============================ SCHEDULE TABLE ============================ -->
    <section id="schedule" class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Today's Schedule</h2>
                <p class="mt-1 text-sm text-gray-500">{{ date('l, F j, Y') }} · tap any open slot to book it.</p>
            </div>
            <!-- Legend -->
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-2 text-xs font-medium text-gray-600">
                    <span class="h-3 w-3 rounded bg-blue-50 ring-1 ring-blue-200"></span> Available
                </span>
                <span class="flex items-center gap-2 text-xs font-medium text-gray-600">
                    <span class="h-3 w-3 rounded bg-gray-100 ring-1 ring-gray-200"></span> Booked
                </span>
            </div>
        </div>

        @php
            $fields = ['Court A', 'Court B', 'Court C', 'Court D'];
            $times  = ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'];
            // Pre-booked slots: time => [courts already taken]
            $booked = [
                '08:00' => ['Court A'],
                '09:00' => ['Court A', 'Court C'],
                '10:00' => ['Court B'],
                '13:00' => ['Court D'],
                '14:00' => ['Court A', 'Court B'],
                '16:00' => ['Court C'],
                '18:00' => ['Court A', 'Court B', 'Court D'],
                '19:00' => ['Court B', 'Court C'],
                '20:00' => ['Court A', 'Court D'],
            ];
        @endphp

        <!-- Mobile hint -->
        <p class="mt-4 text-xs text-gray-400 sm:hidden">Swipe horizontally to see all courts &rarr;</p>

        <!-- Scrollable table wrapper (mobile-friendly) -->
        <div class="mt-3 overflow-x-auto rounded-2xl border border-gray-100 bg-white shadow-xs">
            <table class="w-full min-w-[600px] border-collapse text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="sticky left-0 z-10 bg-white px-4 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Time</th>
                        @foreach ($fields as $field)
                            <th class="px-3 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-700">{{ $field }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($times as $time)
                        <tr class="border-b border-gray-50 last:border-0">
                            <td class="sticky left-0 z-10 bg-white px-4 py-2.5 text-left font-semibold text-gray-700 whitespace-nowrap">{{ $time }}</td>
                            @foreach ($fields as $field)
                                @php $isBooked = in_array($field, $booked[$time] ?? []); @endphp
                                <td class="px-2 py-2 text-center">
                                    @if ($isBooked)
                                        <span class="inline-flex w-full max-w-[7rem] items-center justify-center rounded-lg bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-400 cursor-not-allowed select-none">
                                            Booked
                                        </span>
                                    @else
                                        <a href="{{ route('register') }}" title="Book {{ $field }} at {{ $time }}"
                                           class="inline-flex w-full max-w-[7rem] items-center justify-center rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-[#0047D4] ring-1 ring-inset ring-blue-100 transition-all duration-150 hover:bg-[#0047D4] hover:text-white hover:ring-[#0047D4] active:scale-[0.97]">
                                            Available
                                        </a>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- ============================ PRICING ============================ -->
    <section id="pricing" class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Pricing</h2>
            <p class="mx-auto mt-2 max-w-xl text-sm text-gray-500">
                One venue, four courts. Transparent hourly rates — pay a small deposit online to lock your slot.
            </p>
        </div>

        @php
            $courts = [
                [
                    'name' => 'Court A',
                    'type' => 'Futsal · Synthetic Grass',
                    'price' => '30',
                    'features' => ['Indoor, climate controlled', 'LED floodlights', '5-a-side standard size', 'Free parking'],
                    'popular' => false,
                ],
                [
                    'name' => 'Court B',
                    'type' => 'Futsal · Pro Vinyl Floor',
                    'price' => '40',
                    'features' => ['Indoor, climate controlled', 'Premium vinyl surface', 'Spectator seating', 'Changing rooms & showers'],
                    'popular' => true,
                ],
                [
                    'name' => 'Court C',
                    'type' => 'Badminton',
                    'price' => '15',
                    'features' => ['Indoor wooden floor', '2 regulation nets', 'Racket & shuttle rental', 'Air-conditioned'],
                    'popular' => false,
                ],
                [
                    'name' => 'Court D',
                    'type' => 'Basketball',
                    'price' => '35',
                    'features' => ['Indoor / outdoor', 'Full regulation court', 'Night lighting', 'Digital scoreboard'],
                    'popular' => false,
                ],
            ];
        @endphp

        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($courts as $court)
                <div class="relative flex flex-col rounded-2xl border bg-white p-6 shadow-xs transition-all duration-200 hover:-translate-y-1 hover:shadow-lg {{ $court['popular'] ? 'border-[#0047D4] ring-1 ring-[#0047D4]' : 'border-gray-100' }}">
                    @if ($court['popular'])
                        <span class="absolute -top-3 left-1/2 -translate-x-1/2 rounded-full bg-[#D7F23D] px-3 py-1 text-[11px] font-bold text-[#1c2a00] shadow-sm">
                            Most Popular
                        </span>
                    @endif

                    <h3 class="text-lg font-bold text-gray-900">{{ $court['name'] }}</h3>
                    <p class="mt-1 text-xs font-medium uppercase tracking-wide text-gray-400">{{ $court['type'] }}</p>

                    <div class="mt-5 flex items-baseline gap-1">
                        <span class="text-4xl font-extrabold tracking-tight text-[#0047D4]">${{ $court['price'] }}</span>
                        <span class="text-sm font-medium text-gray-400">/hour</span>
                    </div>

                    <ul class="mt-6 flex-1 space-y-3">
                        @foreach ($court['features'] as $feature)
                            <li class="flex items-start gap-2.5 text-sm text-gray-600">
                                <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#0047D4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('register') }}"
                       class="mt-7 inline-flex w-full items-center justify-center rounded-xl px-4 py-3 text-sm font-semibold transition-all duration-200 active:scale-[0.99] {{ $court['popular'] ? 'bg-[#0047D4] text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] hover:shadow-blue-500/20' : 'border border-gray-200 text-[#0047D4] hover:border-[#0047D4] hover:bg-blue-50' }}">
                        Book {{ $court['name'] }}
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ============================ FOOTER ============================ -->
    <footer id="contact" class="border-t border-gray-100 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-5">
                <!-- Brand -->
                <div class="col-span-2 md:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 select-none">
                        <div class="bg-white border border-gray-150 p-1.5 rounded-xl shadow-xs">
                            <img class="h-7 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                        </div>
                        <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
                    </a>
                    <p class="mt-4 max-w-xs text-sm text-gray-500 leading-relaxed">
                        Real-time court booking and venue management for SportOps Arena.
                    </p>
                </div>

                @php
                    $footerCols = [
                        'Book' => ['Schedule', 'Pricing', 'Courts', 'Sign Up'],
                        'Venue' => ['About', 'Facilities', 'Gallery', 'Reviews'],
                        'Support' => ['Help Center', 'How it works', 'Refunds', 'Status'],
                        'Legal' => ['Privacy', 'Terms', 'Cookies', 'Licenses'],
                    ];
                @endphp

                @foreach ($footerCols as $heading => $links)
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-gray-900">{{ $heading }}</h4>
                        <ul class="mt-4 space-y-3">
                            @foreach ($links as $link)
                                <li>
                                    <a href="#" class="text-sm text-gray-500 hover:text-[#0047D4] transition-colors duration-150">{{ $link }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-gray-100 pt-6 sm:flex-row">
                <p class="text-sm text-gray-400">&copy; {{ date('Y') }} SportOps. All rights reserved.</p>
                <div class="flex items-center gap-5 text-gray-400">
                    <a href="#" class="hover:text-[#0047D4] transition-colors duration-150" aria-label="Twitter">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231 5.45-6.231Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z"></path></svg>
                    </a>
                    <a href="#" class="hover:text-[#0047D4] transition-colors duration-150" aria-label="Instagram">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="20" x="2" y="2" rx="5"></rect>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"></circle>
                        </svg>
                    </a>
                    <a href="#" class="hover:text-[#0047D4] transition-colors duration-150" aria-label="Facebook">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987H7.898V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12Z"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile menu toggle script -->
    <script>
        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }
    </script>
</body>
</html>
