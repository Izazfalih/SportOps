@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    @php
$kpis = [
            [
                'label'   => "Today's Bookings",
                'value'   => '12',
                'change'  => '+18%',
                'up'      => true,
                'color'   => 'blue',
                'bgClass' => 'bg-blue-50',
                'txtClass'=> 'text-[#0047D4]',
                'icon'    => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
            ],
            [
                'label'   => 'Active Bookings',
                'value'   => '5',
                'change'  => '+2',
                'up'      => true,
                'color'   => 'emerald',
                'bgClass' => 'bg-emerald-50',
                'txtClass'=> 'text-emerald-600',
                'icon'    => '<path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2"/>',
            ],
            [
                'label'   => 'Total Revenue',
                'value'   => 'Rp 45,800,000',
                'change'  => '+12%',
                'up'      => true,
                'color'   => 'violet',
                'bgClass' => 'bg-violet-50',
                'txtClass'=> 'text-violet-600',
                'icon'    => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
            ],
            [
                'label'   => 'Total Users',
                'value'   => '328',
                'change'  => '+24',
                'up'      => true,
                'color'   => 'amber',
                'bgClass' => 'bg-amber-50',
                'txtClass'=> 'text-amber-600',
                'icon'    => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
            ],
            [
                'label'   => 'Court Utilization',
                'value'   => '78%',
                'change'  => '+5%',
                'up'      => true,
                'color'   => 'rose',
                'bgClass' => 'bg-rose-50',
                'txtClass'=> 'text-rose-600',
                'icon'    => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>',
            ],
        ];

        $activities = [
            [
                'title'   => 'New booking by Ahmad Fauzi',
                'desc'    => 'Futsal, Today 14:00–15:00',
                'time'    => '5 min ago',
                'color'   => 'bg-blue-500',
                'icon'    => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
            ],
            [
                'title'   => 'Payment received',
                'desc'    => 'Rp 150,000 from Sarah Putri',
                'time'    => '12 min ago',
                'color'   => 'bg-emerald-500',
                'icon'    => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
            ],
            [
                'title'   => 'New user registered',
                'desc'    => 'Dimas Pratama',
                'time'    => '1 hour ago',
                'color'   => 'bg-violet-500',
                'icon'    => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>',
            ],
            [
                'title'   => 'Booking completed',
                'desc'    => 'Basketball, Budi Santoso',
                'time'    => '2 hours ago',
                'color'   => 'bg-amber-500',
                'icon'    => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>',
            ],
            [
                'title'   => 'Court Tennis deactivated',
                'desc'    => 'Scheduled maintenance',
                'time'    => '3 hours ago',
                'color'   => 'bg-rose-500',
                'icon'    => '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>',
            ],
        ];

        $quickStats = [
            ['label' => 'Courts Available', 'value' => '8 / 12',  'color' => 'text-emerald-600'],
            ['label' => 'Pending Payments',  'value' => '3',       'color' => 'text-amber-600'],
            ['label' => 'Revenue Today',     'value' => 'Rp 2.4M', 'color' => 'text-[#0047D4]'],
            ['label' => 'New Users (Week)',  'value' => '14',       'color' => 'text-violet-600'],
        ];

        $bookings = [
            [
                'name'      => 'Ahmad Fauzi',
                'sport'     => 'Futsal',
                'date'      => '10 Jun 2026',
                'time'      => '14:00 – 15:00',
                'payment'   => 'Fully Paid',
                'payColor'  => 'bg-emerald-50 text-emerald-700',
                'status'    => 'Confirmed',
                'statColor' => 'bg-blue-50 text-[#0047D4]',
            ],
            [
                'name'      => 'Sarah Putri',
                'sport'     => 'Badminton',
                'date'      => '10 Jun 2026',
                'time'      => '15:00 – 16:00',
                'payment'   => 'DP Paid',
                'payColor'  => 'bg-amber-50 text-amber-700',
                'status'    => 'Confirmed',
                'statColor' => 'bg-blue-50 text-[#0047D4]',
            ],
            [
                'name'      => 'Budi Santoso',
                'sport'     => 'Basketball',
                'date'      => '10 Jun 2026',
                'time'      => '16:00 – 17:00',
                'payment'   => 'Pending',
                'payColor'  => 'bg-gray-100 text-gray-600',
                'status'    => 'Pending Payment',
                'statColor' => 'bg-amber-50 text-amber-700',
            ],
            [
                'name'      => 'Dimas Pratama',
                'sport'     => 'Tennis',
                'date'      => '10 Jun 2026',
                'time'      => '17:00 – 18:00',
                'payment'   => 'Fully Paid',
                'payColor'  => 'bg-emerald-50 text-emerald-700',
                'status'    => 'Checked In',
                'statColor' => 'bg-purple-50 text-purple-700',
            ],
            [
                'name'      => 'Rina Anggraini',
                'sport'     => 'Futsal',
                'date'      => '11 Jun 2026',
                'time'      => '09:00 – 10:00',
                'payment'   => 'DP Paid',
                'payColor'  => 'bg-amber-50 text-amber-700',
                'status'    => 'Confirmed',
                'statColor' => 'bg-blue-50 text-[#0047D4]',
            ],
            [
                'name'      => 'Fajar Hidayat',
                'sport'     => 'Badminton',
                'date'      => '11 Jun 2026',
                'time'      => '10:00 – 11:00',
                'payment'   => 'Pending',
                'payColor'  => 'bg-gray-100 text-gray-600',
                'status'    => 'Pending Payment',
                'statColor' => 'bg-amber-50 text-amber-700',
            ],
        ];
    @endphp


{{-- ============ KPI METRIC CARDS ============ --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
                @foreach ($kpis as $kpi)
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                        <div class="flex items-center justify-between">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl {{ $kpi['bgClass'] }} {{ $kpi['txtClass'] }}">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $kpi['icon'] !!}</svg>
                            </span>
                            <span class="inline-flex items-center gap-1 rounded-full {{ $kpi['up'] ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }} px-2 py-0.5 text-xs font-semibold">
                                @if ($kpi['up'])
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                                @else
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                @endif
                                {{ $kpi['change'] }}
                            </span>
                        </div>
                        <p class="mt-3 text-2xl font-extrabold tracking-tight text-gray-900">{{ $kpi['value'] }}</p>
                        <p class="mt-1 text-sm text-gray-500">{{ $kpi['label'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- ============ TWO-COLUMN: ACTIVITIES + QUICK STATS ============ --}}
            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- Recent Activities (2/3) --}}
                <div class="lg:col-span-2 rounded-2xl border border-gray-100 bg-white p-6 shadow-xs">
                    <div class="flex items-center justify-between">
                        <h2 class="text-base font-bold text-gray-900">Recent Activities</h2>
                        <a href="#" class="text-sm font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors duration-150">View all</a>
                    </div>

                    <div class="mt-5 space-y-0">
                        @foreach ($activities as $i => $activity)
                            <div class="relative flex gap-4 {{ $i < count($activities) - 1 ? 'pb-6' : '' }}">
                                {{-- Timeline line --}}
                                @if ($i < count($activities) - 1)
                                    <div class="absolute left-[17px] top-10 bottom-0 w-px bg-gray-100"></div>
                                @endif

                                {{-- Icon dot --}}
                                <span class="relative z-10 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg {{ $activity['color'] }} text-white shadow-lg shadow-{{ explode('-', $activity['color'])[1] }}-500/20">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $activity['icon'] !!}</svg>
                                </span>

                                {{-- Content --}}
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-semibold text-gray-900">{{ $activity['title'] }}</p>
                                    <p class="text-sm text-gray-500">{{ $activity['desc'] }}</p>
                                    <p class="mt-1 text-xs text-gray-400">{{ $activity['time'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Quick Stats (1/3) --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-xs">
                    <h2 class="text-base font-bold text-gray-900">Quick Stats</h2>
                    <p class="mt-1 text-sm text-gray-500">Today's summary at a glance</p>

                    <div class="mt-5 space-y-4">
                        @foreach ($quickStats as $stat)
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-sm text-gray-500">{{ $stat['label'] }}</p>
                                <p class="mt-1 text-xl font-extrabold {{ $stat['color'] }}">{{ $stat['value'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    {{-- Mini chart placeholder --}}
                    <div class="mt-5 rounded-xl border border-dashed border-gray-200 p-4 text-center">
                        <div class="flex items-center justify-center gap-1">
                            @foreach ([40, 65, 45, 80, 55, 70, 90] as $h)
                                <div class="w-4 rounded-sm bg-[#0047D4]/{{ $h > 60 ? '80' : '30' }}" style="height: {{ $h }}px"></div>
                            @endforeach
                        </div>
                        <p class="mt-3 text-xs font-medium text-gray-400">Revenue — Last 7 days</p>
                    </div>
                </div>
            </div>

            {{-- ============ UPCOMING BOOKINGS TABLE ============ --}}
            <div class="mt-6 rounded-2xl border border-gray-100 bg-white shadow-xs">
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <h2 class="text-base font-bold text-gray-900">Upcoming Bookings</h2>
                    <a href="#" class="inline-flex items-center gap-1.5 rounded-xl bg-[#0047D4] px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] transition-colors duration-150">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5v14"/></svg>
                        Add Booking
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-gray-100 text-xs font-bold uppercase tracking-wider text-gray-400">
                                <th class="px-6 py-3.5">Customer Name</th>
                                <th class="px-6 py-3.5">Sport</th>
                                <th class="px-6 py-3.5">Date</th>
                                <th class="px-6 py-3.5">Time</th>
                                <th class="px-6 py-3.5">Payment Status</th>
                                <th class="px-6 py-3.5">Booking Status</th>
                                <th class="px-6 py-3.5">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($bookings as $booking)
                                <tr class="transition-colors duration-100 hover:bg-gray-50/50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gray-100 text-xs font-bold text-gray-600">{{ collect(explode(' ', $booking['name']))->map(fn($w) => mb_substr($w, 0, 1))->join('') }}</span>
                                            <span class="font-semibold text-gray-900">{{ $booking['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $booking['sport'] }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $booking['date'] }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $booking['time'] }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $booking['payColor'] }}">{{ $booking['payment'] }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $booking['statColor'] }}">{{ $booking['status'] }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-semibold text-gray-700 transition-colors duration-150 hover:border-[#0047D4] hover:text-[#0047D4]">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Table footer --}}
                <div class="flex items-center justify-between border-t border-gray-100 px-6 py-3.5">
                    <p class="text-sm text-gray-500">Showing <span class="font-semibold text-gray-700">{{ count($bookings) }}</span> upcoming bookings</p>
                    <a href="#" class="text-sm font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors duration-150">View all bookings →</a>
                </div>
            </div>

@endsection
