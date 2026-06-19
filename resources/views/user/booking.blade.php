
<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Court | SportOps</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [data-step] { animation: fadeUp .35s ease both; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    @php
        $courts = [];
        if (isset($fields)) {
            foreach ($fields as $field) {
                $jenis = strtolower($field->jenis_olahraga);
                $gradient = 'from-emerald-500 via-teal-600 to-cyan-700';
                $icon = '<circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path>';
                
                if (str_contains($jenis, 'futsal')) {
                    $gradient = 'from-blue-500 via-blue-600 to-indigo-700';
                    $icon = '<circle cx="12" cy="12" r="9"></circle><path d="m12 3 2.5 4.5L12 12 9.5 7.5 12 3Z"></path><path d="m21 12-5 .8-2.5-4.3M3 12l5 .8 2.5-4.3M16.5 19.5 14 15l4.5-1.5M7.5 19.5 10 15 5.5 13.5"></path>';
                } elseif (str_contains($jenis, 'badminton')) {
                    $gradient = 'from-emerald-500 via-teal-600 to-cyan-700';
                    $icon = '<path d="M14 3 4 13l3 3 4 4 10-10"></path><circle cx="6.5" cy="17.5" r="2.5"></circle><path d="m14 3 7 7"></path>';
                } elseif (str_contains($jenis, 'basket')) {
                    $gradient = 'from-orange-400 via-orange-500 to-rose-600';
                    $icon = '<circle cx="12" cy="12" r="9"></circle><path d="M3 12h18M12 3v18M5.6 5.6c3.5 3.5 9.3 3.5 12.8 0M5.6 18.4c3.5-3.5 9.3-3.5 12.8 0"></path>';
                } elseif (str_contains($jenis, 'voli') || str_contains($jenis, 'volleyball')) {
                    $gradient = 'from-violet-500 via-purple-600 to-fuchsia-700';
                    $icon = '<circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path>';
                }

                $courts[] = [
                    'id'       => $field->id,
                    'name'     => $field->nama_lapangan,
                    'sport'    => ucfirst($field->jenis_olahraga),
                    'price'    => $field->harga,
                    'gradient' => $gradient,
                    'icon'     => $icon,
                    'desc'     => $field->deskripsi ?: 'No description provided.',
                    'rating'   => '5.0',
                    'badge'    => $field->status === 'aktif' ? 'Active' : 'Maintenance',
                    'badgeCls' => $field->status === 'aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700',
                    'status'   => $field->status,
                ];
            }
        }

        $times = ['08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00','00:00','01:00','02:00'];

        $prefill = [
            'court' => request('court'),
            'date'  => request('date'),
            'time'  => request('time'),
        ];
    @endphp

    <!-- ============================ TOP NAVIGATION ============================ -->
    <header class="sticky top-0 z-50 border-b border-gray-100 bg-white/80 backdrop-blur-md">
        <nav class="mx-auto flex max-w-5xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 select-none">
                <div class="bg-white border border-gray-150 p-1.5 rounded-xl shadow-xs">
                    <img class="h-7 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                </div>
                <span class="hidden text-lg font-extrabold tracking-tight text-gray-900 sm:inline">SportOps</span>
            </a>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-xl border border-gray-150 bg-white px-3.5 py-2 text-sm font-semibold text-gray-600 shadow-xs hover:border-blue-200 hover:text-[#0047D4] transition-colors duration-150">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"></path></svg>
                Back to Dashboard
            </a>
        </nav>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-6 sm:px-6 sm:py-10 lg:px-8"
          id="booking-app"
          data-courts='@json($courts)'
          data-times='@json($times)'
          data-prefill='@json($prefill)'
          data-bookings='@json($bookings ?? [])'
          data-dashboard-url="{{ route('dashboard') }}"
          data-bookings-url="{{ route('bookings') }}">

        <!-- ---------------------- STEPPER ---------------------- -->
        <div class="mb-8">
            <div class="flex items-center justify-between gap-1" id="stepper">
                @php $steps = ['Sport', 'Date', 'Time', 'Review', 'Payment', 'Done']; @endphp
                @foreach ($steps as $i => $label)
                    <div class="flex flex-1 items-center {{ $i === count($steps) - 1 ? 'flex-none' : '' }}">
                        <div class="flex flex-col items-center gap-1.5">
                            <span data-step-dot="{{ $i }}" class="flex h-9 w-9 items-center justify-center rounded-full border-2 border-gray-200 bg-white text-xs font-bold text-gray-400 transition-all duration-200">{{ $i + 1 }}</span>
                            <span data-step-label="{{ $i }}" class="hidden text-[11px] font-semibold text-gray-400 sm:block">{{ $label }}</span>
                        </div>
                        @if ($i !== count($steps) - 1)
                            <div data-step-bar="{{ $i }}" class="mx-1.5 h-0.5 flex-1 rounded bg-gray-200 transition-all duration-300 sm:mx-2"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ==================== STEP 1: SPORT / COURT ==================== -->
        <section data-step="1" class="hidden">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#0047D4]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="m12 3 2.5 4.5L12 12 9.5 7.5 12 3Z"></path></svg>
                </span>
                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Choose your court</h1>
                    <p class="text-sm text-gray-500">SportOps Arena — one court per sport. Prices are per hour.</p>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                @foreach ($courts as $i => $court)
                    <button type="button" data-court-pick="{{ $i }}" {{ $court['status'] !== 'aktif' ? 'disabled' : '' }}
                        class="group relative overflow-hidden rounded-3xl border-2 border-gray-100 bg-white text-left shadow-xs transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed {{ $court['status'] === 'aktif' ? 'hover:-translate-y-1 hover:border-blue-300 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-100' : '' }}">
                        <!-- Gradient header with decorative orb -->
                        <div class="relative h-32 bg-gradient-to-br {{ $court['gradient'] }} overflow-hidden">
                            <div class="absolute inset-0 bg-black/10"></div>
                            <div class="pointer-events-none absolute -right-6 -top-6 h-28 w-28 rounded-full bg-white/10 blur-xl"></div>
                            <svg class="absolute right-4 bottom-4 h-12 w-12 text-white/20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">{!! $court['icon'] !!}</svg>
                            <span class="absolute left-4 top-4 inline-flex items-center gap-1.5 rounded-full bg-white/90 px-2.5 py-1 text-[11px] font-bold text-gray-700 shadow-sm backdrop-blur">
                                <svg class="h-3 w-3 text-[#D7B400]" viewBox="0 0 24 24" fill="currentColor"><path d="m12 2 2.9 6.3 6.9.7-5.1 4.6 1.4 6.8L12 17.3 5.9 20.4l1.4-6.8L2.2 9l6.9-.7L12 2Z"></path></svg>
                                {{ $court['rating'] }}
                            </span>
                            @if ($court['badge'])
                                <span class="absolute right-4 top-4 rounded-full px-2.5 py-1 text-[10px] font-bold {{ $court['badgeCls'] }}">{{ $court['badge'] }}</span>
                            @endif
                        </div>
                        <!-- Body -->
                        <div class="p-5">
                            <h3 class="text-base font-bold text-gray-900 group-hover:text-[#0047D4] transition-colors duration-150">{{ $court['name'] }}</h3>
                            <p class="mt-1 text-xs text-gray-500 leading-relaxed">{{ $court['desc'] }}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <p class="text-sm">
                                    <span class="text-xl font-extrabold text-[#0047D4]">Rp{{ number_format($court['price'], 0, ',', '.') }}</span>
                                    <span class="font-medium text-gray-400">/hr</span>
                                </p>
                                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-50 text-[#0047D4] transition-all duration-200 group-hover:bg-[#0047D4] group-hover:text-white group-hover:shadow-lg group-hover:shadow-blue-500/20">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                                </span>
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>

            <!-- Trust indicators -->
            <div class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-4">
                @php
                    $trust = [
                        ['icon' => '<path d="M20 6 9 17l-5-5"></path>', 'text' => 'Instant confirmation'],
                        ['icon' => '<rect width="20" height="14" x="2" y="5" rx="2"></rect><path d="M2 10h20"></path>', 'text' => 'Secure QRIS payment'],
                        ['icon' => '<circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path>', 'text' => 'Flexible schedule'],
                        ['icon' => '<path d="M3 3v5h5"></path><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"></path>', 'text' => 'Free cancellation'],
                    ];
                @endphp
                @foreach ($trust as $item)
                    <div class="flex items-center gap-2.5 rounded-2xl border border-gray-100 bg-white p-3 shadow-xs">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">{!! $item['icon'] !!}</svg>
                        </span>
                        <span class="text-xs font-semibold text-gray-700">{{ $item['text'] }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- ==================== STEP 2: DATE ==================== -->
        <section data-step="2" class="hidden">
            <!-- Selection context chip -->
            <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-100 bg-blue-50/50 px-3.5 py-1.5 text-xs font-semibold text-[#0047D4]">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="m12 3 2.5 4.5L12 12 9.5 7.5 12 3Z"></path></svg>
                <span data-ctx-court></span>
            </div>

            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#0047D4]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path></svg>
                </span>
                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Pick a date</h1>
                    <p class="text-sm text-gray-500">When would you like to play?</p>
                </div>
            </div>

            <div class="mt-6 rounded-3xl border border-gray-100 bg-white p-6 shadow-xs">
                <label for="date-input" class="block text-xs font-semibold uppercase tracking-wider text-gray-700">Booking date</label>
                <input type="date" id="date-input" class="mt-2 w-full rounded-xl border border-gray-200 bg-gray-50/40 px-4 py-3.5 text-sm font-semibold text-gray-900 focus:border-[#0047D4] focus:ring-3 focus:ring-blue-100 focus:outline-none transition-all duration-200 sm:w-auto">

                <p class="mt-5 text-xs font-semibold uppercase tracking-wider text-gray-500">Quick pick</p>
                <div class="mt-2.5 flex flex-wrap gap-2" id="date-quickpicks"></div>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <button type="button" data-back class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"></path></svg> Back
                </button>
                <button type="button" data-next-date disabled class="inline-flex items-center gap-2 rounded-xl bg-[#0047D4] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] disabled:cursor-not-allowed disabled:opacity-40 active:scale-[0.99] transition-all duration-200">
                    Continue <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </section>

        <!-- ==================== STEP 3: TIME SLOT ==================== -->
        <section data-step="3" class="hidden">
            <!-- Selection context chip -->
            <div class="mb-5 flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-2 rounded-full border border-blue-100 bg-blue-50/50 px-3.5 py-1.5 text-xs font-semibold text-[#0047D4]" data-ctx-court2></span>
                <span class="inline-flex items-center gap-2 rounded-full border border-blue-100 bg-blue-50/50 px-3.5 py-1.5 text-xs font-semibold text-[#0047D4]">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path></svg>
                    <span data-ctx-date></span>
                </span>
            </div>

            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#0047D4]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path></svg>
                </span>
                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Choose a time</h1>
                    <p class="text-sm text-gray-500" id="time-subtitle">Pick a starting hour, then adjust duration.</p>
                </div>
            </div>

            <!-- Duration stepper -->
            <div class="mt-6 flex items-center gap-4 rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                <div class="flex-1">
                    <p class="text-sm font-bold text-gray-900">Duration</p>
                    <p class="text-xs text-gray-500">Consecutive hours on the same court.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" data-dur-dec class="flex h-9 w-9 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] disabled:opacity-40 disabled:cursor-not-allowed transition-colors duration-150">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14"></path></svg>
                    </button>
                    <span class="w-16 text-center text-sm font-bold text-gray-900" data-dur-label>1 hour</span>
                    <button type="button" data-dur-inc class="flex h-9 w-9 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] disabled:opacity-40 disabled:cursor-not-allowed transition-colors duration-150">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"></path></svg>
                    </button>
                </div>
            </div>

            <div class="mt-4 flex items-center gap-4">
                <span class="flex items-center gap-2 text-xs font-medium text-gray-600"><span class="h-3 w-3 rounded bg-blue-50 ring-1 ring-blue-200"></span> Available</span>
                <span class="flex items-center gap-2 text-xs font-medium text-gray-600"><span class="h-3 w-3 rounded bg-gray-100 ring-1 ring-gray-200"></span> Booked</span>
                <span class="flex items-center gap-2 text-xs font-medium text-gray-600"><span class="h-3 w-3 rounded bg-[#0047D4]"></span> Selected</span>
            </div>

            <div class="mt-3 grid grid-cols-3 gap-2.5 sm:grid-cols-4 md:grid-cols-5" id="time-grid"></div>

            <!-- Live price estimate -->
            <div class="mt-4 flex items-center justify-between rounded-2xl border border-blue-100 bg-blue-50/40 px-4 py-3" id="price-preview" style="display:none">
                <span class="text-sm text-gray-700" id="price-preview-label"></span>
                <span class="text-lg font-extrabold text-[#0047D4]" id="price-preview-total"></span>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <button type="button" data-back class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"></path></svg> Back
                </button>
                <button type="button" data-next-time disabled class="inline-flex items-center gap-2 rounded-xl bg-[#0047D4] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] disabled:cursor-not-allowed disabled:opacity-40 active:scale-[0.99] transition-all duration-200">
                    Review booking <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </section>

        <!-- ==================== STEP 4: REVIEW ==================== -->
        <section data-step="4" class="hidden">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#0047D4]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"></path><path d="M14 2v6h6"></path><path d="M16 13H8M16 17H8M10 9H8"></path></svg>
                </span>
                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Review your booking</h1>
                    <p class="text-sm text-gray-500">Double-check the details before you proceed to payment.</p>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-xs">
                <div class="relative h-28 bg-gradient-to-br overflow-hidden" data-review-banner>
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="pointer-events-none absolute -right-6 -top-6 h-28 w-28 rounded-full bg-white/10 blur-xl"></div>
                    <div class="absolute inset-0 flex items-center px-6">
                        <div>
                            <span class="inline-flex items-center rounded-full bg-white/90 px-2.5 py-1 text-[11px] font-bold text-gray-700 shadow-sm backdrop-blur" data-review-sport></span>
                            <p class="mt-2 text-xl font-extrabold text-white" data-review-court-hero></p>
                        </div>
                    </div>
                </div>
                <div class="divide-y divide-gray-50 px-6">
                    <div class="flex items-center justify-between py-4">
                        <span class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="m12 3 2.5 4.5L12 12 9.5 7.5 12 3Z"></path></svg>
                            Court
                        </span>
                        <span class="text-sm font-bold text-gray-900" data-review-court></span>
                    </div>
                    <div class="flex items-center justify-between py-4">
                        <span class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path></svg>
                            Date
                        </span>
                        <span class="text-sm font-bold text-gray-900" data-review-date></span>
                    </div>
                    <div class="flex items-center justify-between py-4">
                        <span class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path></svg>
                            Time
                        </span>
                        <span class="text-sm font-bold text-gray-900" data-review-time></span>
                    </div>
                    <div class="flex items-center justify-between py-4">
                        <span class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5v14"></path></svg>
                            Duration
                        </span>
                        <span class="text-sm font-bold text-gray-900" data-review-duration></span>
                    </div>
                    <div class="flex items-center justify-between py-4 bg-gray-50/50 -mx-6 px-6">
                        <span class="text-sm text-gray-500" data-review-rate-label></span>
                        <span class="text-sm font-semibold text-gray-700" data-review-rate></span>
                    </div>
                    <div class="flex items-center justify-between py-5 -mx-6 px-6">
                        <span class="text-base font-bold text-gray-900">Total</span>
                        <span class="text-2xl font-extrabold text-[#0047D4]" data-review-total></span>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <button type="button" data-back class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"></path></svg> Back
                </button>
                <button type="button" data-confirm class="inline-flex items-center gap-2 rounded-xl bg-[#0047D4] px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                    Confirm &amp; pay
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </section>

        <!-- ==================== STEP 5: PAYMENT (QRIS) ==================== -->
        <section data-step="5" class="hidden">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#0047D4]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"></rect><path d="M2 10h20"></path></svg>
                </span>
                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Payment</h1>
                    <p class="text-sm text-gray-500">Booking <span class="font-mono font-semibold text-gray-700" data-pay-id></span> — scan QRIS to secure your slot.</p>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-5">
                <!-- Payment options -->
                <div class="lg:col-span-3 space-y-5">
                    <div>
                        <p class="text-sm font-bold text-gray-900">Choose payment amount</p>
                        <div class="mt-3 space-y-3">
                            <label data-pay-option="full" class="flex cursor-pointer items-center justify-between rounded-2xl border-2 border-[#0047D4] bg-blue-50/40 p-4 transition-all duration-150 hover:shadow-md">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-5 w-5 items-center justify-center rounded-full border-2 border-[#0047D4]" data-radio><span class="h-2.5 w-2.5 rounded-full bg-[#0047D4]"></span></span>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">Full Payment</p>
                                        <p class="text-xs text-gray-500">Pay the entire amount now. Nothing due at the venue.</p>
                                    </div>
                                </div>
                                <span class="text-base font-extrabold text-[#0047D4]" data-opt-full></span>
                                <input type="radio" name="paytype" value="full" class="sr-only" checked>
                            </label>
                            <label data-pay-option="dp" class="flex cursor-pointer items-center justify-between rounded-2xl border-2 border-gray-100 bg-white p-4 transition-all duration-150 hover:shadow-md">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-5 w-5 items-center justify-center rounded-full border-2 border-gray-300" data-radio></span>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">Down Payment (50%)</p>
                                        <p class="text-xs text-gray-500">Pay half now, settle the rest at the venue before play.</p>
                                    </div>
                                </div>
                                <span class="text-base font-extrabold text-gray-900" data-opt-dp></span>
                                <input type="radio" name="paytype" value="dp" class="sr-only">
                            </label>
                        </div>
                    </div>

                    <!-- Amount summary -->
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs">
                        <div class="flex items-center justify-between py-2">
                            <span class="text-sm text-gray-500">Booking total</span>
                            <span class="text-sm font-semibold text-gray-700" data-sum-total></span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-t border-dashed border-gray-100">
                            <span class="text-sm font-bold text-gray-900">Amount to pay now</span>
                            <span class="text-xl font-extrabold text-[#0047D4]" data-sum-pay></span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-t border-dashed border-gray-100" data-sum-remaining-row>
                            <span class="text-sm text-gray-500">Remaining balance (at venue)</span>
                            <span class="text-sm font-bold text-amber-600" data-sum-remaining></span>
                        </div>
                    </div>
                </div>

                <!-- QRIS panel -->
                <div class="lg:col-span-2">
                    <div class="sticky top-24 rounded-3xl border border-gray-100 bg-white p-6 text-center shadow-xs">
                        <div class="flex items-center justify-center gap-2">
                            <span class="text-sm font-extrabold tracking-tight text-gray-900">QRIS</span>
                            <span class="rounded bg-rose-50 px-1.5 py-0.5 text-[10px] font-bold text-rose-600">SCAN TO PAY</span>
                        </div>
                        <div class="mx-auto mt-4 h-44 w-44 rounded-2xl border border-gray-200 bg-white p-3 shadow-inner">
                            <svg viewBox="0 0 100 100" class="h-full w-full text-gray-900" fill="currentColor" shape-rendering="crispEdges" aria-label="QRIS code">
                                <rect x="0" y="0" width="30" height="30" fill="none" stroke="currentColor" stroke-width="6"/>
                                <rect x="12" y="12" width="6" height="6"/>
                                <rect x="70" y="0" width="30" height="30" fill="none" stroke="currentColor" stroke-width="6"/>
                                <rect x="82" y="12" width="6" height="6"/>
                                <rect x="0" y="70" width="30" height="30" fill="none" stroke="currentColor" stroke-width="6"/>
                                <rect x="12" y="82" width="6" height="6"/>
                                <rect x="40" y="6" width="6" height="6"/><rect x="52" y="6" width="6" height="6"/>
                                <rect x="40" y="18" width="6" height="6"/><rect x="58" y="18" width="6" height="6"/>
                                <rect x="46" y="40" width="6" height="6"/><rect x="6" y="40" width="6" height="6"/>
                                <rect x="18" y="46" width="6" height="6"/><rect x="40" y="46" width="6" height="6"/>
                                <rect x="58" y="40" width="6" height="6"/><rect x="70" y="46" width="6" height="6"/>
                                <rect x="82" y="40" width="6" height="6"/><rect x="88" y="46" width="6" height="6"/>
                                <rect x="40" y="58" width="6" height="6"/><rect x="52" y="64" width="6" height="6"/>
                                <rect x="64" y="58" width="6" height="6"/><rect x="76" y="64" width="6" height="6"/>
                                <rect x="88" y="58" width="6" height="6"/>
                                <rect x="40" y="76" width="6" height="6"/><rect x="52" y="82" width="6" height="6"/>
                                <rect x="64" y="76" width="6" height="6"/><rect x="76" y="82" width="6" height="6"/>
                                <rect x="88" y="76" width="6" height="6"/>
                                <rect x="40" y="88" width="6" height="6"/><rect x="70" y="88" width="6" height="6"/>
                            </svg>
                        </div>
                        <p class="mt-4 text-xs text-gray-500">Scan with any QRIS-supported app<br>(GoPay, OVO, DANA, mobile banking).</p>
                        <p class="mt-3 text-sm font-bold text-gray-900">Pay <span data-qris-amount class="text-[#0047D4]"></span></p>
                        <p class="mt-1 text-xs text-gray-400">Payment expires in <span data-timer class="font-semibold text-gray-600">15:00</span></p>

                        <button type="button" data-paid class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#0047D4] px-4 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                            I have paid
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"></path></svg>
                        </button>
                        <p class="mt-3 text-[11px] text-gray-400">Demo only — no real payment is processed.</p>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <button type="button" data-back class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"></path></svg> Back to review
                </button>
            </div>
        </section>

        <!-- ==================== STEP 6: CONFIRMATION ==================== -->
        <section data-step="6" class="hidden">
            <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-lg">
                <div class="relative bg-gradient-to-br from-emerald-500 to-teal-600 px-6 py-12 text-center overflow-hidden">
                    <div class="pointer-events-none absolute -left-10 -top-10 h-40 w-40 rounded-full bg-white/10 blur-2xl"></div>
                    <div class="pointer-events-none absolute -right-10 -bottom-10 h-40 w-40 rounded-full bg-white/10 blur-2xl"></div>
                    <span class="relative mx-auto flex h-18 w-18 items-center justify-center rounded-full bg-white/20 backdrop-blur">
                        <svg class="h-10 w-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"></path></svg>
                    </span>
                    <h1 class="mt-5 text-2xl font-extrabold tracking-tight text-white">Booking confirmed!</h1>
                    <p class="mt-1 text-sm text-emerald-100">A confirmation has been sent to your email.</p>
                    <p class="mt-4 inline-block rounded-full bg-white/20 px-5 py-1.5 font-mono text-sm font-bold text-white backdrop-blur" data-done-id></p>
                </div>

                <div class="divide-y divide-gray-50 px-6">
                    <div class="flex items-center justify-between py-4">
                        <span class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="m12 3 2.5 4.5L12 12 9.5 7.5 12 3Z"></path></svg>
                            Court
                        </span>
                        <span class="text-sm font-bold text-gray-900" data-done-court></span>
                    </div>
                    <div class="flex items-center justify-between py-4">
                        <span class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path></svg>
                            Date &amp; time
                        </span>
                        <span class="text-sm font-bold text-gray-900 text-right" data-done-when></span>
                    </div>
                    <div class="flex items-center justify-between py-4">
                        <span class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            Booking total
                        </span>
                        <span class="text-sm font-bold text-gray-900" data-done-total></span>
                    </div>
                    <div class="flex items-center justify-between py-4">
                        <span class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"></rect><path d="M2 10h20"></path></svg>
                            Payment status
                        </span>
                        <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-bold" data-done-status></span>
                    </div>
                    <div class="flex items-center justify-between py-4" data-done-remaining-row>
                        <span class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="h-4 w-4 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v4M12 17h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"></path></svg>
                            Balance due at venue
                        </span>
                        <span class="text-sm font-bold text-amber-600" data-done-remaining></span>
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-gray-50 p-6 sm:flex-row">
                    <a href="{{ route('bookings') }}" class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-[#0047D4] px-4 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                        View my bookings
                    </a>
                    <a href="{{ route('dashboard') }}" class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-3.5 text-sm font-semibold text-gray-700 hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">
                        Back to dashboard
                    </a>
                </div>
            </div>
        </section>
    </main>

    <script>
        (function () {
            const app = document.getElementById('booking-app');
            const COURTS = JSON.parse(app.dataset.courts);
            const TIMES = JSON.parse(app.dataset.times);
            const PREFILL = JSON.parse(app.dataset.prefill);
            const BOOKINGS = JSON.parse(app.dataset.bookings);

            const state = {
                courtIdx: null,
                date: null,
                startIdx: null,
                duration: 1,
                payType: 'full',
                bookingId: null,
            };

            // ---- Helpers ----
            function rupiah(n) { return 'Rp' + n.toLocaleString('id-ID'); }
            function ymd(d) {
                return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0');
            }
            function parseYmd(s) { return new Date(s + 'T00:00:00'); }
            function prettyDate(s) {
                return parseYmd(s).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            }
            function shortDate(s) {
                return parseYmd(s).toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' });
            }
            function isBooked(dateStr, courtIdx, timeIdx) {
                if (courtIdx === null || dateStr === null) return false;
                const courtId = COURTS[courtIdx].id;
                const timeStr = TIMES[timeIdx];
                
                // Parse checking time to a comparable integer (HHMM)
                const checkTimeInt = parseInt(timeStr.replace(':', ''), 10);
                
                return BOOKINGS.some(b => {
                    if (b.field_id !== courtId || b.tanggal !== dateStr) return false;
                    
                    const startInt = parseInt(b.jam_mulai.substring(0, 5).replace(':', ''), 10);
                    const endInt = parseInt(b.jam_selesai.substring(0, 5).replace(':', ''), 10);
                    
                    // A slot is booked if its time falls strictly within [start, end)
                    return checkTimeInt >= startInt && checkTimeInt < endInt;
                });
            }
            function endTimeLabel(startIdx, duration) {
                const endIdx = startIdx + duration;
                if (endIdx < TIMES.length) return TIMES[endIdx];
                const startHour = parseInt(TIMES[startIdx].slice(0, 2), 10);
                const endHour = (startHour + duration) % 24;
                return String(endHour).padStart(2, '0') + ':00';
            }
            function total() { return state.courtIdx === null ? 0 : COURTS[state.courtIdx].price * state.duration; }
            function maxDurationFrom(startIdx) {
                let run = 0;
                for (let k = 0; k < 3 && (startIdx + k) < TIMES.length; k++) {
                    if (isBooked(state.date, state.courtIdx, startIdx + k)) break;
                    run++;
                }
                return Math.max(1, run);
            }

            // ---- Stepper ----
            const stepMap = { 1: 0, 2: 1, 3: 2, 4: 3, 5: 4, 6: 5 };
            function showStep(n) {
                app.querySelectorAll('[data-step]').forEach(s => {
                    s.classList.toggle('hidden', s.dataset.step !== String(n));
                    if (s.dataset.step === String(n)) s.style.animation = 'none'; // reset animation
                });
                // trigger reflow for animation
                requestAnimationFrame(() => {
                    const el = app.querySelector('[data-step="' + n + '"]');
                    if (el) el.style.animation = '';
                });
                const active = stepMap[n];
                for (let i = 0; i < 6; i++) {
                    const dot = app.querySelector('[data-step-dot="' + i + '"]');
                    const lbl = app.querySelector('[data-step-label="' + i + '"]');
                    const bar = app.querySelector('[data-step-bar="' + i + '"]');
                    const done = i < active, cur = i === active;
                    dot.className = 'flex h-9 w-9 items-center justify-center rounded-full border-2 text-xs font-bold transition-all duration-200 ' +
                        (done ? 'border-[#0047D4] bg-[#0047D4] text-white'
                              : cur ? 'border-[#0047D4] bg-white text-[#0047D4] ring-4 ring-blue-100'
                                    : 'border-gray-200 bg-white text-gray-400');
                    dot.innerHTML = done ? '<svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"></path></svg>' : (i + 1);
                    if (lbl) lbl.className = 'hidden text-[11px] font-semibold sm:block ' + (done || cur ? 'text-[#0047D4]' : 'text-gray-400');
                    if (bar) bar.className = 'mx-1.5 h-0.5 flex-1 rounded transition-all duration-300 sm:mx-2 ' + (i < active ? 'bg-[#0047D4]' : 'bg-gray-200');
                }
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            // ---- Step 1: court ----
            app.querySelectorAll('[data-court-pick]').forEach(btn => {
                btn.addEventListener('click', () => {
                    state.courtIdx = parseInt(btn.dataset.courtPick, 10);
                    state.startIdx = null; state.duration = 1;
                    showStep(2);
                    initDateStep();
                });
            });

            // ---- Step 2: date ----
            const dateInput = document.getElementById('date-input');
            const nextDateBtn = app.querySelector('[data-next-date]');
            const quickWrap = document.getElementById('date-quickpicks');
            const today = new Date(); today.setHours(0, 0, 0, 0);

            function initDateStep() {
                // Update context chip
                const ctxCourt = app.querySelector('[data-ctx-court]');
                if (ctxCourt) ctxCourt.textContent = COURTS[state.courtIdx].name;

                dateInput.min = ymd(today);
                if (state.date) dateInput.value = state.date;
                quickWrap.innerHTML = '';
                for (let i = 0; i < 7; i++) {
                    const d = new Date(today); d.setDate(d.getDate() + i);
                    const b = document.createElement('button');
                    b.type = 'button';
                    b.dataset.qpick = ymd(d);
                    const dayName = d.toLocaleDateString('en-US', { weekday: 'short' });
                    const dayNum = d.getDate();
                    const label = i === 0 ? 'Today' : i === 1 ? 'Tomorrow' : dayName + ' ' + dayNum;
                    b.textContent = label;
                    b.className = 'rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150';
                    b.addEventListener('click', () => { dateInput.value = b.dataset.qpick; onDateChange(); });
                    quickWrap.appendChild(b);
                }
                syncDateUI();
            }
            function syncDateUI() {
                nextDateBtn.disabled = !dateInput.value;
                quickWrap.querySelectorAll('[data-qpick]').forEach(b => {
                    const on = b.dataset.qpick === dateInput.value;
                    if (on) {
                        b.className = 'rounded-xl border-2 border-[#0047D4] bg-blue-50 px-4 py-2.5 text-sm font-bold text-[#0047D4] shadow-xs transition-colors duration-150';
                    } else {
                        b.className = 'rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150';
                    }
                });
            }
            function onDateChange() {
                if (dateInput.value && parseYmd(dateInput.value) < today) dateInput.value = ymd(today);
                state.date = dateInput.value || null;
                state.startIdx = null;
                syncDateUI();
            }
            dateInput.addEventListener('change', onDateChange);
            nextDateBtn.addEventListener('click', () => { if (state.date) { showStep(3); renderTimes(); } });

            // ---- Step 3: time + duration ----
            const timeGrid = document.getElementById('time-grid');
            const nextTimeBtn = app.querySelector('[data-next-time]');
            const durLabel = app.querySelector('[data-dur-label]');
            const durDec = app.querySelector('[data-dur-dec]');
            const durInc = app.querySelector('[data-dur-inc]');
            const timeSubtitle = document.getElementById('time-subtitle');
            const pricePreview = document.getElementById('price-preview');
            const pricePreviewLabel = document.getElementById('price-preview-label');
            const pricePreviewTotal = document.getElementById('price-preview-total');

            function renderTimes() {
                // Update context chips
                const ctxCourt2 = app.querySelector('[data-ctx-court2]');
                if (ctxCourt2) ctxCourt2.textContent = COURTS[state.courtIdx].sport;
                const ctxDate = app.querySelector('[data-ctx-date]');
                if (ctxDate) ctxDate.textContent = shortDate(state.date);

                timeSubtitle.textContent = COURTS[state.courtIdx].name + ' — ' + prettyDate(state.date);
                timeGrid.innerHTML = '';
                TIMES.forEach((t, i) => {
                    const booked = isBooked(state.date, state.courtIdx, i);
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.textContent = t;
                    btn.disabled = booked;
                    btn.dataset.slot = i;
                    timeGrid.appendChild(btn);
                    btn.addEventListener('click', () => {
                        state.startIdx = i;
                        state.duration = Math.min(state.duration, maxDurationFrom(i));
                        paintSlots(); syncDuration(); syncPricePreview();
                    });
                });
                paintSlots(); syncDuration(); syncPricePreview();
            }
            function paintSlots() {
                const sel = state.startIdx;
                const dur = state.duration;
                timeGrid.querySelectorAll('[data-slot]').forEach(btn => {
                    const i = parseInt(btn.dataset.slot, 10);
                    const booked = btn.disabled;
                    const inRange = sel !== null && i >= sel && i < sel + dur;
                    if (booked) {
                        btn.className = 'cursor-not-allowed rounded-xl bg-gray-100 px-2 py-3 text-sm font-semibold text-gray-400 ring-1 ring-inset ring-gray-200';
                    } else if (inRange) {
                        btn.className = 'rounded-xl bg-[#0047D4] px-2 py-3 text-sm font-bold text-white shadow-md shadow-blue-500/20 ring-2 ring-[#0047D4] ring-offset-2 transition-all duration-150';
                    } else {
                        btn.className = 'rounded-xl bg-blue-50 px-2 py-3 text-sm font-semibold text-[#0047D4] ring-1 ring-inset ring-blue-100 hover:bg-[#0047D4] hover:text-white hover:shadow-md transition-all duration-150';
                    }
                });
                nextTimeBtn.disabled = sel === null;
            }
            function syncDuration() {
                durLabel.textContent = state.duration + (state.duration === 1 ? ' hour' : ' hours');
                const max = state.startIdx === null ? 1 : maxDurationFrom(state.startIdx);
                durDec.disabled = state.duration <= 1;
                durInc.disabled = state.startIdx === null || state.duration >= max;
            }
            function syncPricePreview() {
                if (state.startIdx === null) { pricePreview.style.display = 'none'; return; }
                pricePreview.style.display = '';
                const c = COURTS[state.courtIdx];
                pricePreviewLabel.textContent = c.sport + ' — ' + TIMES[state.startIdx] + ' to ' + endTimeLabel(state.startIdx, state.duration) + ' (' + state.duration + 'h)';
                pricePreviewTotal.textContent = rupiah(total());
            }
            durDec.addEventListener('click', () => { if (state.duration > 1) { state.duration--; paintSlots(); syncDuration(); syncPricePreview(); } });
            durInc.addEventListener('click', () => {
                if (state.startIdx === null) return;
                if (state.duration < maxDurationFrom(state.startIdx)) { state.duration++; paintSlots(); syncDuration(); syncPricePreview(); }
            });
            nextTimeBtn.addEventListener('click', () => { if (state.startIdx !== null) { renderReview(); showStep(4); } });

            // ---- Step 4: review ----
            function timeRangeLabel() {
                return TIMES[state.startIdx] + ' — ' + endTimeLabel(state.startIdx, state.duration);
            }
            function renderReview() {
                const c = COURTS[state.courtIdx];
                const banner = app.querySelector('[data-review-banner]');
                banner.className = 'relative h-28 bg-gradient-to-br overflow-hidden ' + c.gradient;
                app.querySelector('[data-review-sport]').textContent = c.sport;
                app.querySelector('[data-review-court-hero]').textContent = c.name;
                app.querySelector('[data-review-court]').textContent = c.name;
                app.querySelector('[data-review-date]').textContent = prettyDate(state.date);
                app.querySelector('[data-review-time]').textContent = timeRangeLabel();
                app.querySelector('[data-review-duration]').textContent = state.duration + (state.duration === 1 ? ' hour' : ' hours');
                app.querySelector('[data-review-rate-label]').textContent = rupiah(c.price) + '/hr × ' + state.duration;
                app.querySelector('[data-review-rate]').textContent = rupiah(total());
                app.querySelector('[data-review-total]').textContent = rupiah(total());
            }

            app.querySelector('[data-confirm]').addEventListener('click', () => {
                // Booking ID will be given by server later
                state.bookingId = 'SPO-.....';
                renderPayment();
                showStep(5);
                startTimer();
            });

            // ---- Step 5: payment ----
            const optFull = app.querySelector('[data-pay-option="full"]');
            const optDp = app.querySelector('[data-pay-option="dp"]');
            function payAmounts() {
                const t = total();
                const dp = Math.round(t / 2);
                return { t: t, pay: state.payType === 'dp' ? dp : t, remaining: state.payType === 'dp' ? t - dp : 0, dp: dp };
            }
            function setPayType(type) {
                state.payType = type;
                const on = (el, active) => {
                    el.className = 'flex cursor-pointer items-center justify-between rounded-2xl border-2 p-4 transition-all duration-150 hover:shadow-md ' +
                        (active ? 'border-[#0047D4] bg-blue-50/40' : 'border-gray-100 bg-white');
                    const radio = el.querySelector('[data-radio]');
                    radio.className = 'flex h-5 w-5 items-center justify-center rounded-full border-2 ' + (active ? 'border-[#0047D4]' : 'border-gray-300');
                    radio.innerHTML = active ? '<span class="h-2.5 w-2.5 rounded-full bg-[#0047D4]"></span>' : '';
                };
                on(optFull, type === 'full');
                on(optDp, type === 'dp');
                renderPayment();
            }
            optFull.addEventListener('click', () => setPayType('full'));
            optDp.addEventListener('click', () => setPayType('dp'));

            function renderPayment() {
                const a = payAmounts();
                app.querySelector('[data-pay-id]').textContent = state.bookingId;
                app.querySelector('[data-opt-full]').textContent = rupiah(a.t);
                app.querySelector('[data-opt-dp]').textContent = rupiah(a.dp);
                app.querySelector('[data-sum-total]').textContent = rupiah(a.t);
                app.querySelector('[data-sum-pay]').textContent = rupiah(a.pay);
                app.querySelector('[data-sum-remaining]').textContent = rupiah(a.remaining);
                app.querySelector('[data-qris-amount]').textContent = rupiah(a.pay);
                app.querySelector('[data-sum-remaining-row]').style.display = state.payType === 'dp' ? '' : 'none';
            }

            // Countdown timer for QRIS
            let timerInterval = null;
            function startTimer() {
                if (timerInterval) clearInterval(timerInterval);
                let secs = 15 * 60;
                const el = app.querySelector('[data-timer]');
                timerInterval = setInterval(() => {
                    secs--;
                    if (secs <= 0) { clearInterval(timerInterval); secs = 0; }
                    const m = Math.floor(secs / 60), s = secs % 60;
                    el.textContent = String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
                    if (secs <= 120) el.classList.add('text-rose-600');
                }, 1000);
            }

            app.querySelector('[data-paid]').addEventListener('click', async () => {
                if (timerInterval) clearInterval(timerInterval);
                
                const c = COURTS[state.courtIdx];
                const a = payAmounts();
                const payload = {
                    field_id: c.id,
                    tanggal: state.date,
                    jam_mulai: TIMES[state.startIdx],
                    durasi: state.duration,
                    pay_type: state.payType,
                    total_harga: a.t,
                    amount_paid: a.pay
                };

                const btn = app.querySelector('[data-paid]');
                const origText = btn.innerHTML;
                btn.innerHTML = 'Processing...';
                btn.disabled = true;

                try {
                    const res = await fetch('{{ route("booking.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(payload)
                    });
                    const data = await res.json();
                    
                    if (res.ok && data.success) {
                        state.bookingId = data.booking_id;
                        renderDone(); 
                        showStep(6);
                    } else {
                        alert(data.error || 'Terjadi kesalahan saat memproses pesanan.');
                        btn.innerHTML = origText;
                        btn.disabled = false;
                        startTimer();
                    }
                } catch (e) {
                    alert('Gagal menghubungi server.');
                    btn.innerHTML = origText;
                    btn.disabled = false;
                    startTimer();
                }
            });

            // ---- Step 6: confirmation ----
            function renderDone() {
                const a = payAmounts();
                const c = COURTS[state.courtIdx];
                app.querySelector('[data-done-id]').textContent = state.bookingId;
                app.querySelector('[data-done-court]').textContent = c.name;
                app.querySelector('[data-done-when]').textContent = prettyDate(state.date) + ' · ' + timeRangeLabel();
                app.querySelector('[data-done-total]').textContent = rupiah(a.t);
                const status = app.querySelector('[data-done-status]');
                if (state.payType === 'dp') {
                    status.className = 'inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-xs font-bold text-[#0047D4]';
                    status.textContent = 'Deposit paid';
                } else {
                    status.className = 'inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700';
                    status.textContent = 'Fully paid';
                }
                app.querySelector('[data-done-remaining]').textContent = rupiah(a.remaining);
                app.querySelector('[data-done-remaining-row]').style.display = state.payType === 'dp' ? '' : 'none';
            }

            // ---- Back buttons ----
            app.querySelectorAll('[data-back]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const cur = parseInt(btn.closest('[data-step]').dataset.step, 10);
                    if (cur === 5 && timerInterval) clearInterval(timerInterval);
                    showStep(Math.max(1, cur - 1));
                });
            });

            // ---- Init: deep-link or fresh start ----
            function tryPrefill() {
                if (!PREFILL.court || !PREFILL.date || !PREFILL.time) return false;
                const ci = COURTS.findIndex(c => c.name === PREFILL.court);
                const ti = TIMES.indexOf(PREFILL.time);
                if (ci === -1 || ti === -1) return false;
                if (parseYmd(PREFILL.date) < today) return false;
                if (isBooked(PREFILL.date, ci, ti)) return false;
                state.courtIdx = ci;
                state.date = PREFILL.date;
                state.startIdx = ti;
                state.duration = 1;
                dateInput.value = PREFILL.date;
                renderReview();
                showStep(4);
                return true;
            }

            setPayType('full');
            if (!tryPrefill()) { showStep(1); }
        })();
    </script>
</body>
</html>
