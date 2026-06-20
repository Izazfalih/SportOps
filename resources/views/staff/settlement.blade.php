@extends('layouts.staff')

@section('title', 'Settlement')
@section('page-title', 'Payment Settlement')
@section('page-subtitle', 'Complete remaining payment balances')

@section('content')
    @if(session('success'))
        <div class="mb-6 rounded-xl border border-emerald-100 bg-emerald-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 rounded-xl border border-rose-100 bg-rose-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-rose-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-rose-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif    {{-- Data handled by StaffController --}}
{{-- Summary cards --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                {{-- Pending Settlements --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </span>
                    </div>
                    <p class="mt-3 text-2xl font-extrabold tracking-tight text-gray-900">{{ count($pendingSettlements) }}</p>
                    <p class="mt-1 text-sm text-gray-500">Pending Settlements</p>
                </div>

                {{-- Total Outstanding --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        </span>
                    </div>
                    <p class="mt-3 text-2xl font-extrabold tracking-tight text-gray-900">Rp {{ number_format($totalOutstanding, 0, ',', '.') }}</p>
                    <p class="mt-1 text-sm text-gray-500">Total Outstanding</p>
                </div>

                {{-- Settled Today --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </span>
                    </div>
                    <p class="mt-3 text-2xl font-extrabold tracking-tight text-emerald-600">Rp {{ number_format($settledTodayAmount, 0, ',', '.') }}</p>
                    <p class="mt-1 text-sm text-gray-500">Settled Today</p>
                </div>
            </div>

            {{-- Search bar --}}
            <div class="mt-6">
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </span>
                    <input type="text" id="search-input" placeholder="Search by booking code or customer name..." class="w-full rounded-2xl border border-gray-200 bg-white py-3.5 pl-12 pr-4 text-sm text-gray-900 shadow-xs placeholder:text-gray-400 focus:border-[#0047D4] focus:outline-none focus:ring-2 focus:ring-[#0047D4]/10 transition-all duration-150">
                </div>
            </div>

            {{-- Pending Settlements --}}
            <div class="mt-6 rounded-2xl border border-gray-100 bg-white shadow-xs">
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <h2 class="text-base font-bold text-gray-900">Pending Settlements</h2>
                        <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">{{ count($pendingSettlements) }} pending</span>
                    </div>
                </div>

                {{-- Desktop table --}}
                <div class="hidden overflow-x-auto lg:block">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-gray-100 text-xs font-bold uppercase tracking-wider text-gray-400">
                                <th class="px-6 py-3.5">Booking Code</th>
                                <th class="px-6 py-3.5">Customer</th>
                                <th class="px-6 py-3.5">Court (Sport)</th>
                                <th class="px-6 py-3.5">Date & Time</th>
                                <th class="px-6 py-3.5">Total Price</th>
                                <th class="px-6 py-3.5">DP Paid</th>
                                <th class="px-6 py-3.5">Remaining</th>
                                <th class="px-6 py-3.5">Status</th>
                                <th class="px-6 py-3.5">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50" id="settlements-table-body">
                            @foreach ($pendingSettlements as $index => $s)
                                <tr class="settlement-row transition-colors duration-100 hover:bg-gray-50/50" data-search="{{ strtolower($s['code'] . ' ' . $s['customer']) }}">
                                    <td class="px-6 py-4">
                                        <span class="font-mono text-xs font-semibold text-[#0047D4]">{{ $s['code'] }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gray-100 text-xs font-bold text-gray-600">{{ collect(explode(' ', $s['customer']))->map(fn($w) => mb_substr($w, 0, 1))->join('') }}</span>
                                            <span class="font-semibold text-gray-900">{{ $s['customer'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $s['court'] }} ({{ $s['sport'] }})</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $s['date'] }}<br><span class="text-xs text-gray-400">{{ $s['time'] }}</span></td>
                                    <td class="px-6 py-4 text-gray-600">Rp {{ number_format($s['total'], 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-gray-600">Rp {{ number_format($s['dp'], 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="text-base font-extrabold text-rose-600">Rp {{ number_format($s['remaining'], 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">DP Paid</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="button" onclick="openSettleModal({{ $s['id'] }}, {{ $s['remaining'] }})" class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-lg shadow-emerald-500/10 transition-colors duration-150 hover:bg-emerald-700">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                            Settle Payment
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile cards --}}
                <div class="divide-y divide-gray-50 lg:hidden" id="settlements-cards">
                    @foreach ($pendingSettlements as $index => $s)
                        <div class="settlement-row p-4" data-search="{{ strtolower($s['code'] . ' ' . $s['customer']) }}">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span class="font-mono text-xs font-semibold text-[#0047D4]">{{ $s['code'] }}</span>
                                    <div class="mt-1 flex items-center gap-2">
                                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-gray-100 text-[10px] font-bold text-gray-600">{{ collect(explode(' ', $s['customer']))->map(fn($w) => mb_substr($w, 0, 1))->join('') }}</span>
                                        <span class="font-semibold text-gray-900">{{ $s['customer'] }}</span>
                                    </div>
                                </div>
                                <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">DP Paid</span>
                            </div>

                            <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                                <div>
                                    <p class="text-xs text-gray-400">Court (Sport)</p>
                                    <p class="font-medium text-gray-700">{{ $s['court'] }} ({{ $s['sport'] }})</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Date & Time</p>
                                    <p class="font-medium text-gray-700">{{ $s['date'] }}, {{ $s['time'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Total</p>
                                    <p class="font-medium text-gray-700">Rp {{ number_format($s['total'], 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">DP Paid</p>
                                    <p class="font-medium text-gray-700">Rp {{ number_format($s['dp'], 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="mt-3 flex items-center justify-between rounded-xl bg-rose-50 px-4 py-3">
                                <div>
                                    <p class="text-xs font-medium text-rose-500">Remaining Balance</p>
                                    <p class="text-lg font-extrabold text-rose-600">Rp {{ number_format($s['remaining'], 0, ',', '.') }}</p>
                                </div>
                                <button type="button" onclick="openSettleModal({{ $s['id'] }}, {{ $s['remaining'] }})" class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/10 transition-colors duration-150 hover:bg-emerald-700">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                    Settle
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Table footer --}}
                <div class="flex items-center justify-between border-t border-gray-100 px-6 py-3.5">
                    <p class="text-sm text-gray-500">Showing <span class="font-semibold text-gray-700" id="visible-count">{{ count($pendingSettlements) }}</span> pending settlements</p>
                    <p class="text-sm font-semibold text-rose-600">Total: Rp {{ number_format($totalOutstanding, 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- Recently Settled (collapsible) --}}
            <div class="mt-6 rounded-2xl border border-gray-100 bg-white shadow-xs">
                <button type="button" onclick="toggleRecent()" class="flex w-full items-center justify-between px-6 py-4 text-left">
                    <div class="flex items-center gap-3">
                        <h2 class="text-base font-bold text-gray-900">Recently Settled</h2>
                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">{{ count($recentlySettled) }} today</span>
                    </div>
                    <svg id="recent-chevron" class="h-5 w-5 text-gray-400 transition-transform duration-200 {{ count($recentlySettled) > 0 ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>

                <div id="recent-body" class="border-t border-gray-100 {{ count($recentlySettled) > 0 ? '' : 'hidden' }}">
                    <div class="divide-y divide-gray-50">
                        @foreach ($recentlySettled as $settled)
                            <div class="flex items-center gap-4 px-6 py-4">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                </span>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono text-xs font-semibold text-gray-500">{{ $settled['code'] }}</span>
                                        <span class="text-xs text-gray-300">•</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ $settled['customer'] }}</span>
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $settled['sport'] }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-emerald-600">Rp {{ number_format($settled['amount'], 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-400">Settled at {{ $settled['time'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Settlement Modal --}}
            <div id="settle-modal" class="fixed inset-0 z-50 hidden">
                <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" onclick="closeSettleModal()"></div>
                <div class="flex min-h-screen items-center justify-center p-4">
                    <div class="relative w-full max-w-md scale-95 transform rounded-2xl bg-white p-6 opacity-0 shadow-2xl transition-all duration-200" id="settle-modal-content">
                        <div class="mb-5 flex items-center justify-between">
                            <h3 class="text-xl font-extrabold text-gray-900">Settle Payment</h3>
                            <button type="button" onclick="closeSettleModal()" class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <form id="settle-form" method="POST" action="">
                            @csrf
                            <div class="mb-5 rounded-xl bg-gray-50 p-4">
                                <p class="text-sm font-medium text-gray-500">Amount to Settle</p>
                                <p class="mt-1 text-2xl font-extrabold text-[#0047D4]" id="modal-amount">Rp 0</p>
                            </div>

                            <div class="mb-6">
                                <label class="mb-3 block text-sm font-bold text-gray-700">Payment Method <span class="text-rose-500">*</span></label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="group relative flex cursor-pointer items-center justify-center rounded-xl border-2 border-gray-100 bg-white p-4 transition-all duration-200 hover:border-blue-100 has-[:checked]:border-[#0047D4] has-[:checked]:bg-blue-50/50">
                                        <input type="radio" name="metode" value="cash" class="peer sr-only" checked>
                                        <div class="flex flex-col items-center gap-2">
                                            <svg class="h-6 w-6 text-gray-400 transition-colors duration-200 group-has-[:checked]:text-[#0047D4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                                            <span class="text-sm font-bold text-gray-600 group-has-[:checked]:text-[#0047D4]">Cash</span>
                                        </div>
                                    </label>
                                    <label class="group relative flex cursor-pointer items-center justify-center rounded-xl border-2 border-gray-100 bg-white p-4 transition-all duration-200 hover:border-blue-100 has-[:checked]:border-[#0047D4] has-[:checked]:bg-blue-50/50">
                                        <input type="radio" name="metode" value="transfer" class="peer sr-only">
                                        <div class="flex flex-col items-center gap-2">
                                            <svg class="h-6 w-6 text-gray-400 transition-colors duration-200 group-has-[:checked]:text-[#0047D4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/></svg>
                                            <span class="text-sm font-bold text-gray-600 group-has-[:checked]:text-[#0047D4]">Transfer</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="w-full rounded-xl bg-[#0047D4] px-4 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-500/30 transition-all duration-200 hover:bg-blue-800 hover:shadow-blue-500/40">
                                Confirm Settlement
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @push('scripts')
            <script>
                // Modal handlers
                const settleModal = document.getElementById('settle-modal');
                const modalContent = document.getElementById('settle-modal-content');
                const settleForm = document.getElementById('settle-form');
                const modalAmount = document.getElementById('modal-amount');

                function openSettleModal(bookingId, remainingAmount) {
                    // Update the form action URL
                    settleForm.action = `/staff/settlement/${bookingId}`;
                    
                    // Format and display the amount
                    const formattedAmount = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(remainingAmount);
                    modalAmount.textContent = formattedAmount;

                    settleModal.classList.remove('hidden');
                    // Small delay to allow display:block to apply before animating opacity
                    setTimeout(() => {
                        modalContent.classList.remove('opacity-0', 'scale-95');
                        modalContent.classList.add('opacity-100', 'scale-100');
                    }, 10);
                }

                function closeSettleModal() {
                    modalContent.classList.remove('opacity-100', 'scale-100');
                    modalContent.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        settleModal.classList.add('hidden');
                    }, 200);
                }

                // Close on escape key
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && !settleModal.classList.contains('hidden')) {
                        closeSettleModal();
                    }
                });

                function toggleRecent() {
                    const body = document.getElementById('recent-body');
                    const chevron = document.getElementById('recent-chevron');
                    if (body.classList.contains('hidden')) {
                        body.classList.remove('hidden');
                        chevron.classList.add('rotate-180');
                    } else {
                        body.classList.add('hidden');
                        chevron.classList.remove('rotate-180');
                    }
                }
            </script>
            @endpush

@endsection
