@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    @php
        // Data provided by AdminController: $kpis, $activities, $quickStats, $bookings
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
                    <a href="{{ route('booking') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-[#0047D4] px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] transition-colors duration-150">
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
                    <a href="{{ route('admin.bookings') }}" class="text-sm font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors duration-150">View all bookings →</a>
                </div>
            </div>

@endsection
