@extends('layouts.staff')

@section('title', "Today's Schedule")
@section('page-title', "Today's Schedule")
@section('page-subtitle', 'All bookings for today')

@push('styles')
<style>
.maintenance-stripes {
            background: repeating-linear-gradient(
                -45deg,
                #f3f4f6,
                #f3f4f6 4px,
                #e5e7eb 4px,
                #e5e7eb 8px
            );
        }
</style>
@endpush

@section('content')

    @php
$currentDate = 'Tuesday, 10 June 2026';
        $currentDateShort = '10 Jun 2026';

        $courts = ['Futsal', 'Badminton', 'Tennis', 'Basketball', 'Volleyball'];

        $timeSlots = [];
        for ($h = 8; $h <= 21; $h++) {
            $timeSlots[] = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00';
        }

        $bookings = [
            '08:00' => [
                'Futsal' => ['status' => 'booked', 'customer' => 'Ahmad', 'payment' => 'Fully Paid'],
            ],
            '09:00' => [
                'Futsal'    => ['status' => 'booked', 'customer' => 'Budi', 'payment' => 'DP Paid'],
                'Badminton' => ['status' => 'booked', 'customer' => 'Sarah', 'payment' => 'Fully Paid'],
            ],
            '10:00' => [
                'Futsal'     => ['status' => 'active', 'customer' => 'Riko', 'payment' => 'Fully Paid'],
                'Basketball' => ['status' => 'booked', 'customer' => 'Dimas', 'payment' => 'Fully Paid'],
            ],
            '11:00' => [
                'Badminton'  => ['status' => 'booked', 'customer' => 'Rina', 'payment' => 'DP Paid'],
                'Volleyball' => ['status' => 'booked', 'customer' => 'Fajar', 'payment' => 'Fully Paid'],
            ],
            '12:00' => [
                'Futsal'    => ['status' => 'completed', 'customer' => 'Riko', 'payment' => 'Fully Paid'],
                'Badminton' => ['status' => 'completed', 'customer' => 'Rina', 'payment' => 'DP Paid'],
            ],
            '13:00' => [
                'Futsal'     => ['status' => 'booked', 'customer' => 'Hendra', 'payment' => 'Pending'],
                'Basketball' => ['status' => 'booked', 'customer' => 'Tommy', 'payment' => 'Fully Paid'],
            ],
            '14:00' => [
                'Badminton'  => ['status' => 'booked', 'customer' => 'Lisa', 'payment' => 'Fully Paid'],
                'Volleyball' => ['status' => 'booked', 'customer' => 'Andi', 'payment' => 'DP Paid'],
            ],
            '15:00' => [
                'Futsal' => ['status' => 'booked', 'customer' => 'Yoga', 'payment' => 'Fully Paid'],
            ],
        ];

        $stats = [
            'total'       => 70,
            'booked'      => 12,
            'available'   => 44,
            'maintenance' => 14,
        ];

        $activeFilter = 'all';
    @endphp


<div class="px-4 py-6 sm:px-6 sm:py-8 lg:px-8 max-w-[1400px] mx-auto">

                {{-- -------- Page Header -------- --}}
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Today's Schedule</h1>
                        <p class="mt-1 text-sm text-gray-500">Manage court bookings and availability for the day.</p>
                    </div>
                    {{-- Date Navigation --}}
                    <div class="flex items-center gap-2">
                        <button type="button" class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white p-2.5 text-gray-500 shadow-xs hover:border-blue-200 hover:text-[#0047D4] transition-colors duration-150" aria-label="Previous day">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"></path></svg>
                        </button>
                        <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 shadow-xs">
                            <svg class="h-4 w-4 text-[#0047D4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path></svg>
                            <span class="text-sm font-semibold text-gray-900">{{ $currentDate }}</span>
                        </div>
                        <button type="button" class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white p-2.5 text-gray-500 shadow-xs hover:border-blue-200 hover:text-[#0047D4] transition-colors duration-150" aria-label="Next day">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"></path></svg>
                        </button>
                    </div>
                </div>

                {{-- -------- Court Filter Tabs -------- --}}
                <div class="mt-6 flex items-center gap-2 overflow-x-auto pb-1 scrollbar-hide">
                    @php
                        $filters = [
                            ['key' => 'all',        'label' => 'All Courts'],
                            ['key' => 'futsal',     'label' => 'Futsal'],
                            ['key' => 'badminton',  'label' => 'Badminton'],
                            ['key' => 'tennis',     'label' => 'Tennis'],
                            ['key' => 'basketball', 'label' => 'Basketball'],
                            ['key' => 'volleyball', 'label' => 'Volleyball'],
                        ];
                    @endphp
                    @foreach ($filters as $filter)
                        <button type="button"
                                class="inline-flex items-center whitespace-nowrap rounded-xl px-4 py-2 text-sm font-semibold transition-all duration-150
                                       {{ $filter['key'] === $activeFilter
                                           ? 'bg-[#0047D4] text-white shadow-lg shadow-blue-500/10'
                                           : 'bg-white text-gray-600 border border-gray-200 shadow-xs hover:border-blue-200 hover:text-[#0047D4]' }}">
                            {{ $filter['label'] }}
                        </button>
                    @endforeach
                </div>

                {{-- -------- Schedule Grid -------- --}}
                <div class="mt-6 rounded-2xl border border-gray-100 bg-white shadow-xs overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[800px] border-collapse">
                            {{-- Table Header --}}
                            <thead>
                                <tr class="bg-gray-50/80">
                                    <th class="sticky left-0 z-10 bg-gray-50/80 border-b border-r border-gray-100 px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 w-[80px]">
                                        Time
                                    </th>
                                    @foreach ($courts as $court)
                                        <th class="border-b border-r border-gray-100 last:border-r-0 px-3 py-3 text-center text-xs font-bold uppercase tracking-wider text-gray-500">
                                            <div class="flex items-center justify-center gap-1.5">
                                                @if ($court === 'Futsal')
                                                    <span class="flex h-5 w-5 items-center justify-center rounded-md bg-emerald-50 text-emerald-600">
                                                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"></circle></svg>
                                                    </span>
                                                @elseif ($court === 'Badminton')
                                                    <span class="flex h-5 w-5 items-center justify-center rounded-md bg-purple-50 text-purple-600">
                                                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle></svg>
                                                    </span>
                                                @elseif ($court === 'Tennis')
                                                    <span class="flex h-5 w-5 items-center justify-center rounded-md bg-amber-50 text-amber-600">
                                                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"></circle></svg>
                                                    </span>
                                                @elseif ($court === 'Basketball')
                                                    <span class="flex h-5 w-5 items-center justify-center rounded-md bg-orange-50 text-orange-600">
                                                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"></circle></svg>
                                                    </span>
                                                @elseif ($court === 'Volleyball')
                                                    <span class="flex h-5 w-5 items-center justify-center rounded-md bg-sky-50 text-sky-600">
                                                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"></circle></svg>
                                                    </span>
                                                @endif
                                                {{ $court }}
                                            </div>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>

                            {{-- Table Body --}}
                            <tbody>
                                @foreach ($timeSlots as $index => $time)
                                    @php $nextHour = str_pad(intval(substr($time, 0, 2)) + 1, 2, '0', STR_PAD_LEFT) . ':00'; @endphp
                                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50/30' }} hover:bg-blue-50/30 transition-colors duration-100">
                                        {{-- Time Column --}}
                                        <td class="sticky left-0 z-10 {{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50/50' }} border-b border-r border-gray-100 px-4 py-1 text-center">
                                            <span class="text-sm font-bold text-gray-900">{{ $time }}</span>
                                            <span class="block text-[10px] text-gray-400">{{ $nextHour }}</span>
                                        </td>

                                        {{-- Court Columns --}}
                                        @foreach ($courts as $court)
                                            @php
                                                $booking = $bookings[$time][$court] ?? null;
                                                $isTennis = $court === 'Tennis';
                                            @endphp
                                            <td class="border-b border-r border-gray-100 last:border-r-0 px-2 py-1.5">
                                                @if ($isTennis)
                                                    {{-- Maintenance Cell --}}
                                                    <div class="maintenance-stripes flex items-center justify-center gap-1.5 rounded-xl px-3 py-3 min-h-[52px]">
                                                        <svg class="h-3.5 w-3.5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                                                        <span class="text-xs font-semibold text-gray-500">Maintenance</span>
                                                    </div>
                                                @elseif ($booking)
                                                    @if ($booking['status'] === 'booked')
                                                        {{-- Booked Cell --}}
                                                        <div class="flex flex-col items-start gap-1 rounded-xl bg-blue-50 border border-blue-100 px-3 py-2.5 min-h-[52px]">
                                                            <div class="flex items-center gap-1.5">
                                                                <span class="h-1.5 w-1.5 rounded-full bg-[#0047D4]"></span>
                                                                <span class="text-sm font-semibold text-[#0047D4]">{{ $booking['customer'] }}</span>
                                                            </div>
                                                            <span class="inline-flex items-center rounded-md px-1.5 py-0.5 text-[10px] font-semibold
                                                                {{ $booking['payment'] === 'Fully Paid'
                                                                    ? 'bg-blue-100 text-blue-700'
                                                                    : ($booking['payment'] === 'DP Paid'
                                                                        ? 'bg-amber-50 text-amber-700'
                                                                        : 'bg-rose-50 text-rose-600') }}">
                                                                {{ $booking['payment'] }}
                                                            </span>
                                                        </div>
                                                    @elseif ($booking['status'] === 'active')
                                                        {{-- Active / Checked-In Cell --}}
                                                        <div class="flex flex-col items-start gap-1 rounded-xl bg-emerald-50 border border-emerald-200 px-3 py-2.5 min-h-[52px]">
                                                            <div class="flex items-center gap-1.5">
                                                                <span class="relative flex h-2 w-2">
                                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                                                    <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                                                </span>
                                                                <span class="text-sm font-semibold text-emerald-700">{{ $booking['customer'] }}</span>
                                                            </div>
                                                            <span class="inline-flex items-center rounded-md bg-emerald-100 px-1.5 py-0.5 text-[10px] font-semibold text-emerald-700">Checked In</span>
                                                        </div>
                                                    @elseif ($booking['status'] === 'completed')
                                                        {{-- Completed Cell --}}
                                                        <div class="flex flex-col items-start gap-1 rounded-xl bg-gray-50 border border-gray-200 px-3 py-2.5 min-h-[52px]">
                                                            <div class="flex items-center gap-1.5">
                                                                <svg class="h-3.5 w-3.5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                                <span class="text-sm font-medium text-gray-500">{{ $booking['customer'] }}</span>
                                                            </div>
                                                            <span class="inline-flex items-center rounded-md bg-gray-100 px-1.5 py-0.5 text-[10px] font-semibold text-gray-500">Completed</span>
                                                        </div>
                                                    @endif
                                                @else
                                                    {{-- Available Cell --}}
                                                    <div class="flex items-center justify-center rounded-xl border border-dashed border-gray-200 px-3 py-3 min-h-[52px] hover:border-blue-300 hover:bg-blue-50/50 transition-colors duration-150 cursor-pointer group">
                                                        <span class="text-xs text-gray-400 group-hover:text-[#0047D4] transition-colors duration-150">Available</span>
                                                    </div>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- -------- Legend -------- --}}
                <div class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-3 rounded-2xl border border-gray-100 bg-white px-5 py-4 shadow-xs">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Legend</span>
                    <div class="flex items-center gap-2">
                        <span class="h-3 w-6 rounded border border-dashed border-gray-300 bg-white"></span>
                        <span class="text-xs text-gray-600">Available</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="h-3 w-6 rounded bg-blue-100 border border-blue-200"></span>
                        <span class="text-xs text-gray-600">Booked</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="h-3 w-6 rounded bg-emerald-100 border border-emerald-300"></span>
                        <span class="text-xs text-gray-600">Active / Checked In</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="h-3 w-6 rounded bg-gray-100 border border-gray-300"></span>
                        <span class="text-xs text-gray-600">Completed</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="h-3 w-6 rounded maintenance-stripes border border-gray-300"></span>
                        <span class="text-xs text-gray-600">Maintenance</span>
                    </div>
                </div>

                {{-- -------- Summary Stats -------- --}}
                <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-4">
                    {{-- Total Slots --}}
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-600">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path></svg>
                            </span>
                            <div>
                                <p class="text-2xl font-extrabold text-gray-900">{{ $stats['total'] }}</p>
                                <p class="text-xs font-medium text-gray-500">Total Slots Today</p>
                            </div>
                        </div>
                    </div>
                    {{-- Booked --}}
                    <div class="rounded-2xl border border-blue-100 bg-gradient-to-br from-blue-50 to-white p-5 shadow-xs">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-[#0047D4]">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </span>
                            <div>
                                <p class="text-2xl font-extrabold text-[#0047D4]">{{ $stats['booked'] }}</p>
                                <p class="text-xs font-medium text-gray-500">Booked</p>
                            </div>
                        </div>
                    </div>
                    {{-- Available --}}
                    <div class="rounded-2xl border border-emerald-100 bg-gradient-to-br from-emerald-50 to-white p-5 shadow-xs">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            </span>
                            <div>
                                <p class="text-2xl font-extrabold text-emerald-600">{{ $stats['available'] }}</p>
                                <p class="text-xs font-medium text-gray-500">Available</p>
                            </div>
                        </div>
                    </div>
                    {{-- Maintenance --}}
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                            </span>
                            <div>
                                <p class="text-2xl font-extrabold text-amber-600">{{ $stats['maintenance'] }}</p>
                                <p class="text-xs font-medium text-gray-500">Maintenance</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

@endsection

@push('scripts')
<script>
    // Sidebar toggle is handled by the shared layout
</script>
@endpush
