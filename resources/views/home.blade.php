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
                <a href="#gallery" class="text-sm font-medium text-gray-600 hover:text-[#0047D4] transition-colors duration-150">Gallery</a>
                <a href="#reviews" class="text-sm font-medium text-gray-600 hover:text-[#0047D4] transition-colors duration-150">Reviews</a>
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
                <a href="#gallery" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Gallery</a>
                <a href="#reviews" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Reviews</a>
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

    <!-- ============================ SCHEDULE (date-aware; guests = today only) ============================ -->
    <x-schedule-board :authed="auth()->check()" title="Court Schedule" />

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
                    'name' => 'Futsal — Synthetic Grass',
                    'type' => 'Standard court',
                    'price' => '120,000',
                    'features' => ['Indoor', 'Synthetic grass surface', 'LED lighting', 'Standard 5-a-side court', 'Parking area', 'Restrooms', 'Waiting area'],
                    'popular' => false,
                ],
                [
                    'name' => 'Premium Futsal — Vinyl',
                    'type' => 'Premium court',
                    'price' => '180,000',
                    'features' => ['Air-conditioned indoor court', 'Premium vinyl flooring', 'Professional LED lighting', 'Spectator seating', 'Changing rooms', 'Showers', 'Spacious parking area', 'WiFi'],
                    'popular' => true,
                ],
                [
                    'name' => 'Badminton',
                    'type' => 'Indoor court',
                    'price' => '50,000',
                    'features' => ['Wooden/vinyl flooring', '2 standard nets', 'Air conditioning or industrial fans', 'Racket rental', 'Shuttlecock available', 'Restrooms', 'Seating area'],
                    'popular' => false,
                ],
                [
                    'name' => 'Basketball',
                    'type' => 'Full court',
                    'price' => '150,000',
                    'features' => ['Full court', 'Standard hoops', 'Night lighting', 'Digital scoreboard', 'Small spectator stand', 'Changing rooms', 'Parking area'],
                    'popular' => false,
                ],
            ];
        @endphp

        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($courts as $court)
                <div class="relative flex flex-col rounded-2xl border bg-white p-6 shadow-xs transition-all duration-200 hover:-translate-y-1 hover:shadow-lg {{ $court['popular'] ? 'border-[#0047D4] ring-1 ring-[#0047D4]' : 'border-gray-100' }}">
                    @if ($court['popular'])
                        <span class="absolute -top-3 left-1/2 -translate-x-1/2 rounded-full bg-[#D7F23D] px-3 py-1 text-[11px] font-bold text-[#1c2a00] shadow-sm whitespace-nowrap">
                            Most Popular
                        </span>
                    @endif

                    <h3 class="text-lg font-bold text-gray-900">{{ $court['name'] }}</h3>
                    <p class="mt-1 text-xs font-medium uppercase tracking-wide text-gray-400">{{ $court['type'] }}</p>

                    <div class="mt-5 flex items-baseline gap-1">
                        <span class="text-3xl font-extrabold tracking-tight text-[#0047D4]">Rp{{ $court['price'] }}</span>
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
                        Book Now
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ============================ GALLERY ============================ -->
    <section id="gallery" class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Gallery</h2>
            <p class="mx-auto mt-2 max-w-xl text-sm text-gray-500">
                A look inside SportOps Arena. Photos of our courts and facilities are coming soon.
            </p>
        </div>

        @php
            // Placeholder tiles until real photos are added. `span` lets a couple of tiles span 2 cols for a mosaic look.
            $gallery = [
                ['label' => 'Futsal — Synthetic Grass', 'span' => 'sm:col-span-2'],
                ['label' => 'Premium Futsal — Vinyl', 'span' => ''],
                ['label' => 'Badminton Hall', 'span' => ''],
                ['label' => 'Basketball Court', 'span' => ''],
                ['label' => 'Lounge & Waiting Area', 'span' => ''],
                ['label' => 'Night Lighting', 'span' => 'sm:col-span-2'],
            ];
        @endphp

        <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-4">
            @foreach ($gallery as $tile)
                <div class="group relative flex aspect-[4/3] items-center justify-center overflow-hidden rounded-2xl border border-gray-100 bg-gradient-to-br from-gray-100 to-gray-200 {{ $tile['span'] }}">
                    <div class="flex flex-col items-center gap-2 text-gray-400">
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                            <circle cx="9" cy="9" r="2"></circle>
                            <path d="m21 15-3.1-3.1a2 2 0 0 0-2.8 0L6 21"></path>
                        </svg>
                        <span class="px-2 text-center text-xs font-medium">{{ $tile['label'] }}</span>
                    </div>
                    <span class="absolute bottom-2 right-2 rounded-full bg-white/70 px-2 py-0.5 text-[10px] font-semibold text-gray-500 backdrop-blur">Coming soon</span>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ============================ REVIEWS / TESTIMONIALS ============================ -->
    <section id="reviews" class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">What Players Say</h2>
            <p class="mx-auto mt-2 max-w-xl text-sm text-gray-500">
                Real feedback from teams and players who book at SportOps Arena.
            </p>
        </div>

        @php
            $reviews = [
                [
                    'quote' => 'Booking used to mean calling the front desk and hoping the slot was free. Now I just check the schedule and pay the deposit online. Game-changer for our weekly futsal nights.',
                    'name' => 'Andi Pratama',
                    'role' => 'Futsal team captain',
                    'initial' => 'A',
                    'color' => 'bg-blue-100 text-[#0047D4]',
                ],
                [
                    'quote' => 'The premium vinyl court is spotless and the AC actually works. Spectator seating made it easy for parents to watch the kids play. Worth every rupiah.',
                    'name' => 'Siti Rahmawati',
                    'role' => 'Badminton coach',
                    'initial' => 'S',
                    'color' => 'bg-emerald-100 text-emerald-700',
                ],
                [
                    'quote' => 'No more double bookings. The live schedule shows exactly what is open, and the digital scoreboard on the basketball court is a nice touch for our pick-up games.',
                    'name' => 'Budi Santoso',
                    'role' => 'Basketball organizer',
                    'initial' => 'B',
                    'color' => 'bg-amber-100 text-amber-700',
                ],
            ];
        @endphp

        <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-3">
            @foreach ($reviews as $review)
                <figure class="flex flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-xs">
                    <!-- Stars -->
                    <div class="flex gap-0.5 text-[#D7B400]">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="m12 2 2.9 6.3 6.9.7-5.1 4.6 1.4 6.8L12 17.3 5.9 20.4l1.4-6.8L2.2 9l6.9-.7L12 2Z"></path>
                            </svg>
                        @endfor
                    </div>

                    <blockquote class="mt-4 flex-1 text-sm leading-relaxed text-gray-600">
                        &ldquo;{{ $review['quote'] }}&rdquo;
                    </blockquote>

                    <figcaption class="mt-5 flex items-center gap-3 border-t border-gray-100 pt-5">
                        <span class="flex h-10 w-10 items-center justify-center rounded-full text-sm font-bold {{ $review['color'] }}">
                            {{ $review['initial'] }}
                        </span>
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $review['name'] }}</p>
                            <p class="text-xs text-gray-500">{{ $review['role'] }}</p>
                        </div>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </section>

    <!-- ============================ FOOTER ============================ -->
    <footer id="contact" class="border-t border-gray-100 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">

                <!-- Brand + Social Media -->
                <div>
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 select-none">
                        <div class="bg-white border border-gray-150 p-1.5 rounded-xl shadow-xs">
                            <img class="h-7 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                        </div>
                        <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
                    </a>
                    <h4 class="mt-6 text-xs font-bold uppercase tracking-wider text-gray-900">Social Media</h4>
                    <div class="mt-4 flex items-center gap-3 text-gray-400">
                        <a href="#" class="rounded-lg border border-gray-150 p-2 hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150" aria-label="Twitter">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231 5.45-6.231Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z"></path></svg>
                        </a>
                        <a href="#" class="rounded-lg border border-gray-150 p-2 hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150" aria-label="Instagram">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="20" x="2" y="2" rx="5"></rect>
                                <circle cx="12" cy="12" r="4"></circle>
                                <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"></circle>
                            </svg>
                        </a>
                        <a href="#" class="rounded-lg border border-gray-150 p-2 hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150" aria-label="Facebook">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987H7.898V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12Z"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-900">Contact</h4>
                    <ul class="mt-4 space-y-3 text-sm text-gray-500">
                        <li class="flex items-start gap-2.5">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            Jl. Olahraga No. 12, Jakarta
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="h-4 w-4 shrink-0 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            <a href="tel:+622112345678" class="hover:text-[#0047D4] transition-colors duration-150">+62 21 1234 5678</a>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="h-4 w-4 shrink-0 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                            <a href="mailto:hello@sportops.id" class="hover:text-[#0047D4] transition-colors duration-150">hello@sportops.id</a>
                        </li>
                    </ul>
                </div>

                <!-- Discover (Gallery + Reviews) -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-900">Discover</h4>
                    <ul class="mt-4 space-y-3 text-sm">
                        <li><a href="#gallery" class="text-gray-500 hover:text-[#0047D4] transition-colors duration-150">Gallery</a></li>
                        <li><a href="#reviews" class="text-gray-500 hover:text-[#0047D4] transition-colors duration-150">Reviews</a></li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-900">Quick Links</h4>
                    <ul class="mt-4 space-y-3 text-sm">
                        <li><a href="#schedule" class="text-gray-500 hover:text-[#0047D4] transition-colors duration-150">Schedule</a></li>
                        <li><a href="#pricing" class="text-gray-500 hover:text-[#0047D4] transition-colors duration-150">Pricing</a></li>
                        <li><a href="#pricing" class="text-gray-500 hover:text-[#0047D4] transition-colors duration-150">Courts</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-500 hover:text-[#0047D4] transition-colors duration-150">Sign Up</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 border-t border-gray-100 pt-6">
                <p class="text-center text-sm text-gray-400">&copy; {{ date('Y') }} SportOps. All rights reserved.</p>
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
