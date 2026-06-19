<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings | SportOps</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    @php
        // $history and $user are now provided by the BookingController

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

        $counts = [
            'All'       => count($history),
            'Upcoming'  => count(array_filter($history, fn ($r) => $r['status'] === 'Upcoming')),
            'Completed' => count(array_filter($history, fn ($r) => $r['status'] === 'Completed')),
            'Cancelled' => count(array_filter($history, fn ($r) => $r['status'] === 'Cancelled')),
        ];
    @endphp

    <!-- ============================ TOP NAVIGATION ============================ -->
    <header class="sticky top-0 z-50 border-b border-gray-100 bg-white/80 backdrop-blur-md">
        <nav class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 select-none">
                <div class="bg-white border border-gray-150 p-1.5 rounded-xl shadow-xs">
                    <img class="h-7 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                </div>
                <span class="hidden text-lg font-extrabold tracking-tight text-gray-900 sm:inline">SportOps</span>
            </a>

            <div class="hidden items-center gap-1 lg:flex">
                <a href="{{ route('dashboard') }}" class="rounded-lg px-3.5 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-[#0047D4] transition-colors duration-150">Dashboard</a>
                <a href="{{ route('booking') }}" class="rounded-lg px-3.5 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-[#0047D4] transition-colors duration-150">Book a Court</a>
                <a href="{{ route('bookings') }}" class="rounded-lg bg-blue-50 px-3.5 py-2 text-sm font-semibold text-[#0047D4]">My Bookings</a>
            </div>

            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ route('booking') }}" class="inline-flex items-center gap-2 rounded-xl bg-[#0047D4] px-3.5 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5v14"></path></svg>
                    <span class="hidden sm:inline">New booking</span>
                </a>
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $user['initials'] }}</span>
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8" id="history-page">

        <!-- Header -->
        <div class="flex flex-col gap-1">
            <nav class="flex items-center gap-1.5 text-xs font-medium text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-[#0047D4]">Dashboard</a>
                <span>/</span>
                <span class="text-gray-600">My Bookings</span>
            </nav>
            <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-gray-900">My Bookings</h1>
            <p class="text-sm text-gray-500">All your court reservations and payment history in one place.</p>
        </div>

        <!-- Filter tabs -->
        <div class="mt-6 flex flex-wrap gap-2" id="filter-tabs">
            @foreach (['All', 'Upcoming', 'Completed', 'Cancelled'] as $i => $tab)
                <button type="button" data-filter="{{ $tab }}"
                    class="inline-flex items-center gap-2 rounded-xl border px-4 py-2 text-sm font-semibold shadow-xs transition-colors duration-150 {{ $i === 0 ? 'border-[#0047D4] bg-[#0047D4] text-white' : 'border-gray-200 bg-white text-gray-600 hover:border-[#0047D4] hover:text-[#0047D4]' }}">
                    {{ $tab }}
                    <span class="rounded-full px-1.5 text-xs {{ $i === 0 ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-500' }}">{{ $counts[$tab] }}</span>
                </button>
            @endforeach
        </div>

        <!-- Table (desktop) -->
        <div class="mt-5 hidden overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-xs sm:block">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[760px] border-collapse text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/70 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            <th class="px-5 py-3.5">Booking ID</th>
                            <th class="px-5 py-3.5">Court</th>
                            <th class="px-5 py-3.5">Date</th>
                            <th class="px-5 py-3.5">Time</th>
                            <th class="px-5 py-3.5">Amount</th>
                            <th class="px-5 py-3.5">Payment</th>
                            <th class="px-5 py-3.5">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $row)
                            <tr data-row data-status="{{ $row['status'] }}" class="border-b border-gray-50 last:border-0 hover:bg-gray-50/60 transition-colors duration-150">
                                <td class="px-5 py-4 font-mono text-xs font-semibold text-gray-500">{{ $row['id'] }}</td>
                                <td class="px-5 py-4 font-semibold text-gray-900">{{ $row['court'] }}</td>
                                <td class="px-5 py-4 text-gray-500">{{ $row['date'] }}</td>
                                <td class="px-5 py-4 text-gray-500">{{ $row['time'] }}</td>
                                <td class="px-5 py-4 font-semibold text-gray-700">{{ $row['amount'] }}</td>
                                <td class="px-5 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $payStyles[$row['pay']] }}">{{ $row['pay'] }}</span></td>
                                <td class="px-5 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusStyles[$row['status']] }}">{{ $row['status'] }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Cards (mobile) -->
        <div class="mt-5 space-y-3 sm:hidden">
            @foreach ($history as $row)
                <div data-row data-status="{{ $row['status'] }}" class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-gray-500">{{ $row['id'] }}</span>
                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusStyles[$row['status']] }}">{{ $row['status'] }}</span>
                    </div>
                    <p class="mt-2 text-base font-bold text-gray-900">{{ $row['court'] }}</p>
                    <div class="mt-2 flex items-center gap-3 text-xs text-gray-500">
                        <span>{{ $row['date'] }}</span><span>·</span><span>{{ $row['time'] }}</span>
                    </div>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="text-sm font-bold text-gray-900">{{ $row['amount'] }}</span>
                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $payStyles[$row['pay']] }}">{{ $row['pay'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty state (per-filter) -->
        <div id="empty-state" class="mt-5 hidden rounded-3xl border border-dashed border-gray-200 bg-white p-12 text-center">
            <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-50 text-gray-400">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path></svg>
            </span>
            <p class="mt-4 text-sm font-bold text-gray-900">No bookings here yet</p>
            <p class="mt-1 text-sm text-gray-500" id="empty-text">You don't have any bookings in this category.</p>
            <a href="{{ route('booking') }}" class="mt-5 inline-flex items-center justify-center gap-2 rounded-xl bg-[#0047D4] px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                Book a court
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
            </a>
        </div>
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

    <script>
        (function () {
            const page = document.getElementById('history-page');
            const tabs = page.querySelectorAll('[data-filter]');
            const rows = page.querySelectorAll('[data-row]');
            const empty = document.getElementById('empty-state');
            const emptyText = document.getElementById('empty-text');

            function apply(filter) {
                let visible = 0;
                rows.forEach(r => {
                    const show = filter === 'All' || r.dataset.status === filter;
                    r.style.display = show ? '' : 'none';
                    if (show) visible++;
                });
                empty.classList.toggle('hidden', visible !== 0);
                emptyText.textContent = filter === 'All'
                    ? "You haven't made any bookings yet."
                    : 'You have no ' + filter.toLowerCase() + ' bookings.';
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => {
                        const on = t === tab;
                        t.className = 'inline-flex items-center gap-2 rounded-xl border px-4 py-2 text-sm font-semibold shadow-xs transition-colors duration-150 ' +
                            (on ? 'border-[#0047D4] bg-[#0047D4] text-white' : 'border-gray-200 bg-white text-gray-600 hover:border-[#0047D4] hover:text-[#0047D4]');
                        const badge = t.querySelector('span');
                        if (badge) badge.className = 'rounded-full px-1.5 text-xs ' + (on ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-500');
                    });
                    apply(tab.dataset.filter);
                });
            });
        })();
    </script>
</body>
</html>
