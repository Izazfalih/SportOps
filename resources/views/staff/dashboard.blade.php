@extends('layouts.staff')

@section('title', 'Staff Dashboard')
@section('page-title', 'Staff Dashboard')

@section('content')

    @php
$staff = [
            'name' => Auth::user()->name ?? 'Pak Joko (Staff)',
        ];

        $kpis = [
            ['label' => "Today's Bookings", 'value' => 8, 'color' => 'blue',  'icon' => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
            ['label' => 'Checked In',       'value' => 3, 'color' => 'green', 'icon' => '<path d="M20 6 9 17l-5-5"/>'],
            ['label' => 'Pending Check-In',  'value' => 4, 'color' => 'amber', 'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>'],
            ['label' => 'Pending Settlement','value' => 2, 'color' => 'rose',  'icon' => '<rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/>'],
        ];

        $kpiStyles = [
            'blue'  => ['bg' => 'bg-blue-50',  'text' => 'text-[#0047D4]', 'icon_bg' => 'bg-blue-100'],
            'green' => ['bg' => 'bg-emerald-50','text' => 'text-emerald-600','icon_bg' => 'bg-emerald-100'],
            'amber' => ['bg' => 'bg-amber-50',  'text' => 'text-amber-600', 'icon_bg' => 'bg-amber-100'],
            'rose'  => ['bg' => 'bg-rose-50',   'text' => 'text-rose-600',  'icon_bg' => 'bg-rose-100'],
        ];

        $schedule = [
            ['time' => '10:00 – 11:00', 'customer' => 'Budi Santoso',  'sport' => 'Futsal',     'payment' => 'Fully Paid',  'payment_color' => 'emerald', 'status' => 'Checked In', 'status_color' => 'emerald'],
            ['time' => '11:00 – 12:00', 'customer' => 'Sarah Putri',   'sport' => 'Badminton',  'payment' => 'DP Paid',     'payment_color' => 'amber',   'status' => 'Booked',     'status_color' => 'amber'],
            ['time' => '13:00 – 14:00', 'customer' => 'Ahmad Fauzi',   'sport' => 'Basketball', 'payment' => 'Fully Paid',  'payment_color' => 'emerald', 'status' => 'Booked',     'status_color' => 'blue'],
            ['time' => '14:00 – 15:00', 'customer' => 'Dimas Pratama', 'sport' => 'Tennis',     'payment' => 'Pending',     'payment_color' => 'gray',    'status' => 'Booked',     'status_color' => 'gray'],
            ['time' => '15:00 – 16:00', 'customer' => 'Rina Wijaya',   'sport' => 'Futsal',     'payment' => 'Fully Paid',  'payment_color' => 'emerald', 'status' => 'Booked',     'status_color' => 'blue'],
        ];

        $badgeStyles = [
            'emerald' => 'bg-emerald-50 text-emerald-700',
            'amber'   => 'bg-amber-50 text-amber-700',
            'blue'    => 'bg-blue-50 text-[#0047D4]',
            'gray'    => 'bg-gray-100 text-gray-600',
            'rose'    => 'bg-rose-50 text-rose-700',
        ];

        $courts = [
            ['name' => 'Futsal Court',     'status' => 'In Use',      'color' => 'emerald'],
            ['name' => 'Badminton Court',   'status' => 'Available',   'color' => 'blue'],
            ['name' => 'Tennis Court',      'status' => 'Maintenance', 'color' => 'rose'],
            ['name' => 'Basketball Court',  'status' => 'Booked Next', 'color' => 'amber'],
            ['name' => 'Volleyball Court',  'status' => 'Available',   'color' => 'blue'],
        ];

        $courtDot = [
            'emerald' => 'bg-emerald-500',
            'blue'    => 'bg-blue-500',
            'rose'    => 'bg-rose-500',
            'amber'   => 'bg-amber-500',
        ];

        $courtBadge = [
            'emerald' => 'bg-emerald-50 text-emerald-700',
            'blue'    => 'bg-blue-50 text-[#0047D4]',
            'rose'    => 'bg-rose-50 text-rose-700',
            'amber'   => 'bg-amber-50 text-amber-700',
        ];
    @endphp


{{-- ============ WELCOME BANNER ============ --}}
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#00277a] via-[#0047D4] to-indigo-700 p-5 shadow-lg shadow-blue-900/10 sm:p-6">
                <div class="pointer-events-none absolute -right-8 -top-12 h-48 w-48 rounded-full bg-white/10 blur-2xl"></div>
                <div class="pointer-events-none absolute -bottom-12 right-16 h-40 w-40 rounded-full bg-sky-300/20 blur-3xl"></div>
                <div class="relative flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-xl font-extrabold text-white sm:text-2xl">Good morning, {{ $staff['name'] }} 👋</h2>
                        <p class="mt-1 text-sm text-blue-100/90">You have <span class="font-bold text-white">8 bookings</span> today</p>
                    </div>
                    <a href="{{ route('staff.schedule') }}" class="mt-3 inline-flex items-center justify-center gap-2 self-start rounded-xl bg-white/15 px-4 py-2 text-sm font-semibold text-white backdrop-blur-sm transition-colors duration-150 hover:bg-white/25 sm:mt-0">
                        View Schedule
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </section>

            {{-- ============ KPI CARDS ============ --}}
            <div class="mt-6 grid grid-cols-2 gap-4 lg:grid-cols-4">
                @foreach ($kpis as $kpi)
                    @php $s = $kpiStyles[$kpi['color']]; @endphp
                    <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs sm:p-5">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl {{ $s['icon_bg'] }} {{ $s['text'] }}">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $kpi['icon'] !!}</svg>
                            </span>
                            <div class="min-w-0">
                                <p class="text-2xl font-extrabold text-gray-900">{{ $kpi['value'] }}</p>
                                <p class="truncate text-xs text-gray-500">{{ $kpi['label'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ============ SCHEDULE + QUICK ACTIONS ROW ============ --}}
            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- Today's Quick Schedule --}}
                <div class="lg:col-span-2 rounded-2xl border border-gray-100 bg-white shadow-xs">
                    <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4 sm:px-6">
                        <div>
                            <h3 class="text-sm font-bold text-gray-900">Today's Quick Schedule</h3>
                            <p class="text-xs text-gray-400">Next 5 upcoming bookings</p>
                        </div>
                        <a href="{{ route('staff.schedule') }}" class="text-xs font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors duration-150">View All →</a>
                    </div>

                    {{-- Desktop table --}}
                    <div class="hidden sm:block overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-400">
                                    <th class="px-5 py-3 sm:px-6">Time</th>
                                    <th class="px-5 py-3 sm:px-6">Customer</th>
                                    <th class="px-5 py-3 sm:px-6">Sport</th>
                                    <th class="px-5 py-3 sm:px-6">Payment</th>
                                    <th class="px-5 py-3 sm:px-6">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach ($schedule as $row)
                                    <tr class="hover:bg-gray-50/50 transition-colors duration-100">
                                        <td class="whitespace-nowrap px-5 py-3.5 sm:px-6 font-medium text-gray-900">{{ $row['time'] }}</td>
                                        <td class="whitespace-nowrap px-5 py-3.5 sm:px-6 text-gray-700">{{ $row['customer'] }}</td>
                                        <td class="whitespace-nowrap px-5 py-3.5 sm:px-6 text-gray-700">{{ $row['sport'] }}</td>
                                        <td class="whitespace-nowrap px-5 py-3.5 sm:px-6">
                                            <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $badgeStyles[$row['payment_color']] }}">{{ $row['payment'] }}</span>
                                        </td>
                                        <td class="whitespace-nowrap px-5 py-3.5 sm:px-6">
                                            <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $badgeStyles[$row['status_color']] }}">{{ $row['status'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Mobile cards --}}
                    <div class="sm:hidden divide-y divide-gray-50">
                        @foreach ($schedule as $row)
                            <div class="px-5 py-4">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold text-gray-900">{{ $row['customer'] }}</p>
                                    <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $badgeStyles[$row['status_color']] }}">{{ $row['status'] }}</span>
                                </div>
                                <div class="mt-1.5 flex items-center gap-3 text-xs text-gray-500">
                                    <span>{{ $row['time'] }}</span>
                                    <span>·</span>
                                    <span>{{ $row['sport'] }}</span>
                                    <span>·</span>
                                    <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold {{ $badgeStyles[$row['payment_color']] }}">{{ $row['payment'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs sm:p-6">
                    <h3 class="text-sm font-bold text-gray-900">Quick Actions</h3>
                    <p class="text-xs text-gray-400">Common staff operations</p>

                    <div class="mt-5 space-y-3">
                        <a href="{{ route('staff.checkin') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-white p-3.5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition-colors duration-200 group-hover:bg-emerald-600 group-hover:text-white">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Check-In Customer</p>
                                <p class="text-xs text-gray-400">Verify & confirm arrival</p>
                            </div>
                        </a>

                        <a href="{{ route('staff.offline-booking') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-white p-3.5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#0047D4] transition-colors duration-200 group-hover:bg-[#0047D4] group-hover:text-white">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5v14"/></svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">New Walk-In Booking</p>
                                <p class="text-xs text-gray-400">Register on-site customer</p>
                            </div>
                        </a>

                        <a href="{{ route('staff.settlement') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-white p-3.5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:border-amber-200 hover:shadow-md">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600 transition-colors duration-200 group-hover:bg-amber-600 group-hover:text-white">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/></svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Settle Payment</p>
                                <p class="text-xs text-gray-400">Complete remaining balances</p>
                            </div>
                        </a>

                        <a href="{{ route('staff.schedule') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-white p-3.5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-md">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 transition-colors duration-200 group-hover:bg-indigo-600 group-hover:text-white">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">View Full Schedule</p>
                                <p class="text-xs text-gray-400">All today's bookings</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- ============ COURT STATUS ============ --}}
            <section class="mt-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">Court Status</h3>
                        <p class="text-xs text-gray-400">Real-time court availability</p>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
                    @foreach ($courts as $court)
                        <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs transition-all duration-200 hover:shadow-md">
                            <div class="flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full {{ $courtDot[$court['color']] }}"></span>
                                <span class="inline-flex rounded-full px-2.5 py-0.5 text-[11px] font-semibold {{ $courtBadge[$court['color']] }}">{{ $court['status'] }}</span>
                            </div>
                            <p class="mt-3 text-sm font-bold text-gray-900">{{ $court['name'] }}</p>
                            <div class="mt-2">
                                <svg class="h-5 w-5 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    @if ($court['status'] === 'In Use')
                                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                                    @elseif ($court['status'] === 'Available')
                                        <path d="M20 6 9 17l-5-5"/>
                                    @elseif ($court['status'] === 'Maintenance')
                                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                    @else
                                        <rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
                                    @endif
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

@endsection
