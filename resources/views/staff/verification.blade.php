@extends('layouts.staff')

@section('title', 'Verification')
@section('page-title', 'Verification')
@section('page-subtitle', 'Verify and manage customer bookings')

@section('content')

{{-- Search section --}}
<div class="mx-auto max-w-2xl">
    <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-lg shadow-blue-500/10 sm:p-8">
        <div class="text-center mb-5">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50">
                <svg class="h-6 w-6 text-[#0047D4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
            <h2 class="text-lg font-bold text-gray-900">Quick Verification</h2>
            <p class="mt-1 text-sm text-gray-500">Search by booking code or customer name</p>
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

{{-- Booked section --}}
<div class="mt-8">
    <div class="mb-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-bold text-gray-900">Booked (Pending Verification)</h2>
            <span class="inline-flex items-center justify-center rounded-full bg-[#0047D4] px-2.5 py-0.5 text-xs font-bold text-white">{{ count($bookedList) }}</span>
        </div>
        <p class="text-sm text-gray-500">Today, {{ date('d M Y') }}</p>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 xl:grid-cols-3">
        @foreach ($bookedList as $index => $booking)
            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                @if ($booking['warning'])
                    <div class="mb-4 flex items-start gap-2 rounded-xl bg-rose-50 px-3 py-2.5">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <p class="text-xs font-medium text-rose-700">{{ $booking['warning'] }}</p>
                    </div>
                @endif

                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold text-[#0047D4]">{{ $booking['code'] }}</p>
                        <p class="mt-1 text-base font-bold text-gray-900">{{ $booking['customer'] }}</p>
                    </div>
                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $booking['payColor'] }}">{{ $booking['payment'] }}</span>
                </div>

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

                <div class="mt-5">
                    <form action="{{ route('staff.verification.process', $booking['id']) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/10 transition-colors duration-150 hover:bg-emerald-600">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Verify to Active
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Active section --}}
<div class="mt-8">
    <div class="mb-4 flex items-center gap-3">
        <h2 class="text-lg font-bold text-gray-900">Active (Playing)</h2>
        <span class="inline-flex items-center justify-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-bold text-emerald-700">{{ count($activeList) }}</span>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 xl:grid-cols-3">
        @foreach ($activeList as $index => $booking)
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50/50 p-5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold text-[#0047D4]">{{ $booking['code'] }}</p>
                        <p class="mt-1 text-base font-bold text-gray-900">{{ $booking['customer'] }}</p>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Active</span>
                </div>

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

                <div class="mt-5">
                    <form action="{{ route('staff.verification.process', $booking['id']) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="flex w-full items-center justify-center gap-2 rounded-xl bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-gray-900/10 transition-colors duration-150 hover:bg-black">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Mark as Completed
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Completed section --}}
<div class="mt-8">
    <div class="mb-4 flex items-center gap-3">
        <h2 class="text-lg font-bold text-gray-900">Completed</h2>
        <span class="inline-flex items-center justify-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-bold text-gray-600">{{ count($completedList) }}</span>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 xl:grid-cols-3">
        @foreach ($completedList as $index => $booking)
            <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 shadow-xs opacity-75">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-500">{{ $booking['code'] }}</p>
                        <p class="mt-1 text-base font-bold text-gray-500 line-through">{{ $booking['customer'] }}</p>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-gray-200 px-2.5 py-1 text-xs font-semibold text-gray-600">Completed</span>
                </div>

                <div class="mt-4 space-y-2">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6M9 9l6 6"/></svg>
                        <span>{{ $booking['sport'] }} — {{ $booking['court'] }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <span>{{ $booking['date'] }}, {{ $booking['time'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
