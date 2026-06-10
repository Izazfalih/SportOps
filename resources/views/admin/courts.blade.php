<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courts Management | SportOps Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    @php
        $courts = [
            [
                'name'        => 'Lapangan Futsal',
                'sport'       => 'Futsal',
                'price'       => 150000,
                'status'      => 'Active',
                'description' => 'Indoor futsal court with FIFA-standard synthetic turf. Ideal for 5v5 and 6v6 matches with full lighting.',
                'icon'        => 'futsal',
            ],
            [
                'name'        => 'Lapangan Badminton',
                'sport'       => 'Badminton',
                'price'       => 75000,
                'status'      => 'Active',
                'description' => 'Professional-grade badminton court with sprung wooden flooring and BWF-approved net system.',
                'icon'        => 'badminton',
            ],
            [
                'name'        => 'Lapangan Tennis',
                'sport'       => 'Tennis',
                'price'       => 120000,
                'status'      => 'Maintenance',
                'description' => 'Hard-court tennis surface currently undergoing scheduled resurfacing. Expected back online soon.',
                'icon'        => 'tennis',
            ],
            [
                'name'        => 'Lapangan Basket',
                'sport'       => 'Basketball',
                'price'       => 200000,
                'status'      => 'Active',
                'description' => 'Full-size indoor basketball court with professional-grade maple flooring and electronic scoreboard.',
                'icon'        => 'basketball',
            ],
            [
                'name'        => 'Lapangan Voli',
                'sport'       => 'Volleyball',
                'price'       => 100000,
                'status'      => 'Active',
                'description' => 'Regulation indoor volleyball court with cushioned flooring and adjustable net height system.',
                'icon'        => 'volleyball',
            ],
        ];

        $sportColors = [
            'Futsal'     => ['bg' => 'bg-emerald-50',  'text' => 'text-emerald-700',  'icon_bg' => 'bg-emerald-100'],
            'Badminton'  => ['bg' => 'bg-sky-50',      'text' => 'text-sky-700',      'icon_bg' => 'bg-sky-100'],
            'Tennis'     => ['bg' => 'bg-amber-50',     'text' => 'text-amber-700',    'icon_bg' => 'bg-amber-100'],
            'Basketball' => ['bg' => 'bg-orange-50',    'text' => 'text-orange-700',   'icon_bg' => 'bg-orange-100'],
            'Volleyball' => ['bg' => 'bg-violet-50',    'text' => 'text-violet-700',   'icon_bg' => 'bg-violet-100'],
        ];

        $navItems = [
            ['label' => 'Dashboard',         'route' => 'admin.dashboard', 'icon' => 'dashboard'],
            ['label' => 'Courts Management', 'route' => 'admin.courts',    'icon' => 'courts'],
            ['label' => 'Bookings',          'route' => 'admin.bookings',  'icon' => 'bookings'],
            ['label' => 'Users',             'route' => 'admin.users',     'icon' => 'users'],
            ['label' => 'Financial Reports', 'route' => 'admin.reports',   'icon' => 'reports'],
            ['label' => 'Settings',          'route' => 'admin.settings',  'icon' => 'settings'],
        ];

        $activeRoute = 'admin.courts';
    @endphp

    <div class="flex h-full">

        {{-- ======================== SIDEBAR (Desktop) ======================== --}}
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col border-r border-gray-100 bg-white transition-transform duration-300 lg:translate-x-0 -translate-x-full">

            {{-- Brand --}}
            <div class="flex h-16 items-center gap-2.5 border-b border-gray-100 px-5">
                <div class="bg-white border border-gray-150 p-1.5 rounded-xl shadow-xs">
                    <img class="h-7 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                </div>
                <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
                <button type="button" onclick="toggleSidebar()" class="ml-auto rounded-lg p-1 text-gray-400 hover:text-gray-600 lg:hidden" aria-label="Close sidebar">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                </button>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto px-3 py-4">
                <p class="mb-2 px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400">Menu</p>
                <ul class="space-y-1">
                    @foreach ($navItems as $item)
                        @php
                            $isActive = $item['route'] === $activeRoute;
                        @endphp
                        <li>
                            <a href="{{ route($item['route']) }}"
                               class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-colors duration-150
                                      {{ $isActive
                                          ? 'bg-blue-50 text-[#0047D4] font-semibold'
                                          : 'text-gray-600 hover:bg-gray-50 hover:text-[#0047D4]' }}">

                                {{-- Icons --}}
                                @if ($item['icon'] === 'dashboard')
                                    <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"></rect><rect width="7" height="5" x="14" y="3" rx="1"></rect><rect width="7" height="9" x="14" y="12" rx="1"></rect><rect width="7" height="5" x="3" y="16" rx="1"></rect></svg>
                                @elseif ($item['icon'] === 'courts')
                                    <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"></rect><path d="M3 12h18"></path><path d="M12 3v18"></path></svg>
                                @elseif ($item['icon'] === 'bookings')
                                    <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path></svg>
                                @elseif ($item['icon'] === 'users')
                                    <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                @elseif ($item['icon'] === 'reports')
                                    <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><path d="M8 13h2"></path><path d="M8 17h2"></path><path d="M14 13h2"></path><path d="M14 17h2"></path></svg>
                                @elseif ($item['icon'] === 'settings')
                                    <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                @endif

                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            {{-- Logout --}}
            <div class="border-t border-gray-100 px-3 py-4">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-gray-600 transition-colors duration-150 hover:bg-rose-50 hover:text-rose-600">
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Sidebar overlay (mobile) --}}
        <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 z-30 bg-gray-900/50 backdrop-blur-sm transition-opacity duration-300 hidden lg:hidden"></div>

        {{-- ======================== MAIN AREA ======================== --}}
        <div class="flex flex-1 flex-col lg:ml-64">

            {{-- Top bar --}}
            <header class="sticky top-0 z-20 flex h-16 items-center gap-4 border-b border-gray-100 bg-white/80 px-4 backdrop-blur-md sm:px-6 lg:px-8">
                <button type="button" onclick="toggleSidebar()" class="rounded-xl border border-gray-150 bg-white p-2 text-gray-500 shadow-xs hover:text-[#0047D4] lg:hidden" aria-label="Open sidebar">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="7" x2="20" y2="7"></line><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="17" x2="20" y2="17"></line></svg>
                </button>

                <div class="flex items-center gap-2">
                    <nav class="hidden text-sm text-gray-400 sm:flex items-center gap-1.5">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#0047D4] transition-colors duration-150">Admin</a>
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"></path></svg>
                        <span class="font-medium text-gray-700">Courts Management</span>
                    </nav>
                </div>

                <div class="ml-auto flex items-center gap-3">
                    <button type="button" class="relative inline-flex items-center justify-center rounded-xl border border-gray-150 bg-white p-2.5 text-gray-500 shadow-xs hover:text-[#0047D4] hover:border-blue-200 transition-colors duration-150" aria-label="Notifications">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.268 21a2 2 0 0 0 3.464 0"></path><path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"></path></svg>
                        <span class="absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-[#0047D4] text-[9px] font-bold text-white ring-2 ring-white">2</span>
                    </button>

                    <div class="flex items-center gap-2 rounded-xl border border-gray-150 bg-white p-1 pr-3 shadow-xs">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">AD</span>
                        <span class="hidden text-sm font-semibold text-gray-700 sm:inline">Admin</span>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

                {{-- Page Header --}}
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Courts Management</h1>
                        <p class="mt-1 text-sm text-gray-500">Manage all sport courts, pricing, and availability.</p>
                    </div>
                    <button type="button" onclick="openModal()" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#0047D4] px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.98] transition-all duration-200">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                        Add Court
                    </button>
                </div>

                {{-- Stats Row --}}
                <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-4">
                    <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Total Courts</p>
                        <p class="mt-1 text-2xl font-extrabold text-gray-900">{{ count($courts) }}</p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Active</p>
                        <p class="mt-1 text-2xl font-extrabold text-emerald-600">{{ collect($courts)->where('status', 'Active')->count() }}</p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Maintenance</p>
                        <p class="mt-1 text-2xl font-extrabold text-amber-600">{{ collect($courts)->where('status', 'Maintenance')->count() }}</p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Avg. Price</p>
                        <p class="mt-1 text-2xl font-extrabold text-gray-900">Rp {{ number_format(collect($courts)->avg('price'), 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Court Cards Grid --}}
                <div class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($courts as $court)
                        @php
                            $colors = $sportColors[$court['sport']];
                            $isActive = $court['status'] === 'Active';
                        @endphp
                        <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-500/10">

                            {{-- Image Placeholder --}}
                            <div class="relative flex h-44 items-center justify-center {{ $colors['icon_bg'] }} overflow-hidden">
                                @if (!$isActive)
                                    <div class="absolute inset-0 bg-gray-900/30 backdrop-blur-[1px]"></div>
                                    <span class="absolute right-3 top-3 z-10 rounded-full bg-red-500 px-3 py-1 text-xs font-bold text-white shadow-sm">Maintenance</span>
                                @endif

                                @if ($court['icon'] === 'futsal')
                                    <svg class="h-16 w-16 text-emerald-400/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"></path></svg>
                                @elseif ($court['icon'] === 'badminton')
                                    <svg class="h-16 w-16 text-sky-400/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path><path d="M2 12h20"></path></svg>
                                @elseif ($court['icon'] === 'tennis')
                                    <svg class="h-16 w-16 text-amber-400/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M18.09 5.91A5.97 5.97 0 0 0 12 4a5.97 5.97 0 0 0-6.09 1.91"></path><path d="M5.91 18.09A5.97 5.97 0 0 0 12 20a5.97 5.97 0 0 0 6.09-1.91"></path><path d="M2 12h20"></path></svg>
                                @elseif ($court['icon'] === 'basketball')
                                    <svg class="h-16 w-16 text-orange-400/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 2v20"></path><path d="M2 12h20"></path><path d="M4.93 4.93c4.08 2.64 4.08 11.5 0 14.14"></path><path d="M19.07 4.93c-4.08 2.64-4.08 11.5 0 14.14"></path></svg>
                                @elseif ($court['icon'] === 'volleyball')
                                    <svg class="h-16 w-16 text-violet-400/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 2a10 10 0 0 1 0 20"></path><path d="M2 12h10"></path><path d="M12 12 7.5 3.5"></path><path d="M12 12 7.5 20.5"></path></svg>
                                @endif
                            </div>

                            {{-- Card Body --}}
                            <div class="p-5">
                                {{-- Sport Badge + Status --}}
                                <div class="flex items-center justify-between">
                                    <span class="inline-flex items-center rounded-lg px-2.5 py-1 text-xs font-semibold {{ $colors['bg'] }} {{ $colors['text'] }}">
                                        {{ $court['sport'] }}
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 text-xs font-medium {{ $isActive ? 'text-emerald-600' : 'text-red-500' }}">
                                        <span class="h-2 w-2 rounded-full {{ $isActive ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                        {{ $court['status'] }}
                                    </span>
                                </div>

                                {{-- Name --}}
                                <h3 class="mt-3 text-lg font-bold text-gray-900">{{ $court['name'] }}</h3>

                                {{-- Price --}}
                                <p class="mt-1 text-sm font-semibold text-[#0047D4]">Rp {{ number_format($court['price'], 0, ',', '.') }}<span class="font-normal text-gray-400">/hour</span></p>

                                {{-- Description --}}
                                <p class="mt-3 line-clamp-2 text-sm leading-relaxed text-gray-500">{{ $court['description'] }}</p>

                                {{-- Actions --}}
                                <div class="mt-5 flex items-center gap-2">
                                    <button type="button" class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-xs transition-all duration-150 hover:border-[#0047D4] hover:text-[#0047D4]">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path><path d="m15 5 4 4"></path></svg>
                                        Edit
                                    </button>

                                    @if ($isActive)
                                        <button type="button" class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-600 shadow-xs transition-all duration-150 hover:bg-red-50">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64A9 9 0 0 1 20.77 15"></path><path d="M6.16 6.16a9 9 0 1 0 12.68 12.68"></path><path d="M12 2v4"></path><path d="m2 2 20 20"></path></svg>
                                            Deactivate
                                        </button>
                                    @else
                                        <button type="button" class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-xl border border-emerald-200 bg-white px-4 py-2.5 text-sm font-semibold text-emerald-600 shadow-xs transition-all duration-150 hover:bg-emerald-50">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path><path d="m9 12 2 2 4-4"></path></svg>
                                            Activate
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>

    {{-- ======================== ADD COURT MODAL ======================== --}}
    <div id="add-court-modal" class="fixed inset-0 z-50 hidden">
        {{-- Backdrop --}}
        <div onclick="closeModal()" class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity duration-300"></div>

        {{-- Modal Panel --}}
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="relative w-full max-w-lg rounded-3xl border border-gray-100 bg-white shadow-2xl">

                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <h2 class="text-lg font-bold text-gray-900">Add New Court</h2>
                    <button type="button" onclick="closeModal()" class="rounded-xl p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors duration-150" aria-label="Close modal">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                    </button>
                </div>

                {{-- Form --}}
                <form class="px-6 py-5 space-y-5">

                    {{-- Court Name --}}
                    <div>
                        <label for="court-name" class="block text-sm font-semibold text-gray-700">Court Name</label>
                        <input type="text" id="court-name" placeholder="e.g. Lapangan Futsal" class="mt-1.5 w-full rounded-xl border border-gray-200 bg-[#F7F8FA] px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 outline-none transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10">
                    </div>

                    {{-- Sport Type --}}
                    <div>
                        <label for="sport-type" class="block text-sm font-semibold text-gray-700">Sport Type</label>
                        <select id="sport-type" class="mt-1.5 w-full rounded-xl border border-gray-200 bg-[#F7F8FA] px-4 py-2.5 text-sm text-gray-900 outline-none transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10">
                            <option value="" disabled selected>Select a sport</option>
                            <option value="Futsal">Futsal</option>
                            <option value="Badminton">Badminton</option>
                            <option value="Tennis">Tennis</option>
                            <option value="Basketball">Basketball</option>
                            <option value="Volleyball">Volleyball</option>
                        </select>
                    </div>

                    {{-- Fixed Price --}}
                    <div>
                        <label for="court-price" class="block text-sm font-semibold text-gray-700">Fixed Price per Hour</label>
                        <div class="relative mt-1.5">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-sm font-semibold text-gray-500">Rp</span>
                            <input type="number" id="court-price" placeholder="150000" class="w-full rounded-xl border border-gray-200 bg-[#F7F8FA] py-2.5 pl-10 pr-4 text-sm text-gray-900 placeholder-gray-400 outline-none transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="court-desc" class="block text-sm font-semibold text-gray-700">Description</label>
                        <textarea id="court-desc" rows="3" placeholder="Brief description of the court..." class="mt-1.5 w-full resize-none rounded-xl border border-gray-200 bg-[#F7F8FA] px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 outline-none transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10"></textarea>
                    </div>

                    {{-- Image Upload --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Court Image</label>
                        <div id="upload-zone" class="mt-1.5 flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-200 bg-[#F7F8FA] p-6 transition-colors duration-150 hover:border-[#0047D4] hover:bg-blue-50/30">
                            <svg class="h-8 w-8 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                            <p class="mt-2 text-sm font-medium text-gray-500">Click to upload or drag and drop</p>
                            <p class="mt-1 text-xs text-gray-400">PNG, JPG up to 5MB</p>
                            <input type="file" id="court-image" accept="image/*" class="hidden">
                        </div>
                    </div>
                </form>

                {{-- Footer --}}
                <div class="flex items-center justify-end gap-3 border-t border-gray-100 px-6 py-4">
                    <button type="button" onclick="closeModal()" class="rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-xs transition-colors duration-150 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="button" class="rounded-xl bg-[#0047D4] px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 transition-all duration-200 hover:bg-[#003cb5] active:scale-[0.98]">
                        Save Court
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const isOpen = !sidebar.classList.contains('-translate-x-full');

            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }
        }

        // Modal open/close
        function openModal() {
            document.getElementById('add-court-modal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal() {
            document.getElementById('add-court-modal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });

        // Upload zone click handler
        document.getElementById('upload-zone').addEventListener('click', function () {
            document.getElementById('court-image').click();
        });

        // Upload zone drag-and-drop visual feedback
        const uploadZone = document.getElementById('upload-zone');
        uploadZone.addEventListener('dragover', function (e) {
            e.preventDefault();
            this.classList.add('border-[#0047D4]', 'bg-blue-50/30');
        });
        uploadZone.addEventListener('dragleave', function () {
            this.classList.remove('border-[#0047D4]', 'bg-blue-50/30');
        });
        uploadZone.addEventListener('drop', function (e) {
            e.preventDefault();
            this.classList.remove('border-[#0047D4]', 'bg-blue-50/30');
        });
    </script>
</body>
</html>
