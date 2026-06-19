@extends('layouts.staff')

@section('title', 'Check-In')
@section('page-title', 'Check-In Verification')
@section('page-subtitle', 'Verify and confirm customer arrivals')

@section('content')




{{-- Search section --}}
            <div class="mx-auto max-w-2xl">
                <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-lg shadow-blue-500/10 sm:p-8">
                    <div class="text-center mb-5">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50">
                            <svg class="h-6 w-6 text-[#0047D4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900">Quick Check-In</h2>
                        <p class="mt-1 text-sm text-gray-500">Search by booking code or customer name to check in</p>
                    </div>
                    <form class="flex flex-col gap-3 sm:flex-row">
                        <div class="relative flex-1">
                            <svg class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            <input type="text" placeholder="Enter booking code or customer name..." class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3.5 pl-12 pr-4 text-sm font-medium text-gray-900 placeholder-gray-400 outline-none transition-all duration-150 focus:border-[#0047D4] focus:bg-white focus:ring-2 focus:ring-blue-100">
                        </div>
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0047D4] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 transition-colors duration-150 hover:bg-[#003cb5]">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            Search
                        </button>
                    </form>
                </div>
            </div>

            {{-- Pending Check-In section --}}
            <div class="mt-8">
                <div class="mb-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-bold text-gray-900">Pending Check-In</h2>
                        <span class="inline-flex items-center justify-center rounded-full bg-[#0047D4] px-2.5 py-0.5 text-xs font-bold text-white">{{ count($pendingCheckins) }}</span>
                    </div>
                    <p class="text-sm text-gray-500">Today, {{ date('d M Y') }}</p>
                </div>

                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 xl:grid-cols-3">
                    @foreach ($pendingCheckins as $index => $booking)
                        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                            {{-- Warning banner --}}
                            @if ($booking['warning'])
                                <div class="mb-4 flex items-start gap-2 rounded-xl bg-rose-50 px-3 py-2.5">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    <p class="text-xs font-medium text-rose-700">{{ $booking['warning'] }}</p>
                                </div>
                            @endif

                            {{-- Header --}}
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-xs font-semibold text-[#0047D4]">{{ $booking['code'] }}</p>
                                    <p class="mt-1 text-base font-bold text-gray-900">{{ $booking['customer'] }}</p>
                                </div>
                                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $booking['payColor'] }}">{{ $booking['payment'] }}</span>
                            </div>

                            {{-- Details --}}
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6M9 9l6 6"/></svg>
                                    <span>{{ $booking['sport'] }} — {{ $booking['court'] }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    <span>{{ $booking['date'] }}, {{ $booking['time'] }}</span>
                                </div>
                            </div>

                            {{-- Action --}}
                            <div class="mt-5">
                                <form action="{{ route('staff.checkin.process', $booking['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/10 transition-colors duration-150 hover:bg-emerald-600">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                        Check In
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Already Checked In section (collapsible) --}}
            <div class="mt-8">
                <button type="button" onclick="toggleCheckedIn()" class="mb-4 flex items-center gap-3 group">
                    <h2 class="text-lg font-bold text-gray-900 group-hover:text-[#0047D4] transition-colors duration-150">Already Checked In</h2>
                    <span class="inline-flex items-center justify-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-bold text-emerald-700">{{ count($checkedIn) }}</span>
                    <svg id="checkedin-chevron" class="h-5 w-5 text-gray-400 transition-transform duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>

                <div id="checkedin-content" class="hidden">
                    <div class="rounded-2xl border border-gray-100 bg-white shadow-xs">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead>
                                    <tr class="border-b border-gray-100 text-xs font-bold uppercase tracking-wider text-gray-400">
                                        <th class="px-6 py-3.5">Booking Code</th>
                                        <th class="px-6 py-3.5">Customer</th>
                                        <th class="px-6 py-3.5">Court</th>
                                        <th class="px-6 py-3.5">Time</th>
                                        <th class="px-6 py-3.5">Checked In At</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach ($checkedIn as $entry)
                                        <tr class="transition-colors duration-100 hover:bg-gray-50/50">
                                            <td class="px-6 py-4">
                                                <span class="text-sm font-semibold text-[#0047D4]">{{ $entry['code'] }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-xs font-bold text-emerald-700">{{ collect(explode(' ', $entry['customer']))->map(fn($w) => mb_substr($w, 0, 1))->join('') }}</span>
                                                    <span class="font-semibold text-gray-900">{{ $entry['customer'] }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-gray-600">{{ $entry['sport'] }} — {{ $entry['court'] }}</td>
                                            <td class="px-6 py-4 text-gray-600">{{ $entry['time'] }}</td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                                    {{ $entry['checkedAt'] }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

@endsection
