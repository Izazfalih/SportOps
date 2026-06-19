@extends('layouts.admin')

@section('title', 'Bookings Management')
@section('page-title', 'Bookings')
@section('page-subtitle', 'View and manage all booking records')

@section('content')

    @php
        $statuses = ['All', 'Pending Payment', 'Confirmed', 'Completed', 'Cancelled', 'Active'];
        $sports = ['All', 'Futsal', 'Badminton', 'Tennis', 'Basketball', 'Volleyball'];

        $cardColors = [
            'blue'   => ['bg' => 'bg-blue-50',   'text' => 'text-[#0047D4]',    'icon' => 'text-[#0047D4]'],
            'amber'  => ['bg' => 'bg-amber-50',   'text' => 'text-amber-700',    'icon' => 'text-amber-600'],
            'green'  => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700',  'icon' => 'text-emerald-600'],
            'indigo' => ['bg' => 'bg-indigo-50',  'text' => 'text-indigo-700',   'icon' => 'text-indigo-600'],
        ];

        $paymentBadge = [
            'Fully Paid' => 'bg-emerald-50 text-emerald-700',
            'DP Paid'    => 'bg-amber-50 text-amber-700',
            'Pending'    => 'bg-gray-100 text-gray-500',
        ];

        $statusBadge = [
            'Pending Payment' => 'bg-gray-100 text-gray-600',
            'DP Paid'         => 'bg-amber-50 text-amber-700',
            'Confirmed'       => 'bg-emerald-50 text-emerald-700',
            'Fully Paid'      => 'bg-emerald-50 text-emerald-700',
            'Checked In'      => 'bg-purple-50 text-purple-700',
            'Completed'       => 'bg-blue-50 text-[#0047D4]',
            'Cancelled'       => 'bg-rose-50 text-rose-600',
        ];
    @endphp


{{-- -------- Page Header -------- --}}
                <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Bookings Management</h1>
                        <p class="mt-1 text-sm text-gray-500">View, filter, and manage all court bookings.</p>
                    </div>
                </div>

                {{-- -------- Filter Bar -------- --}}
                <form action="{{ route('admin.bookings') }}" method="GET" class="mt-6 rounded-2xl border border-gray-100 bg-white p-4 shadow-xs sm:p-5">
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">
                        {{-- Date From --}}
                        <div>
                            <label class="mb-1 block text-xs font-semibold text-gray-500">From</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs outline-none focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/10 transition">
                        </div>
                        {{-- Date To --}}
                        <div>
                            <label class="mb-1 block text-xs font-semibold text-gray-500">To</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs outline-none focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/10 transition">
                        </div>
                        {{-- Status --}}
                        <div>
                            <label class="mb-1 block text-xs font-semibold text-gray-500">Status</label>
                            <select name="status" class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs outline-none focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/10 transition">
                                @foreach ($statuses as $s)
                                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Sport --}}
                        <div>
                            <label class="mb-1 block text-xs font-semibold text-gray-500">Sport</label>
                            <select name="sport" class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs outline-none focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/10 transition">
                                @foreach ($sports as $sp)
                                    <option value="{{ $sp }}" {{ request('sport') == $sp ? 'selected' : '' }}>{{ $sp }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Search --}}
                        <div class="xl:col-span-1 sm:col-span-2 lg:col-span-1">
                            <label class="mb-1 block text-xs font-semibold text-gray-500">Search</label>
                            <div class="relative">
                                <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or code..." class="w-full rounded-xl border border-gray-200 bg-white py-2.5 pl-9 pr-3 text-sm text-gray-700 shadow-xs outline-none focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/10 transition">
                            </div>
                        </div>
                        {{-- Apply --}}
                        <div class="flex items-end sm:col-span-2 lg:col-span-5 xl:col-span-1 gap-2">
                            <button type="submit" class="w-full rounded-xl bg-[#0047D4] px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                                Apply Filters
                            </button>
                            <a href="{{ route('admin.bookings') }}" class="w-12 h-10 flex-shrink-0 flex items-center justify-center rounded-xl bg-gray-100 text-gray-500 hover:bg-gray-200 transition-colors" title="Reset Filters">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            </a>
                        </div>
                    </div>
                </form>

                {{-- -------- Summary Cards -------- --}}
                <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4">
                    @foreach ($summaryCards as $card)
                        @php $c = $cardColors[$card['color']]; @endphp
                        <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs sm:p-5">
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $c['bg'] }}">
                                    <svg class="h-5 w-5 {{ $c['icon'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $card['icon'] !!}</svg>
                                </span>
                                <div class="min-w-0">
                                    <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl">{{ number_format($card['value']) }}</p>
                                    <p class="truncate text-xs font-medium text-gray-500">{{ $card['label'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- -------- Bookings Table (Desktop) -------- --}}
                <div class="mt-5 hidden overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xs lg:block">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[960px] border-collapse text-sm">
                            <thead>
                                <tr class="border-b border-gray-100 bg-gray-50/70 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    <th class="px-5 py-3.5">Booking Code</th>
                                    <th class="px-5 py-3.5">Customer Name</th>
                                    <th class="px-5 py-3.5">Sport</th>
                                    <th class="px-5 py-3.5">Date</th>
                                    <th class="px-5 py-3.5">Time</th>
                                    <th class="px-5 py-3.5">Total Price</th>
                                    <th class="px-5 py-3.5">Payment</th>
                                    <th class="px-5 py-3.5">Status</th>
                                    <th class="px-5 py-3.5 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookingsData as $i => $b)
                                    @php
                                        $paymentStatus = $b->payments->first() ? ucfirst($b->payments->first()->status) : 'Unpaid';
                                        $statusClass = $statusBadge[ucfirst($b->status)] ?? 'bg-gray-100 text-gray-600';
                                        $paymentClass = $paymentBadge[$paymentStatus] ?? 'bg-gray-100 text-gray-500';
                                        $code = 'BK-2026' . str_pad($b->id, 4, '0', STR_PAD_LEFT);
                                    @endphp
                                    <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50/60 transition-colors duration-150">
                                        <td class="px-5 py-4 font-mono text-xs font-semibold text-gray-500">{{ $code }}</td>
                                        <td class="px-5 py-4 font-semibold text-gray-900">{{ $b->user->name ?? 'Unknown' }}</td>
                                        <td class="px-5 py-4 text-gray-600">{{ $b->field->jenis_olahraga ?? 'N/A' }}</td>
                                        <td class="px-5 py-4 text-gray-500">{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }}</td>
                                        <td class="px-5 py-4 text-gray-500">{{ \Carbon\Carbon::parse($b->jam_mulai)->format('H:i') }}-{{ \Carbon\Carbon::parse($b->jam_selesai)->format('H:i') }}</td>
                                        <td class="px-5 py-4 font-semibold text-gray-700">Rp {{ number_format($b->total_harga, 0, ',', '.') }}</td>
                                        <td class="px-5 py-4"><span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $paymentClass }}">{{ $paymentStatus }}</span></td>
                                        <td class="px-5 py-4"><span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusClass }}">{{ ucfirst($b->status) }}</span></td>
                                        <td class="px-5 py-4 text-right">
                                            <button type="button" onclick="openModal({{ $i }})" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- -------- Bookings Cards (Mobile / Tablet) -------- --}}
                <div class="mt-5 space-y-3 lg:hidden">
                    @foreach ($bookingsData as $i => $b)
                        @php
                            $paymentStatus = $b->payments->first() ? ucfirst($b->payments->first()->status) : 'Unpaid';
                            $statusClass = $statusBadge[ucfirst($b->status)] ?? 'bg-gray-100 text-gray-600';
                            $paymentClass = $paymentBadge[$paymentStatus] ?? 'bg-gray-100 text-gray-500';
                            $code = 'BK-2026' . str_pad($b->id, 4, '0', STR_PAD_LEFT);
                        @endphp
                        <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-semibold text-gray-400">{{ $code }}</span>
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusClass }}">{{ ucfirst($b->status) }}</span>
                            </div>
                            <p class="mt-2 text-base font-bold text-gray-900">{{ $b->user->name ?? 'Unknown' }}</p>
                            <p class="mt-0.5 text-sm text-gray-500">{{ $b->field->jenis_olahraga ?? 'N/A' }} · {{ $b->field->nama_lapangan ?? 'N/A' }}</p>
                            <div class="mt-2 flex items-center gap-3 text-xs text-gray-500">
                                <span>{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }}</span>
                                <span>·</span>
                                <span>{{ \Carbon\Carbon::parse($b->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($b->jam_selesai)->format('H:i') }}</span>
                            </div>
                            <div class="mt-3 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-bold text-gray-900">Rp {{ number_format($b->total_harga, 0, ',', '.') }}</span>
                                    <span class="inline-flex rounded-full px-2 py-0.5 text-[10px] font-semibold {{ $paymentClass }}">{{ $paymentStatus }}</span>
                                </div>
                                <button type="button" onclick="openModal({{ $i }})" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">
                                    View
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- -------- Pagination -------- --}}
                <div class="mt-5 flex flex-col items-center justify-between gap-3 sm:flex-row">
                    <p class="text-sm text-gray-500">Showing <span class="font-semibold text-gray-700">{{ $bookingsData->firstItem() ?? 0 }}–{{ $bookingsData->lastItem() ?? 0 }}</span> of <span class="font-semibold text-gray-700">{{ $bookingsData->total() }}</span> bookings</p>
                    <div class="flex items-center gap-1">
                        {{ $bookingsData->withQueryString()->links('pagination::tailwind') }}
                    </div>
                </div>


    {{-- ======================== BOOKING DETAIL MODAL ======================== --}}
    <div id="booking-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900/50 backdrop-blur-sm p-4" role="dialog" aria-modal="true">
        <div class="relative w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-3xl border border-gray-100 bg-white shadow-2xl">
            {{-- Modal header --}}
            <div class="sticky top-0 z-10 flex items-center justify-between border-b border-gray-100 bg-white px-6 py-4 rounded-t-3xl">
                <h2 class="text-lg font-extrabold text-gray-900">Booking Details</h2>
                <button type="button" onclick="closeModal()" class="inline-flex h-8 w-8 items-center justify-center rounded-xl text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Modal body --}}
            <div class="px-6 py-5 space-y-5">
                {{-- Booking code + status --}}
                <div class="flex items-center justify-between">
                    <span id="modal-code" class="font-mono text-sm font-bold text-gray-900"></span>
                    <span id="modal-status-badge" class="inline-flex rounded-full px-3 py-1 text-xs font-semibold"></span>
                </div>

                {{-- Customer info --}}
                <div class="rounded-2xl bg-gray-50 p-4 space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Customer Information</h3>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-xs text-gray-400">Name</p>
                            <p id="modal-customer" class="font-semibold text-gray-900"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Phone</p>
                            <p id="modal-phone" class="font-semibold text-gray-900"></p>
                        </div>
                    </div>
                </div>

                {{-- Booking details --}}
                <div class="rounded-2xl bg-gray-50 p-4 space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Booking Details</h3>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-xs text-gray-400">Sport</p>
                            <p id="modal-sport" class="font-semibold text-gray-900"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Court</p>
                            <p id="modal-court" class="font-semibold text-gray-900"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Date</p>
                            <p id="modal-date" class="font-semibold text-gray-900"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Time</p>
                            <p id="modal-time" class="font-semibold text-gray-900"></p>
                        </div>
                    </div>
                </div>

                {{-- Payment breakdown --}}
                <div class="rounded-2xl bg-gray-50 p-4 space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Payment</h3>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Payment Status</span>
                        <span id="modal-payment-badge" class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold"></span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Total Price</span>
                        <span id="modal-price" class="font-bold text-gray-900"></span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">DP Paid</span>
                        <span id="modal-dp" class="font-semibold text-gray-700"></span>
                    </div>
                    <div class="flex items-center justify-between text-sm border-t border-gray-200 pt-2">
                        <span class="font-semibold text-gray-700">Remaining</span>
                        <span id="modal-remaining" class="font-bold text-gray-900"></span>
                    </div>
                </div>

                {{-- Timeline --}}
                <div>
                    <h3 class="mb-3 text-xs font-bold uppercase tracking-wider text-gray-400">Activity Timeline</h3>
                    <div id="modal-timeline" class="space-y-0"></div>
                </div>
            </div>

            {{-- Modal footer --}}
            <div class="sticky bottom-0 flex items-center justify-end gap-3 border-t border-gray-100 bg-white px-6 py-4 rounded-b-3xl">
                <button type="button" onclick="closeModal()" class="rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                    Close
                </button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
// Booking data for modal
        const bookings = @json($bookingsData->items());

        const paymentBadgeClasses = {
            'Fully Paid': 'bg-emerald-50 text-emerald-700',
            'DP Paid': 'bg-amber-50 text-amber-700',
            'Pending': 'bg-gray-100 text-gray-500',
        };

        const statusBadgeClasses = {
            'Pending Payment': 'bg-gray-100 text-gray-600',
            'DP Paid': 'bg-amber-50 text-amber-700',
            'Confirmed': 'bg-emerald-50 text-emerald-700',
            'Fully Paid': 'bg-emerald-50 text-emerald-700',
            'Checked In': 'bg-purple-50 text-purple-700',
            'Completed': 'bg-blue-50 text-blue-700',
            'Cancelled': 'bg-rose-50 text-rose-600',
        };

        function openModal(index) {
            const b = bookings[index];
            if (!b) return;

            const modal = document.getElementById('booking-modal');
            const codeStr = 'BK-2026' + String(b.id).padStart(4, '0');
            
            document.getElementById('modal-code').textContent = codeStr;
            document.getElementById('modal-customer').textContent = b.user?.name || 'Unknown';
            document.getElementById('modal-phone').textContent = b.user?.phone || '-';
            document.getElementById('modal-sport').textContent = b.field?.jenis_olahraga || 'N/A';
            document.getElementById('modal-court').textContent = b.field?.nama_lapangan || 'N/A';
            document.getElementById('modal-date').textContent = new Date(b.tanggal).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
            document.getElementById('modal-time').textContent = b.jam_mulai.substring(0, 5) + ' - ' + b.jam_selesai.substring(0, 5);

            let paymentStatus = 'Unpaid';
            if (b.payments && b.payments.length > 0) {
                const pstat = b.payments[0].status;
                if (pstat === 'paid') paymentStatus = 'Fully Paid';
                else if (pstat === 'dp') paymentStatus = 'DP Paid';
                else paymentStatus = 'Pending';
            }
            
            // Map db status to label
            let statusLabel = 'Pending Payment';
            if (b.status === 'confirmed') statusLabel = 'Confirmed';
            else if (b.status === 'active') statusLabel = 'Checked In';
            else if (b.status === 'completed') statusLabel = 'Completed';
            else if (b.status === 'cancelled') statusLabel = 'Cancelled';
            else if (b.status === 'pending') statusLabel = 'Pending Payment';

            const pBadge = document.getElementById('modal-payment-badge');
            pBadge.className = 'inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold ' + (paymentBadgeClasses[paymentStatus] || 'bg-gray-100 text-gray-500');
            pBadge.textContent = paymentStatus;

            const sBadge = document.getElementById('modal-status-badge');
            sBadge.className = 'inline-flex rounded-full px-3 py-1 text-xs font-semibold ' + (statusBadgeClasses[statusLabel] || 'bg-gray-100 text-gray-600');
            sBadge.textContent = statusLabel;

            const formatter = new Intl.NumberFormat('id-ID');
            const total = parseInt(b.total_harga);
            const paid = b.payments && b.payments.length > 0 ? parseInt(b.payments[0].jumlah) : 0;
            const remain = total - paid;

            document.getElementById('modal-price').textContent = 'Rp ' + formatter.format(total);
            document.getElementById('modal-dp').textContent = 'Rp ' + formatter.format(paid);
            document.getElementById('modal-remaining').textContent = 'Rp ' + formatter.format(remain > 0 ? remain : 0);

            // Build dynamic timeline
            const timelineEl = document.getElementById('modal-timeline');
            
            // Format date helper
            const formatTime = (dateStr) => {
                if (!dateStr) return '';
                const d = new Date(dateStr);
                return d.toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'}) + ', ' + 
                       d.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
            };

            let steps = [];
            
            // Step 1: Booking Created
            steps.push({ label: 'Booking Created', time: formatTime(b.created_at), active: true });
            
            // Step 2: Payment
            if (b.payments && b.payments.length > 0) {
                const pay = b.payments[0];
                if (pay.status === 'paid' || pay.status === 'dp') {
                    steps.push({ label: 'Payment Received', time: formatTime(pay.updated_at || pay.created_at), active: true });
                }
            }
            
            // Step 3: Status specific
            if (b.status === 'confirmed') {
                steps.push({ label: 'Booking Confirmed', time: formatTime(b.updated_at), active: true });
            } else if (b.status === 'active') {
                steps.push({ label: 'Booking Confirmed', time: formatTime(b.updated_at), active: true });
                steps.push({ label: 'Customer Checked In', time: formatTime(b.updated_at), active: true });
            } else if (b.status === 'completed') {
                steps.push({ label: 'Booking Confirmed', time: formatTime(b.updated_at), active: true });
                steps.push({ label: 'Session Completed', time: formatTime(b.updated_at), active: true });
            } else if (b.status === 'cancelled') {
                steps.push({ label: 'Booking Cancelled', time: formatTime(b.updated_at), active: true });
            }

            timelineEl.innerHTML = steps.map((step, i) => {
                const isLast = i === steps.length - 1;
                return '<div class="relative flex gap-3 ' + (isLast ? '' : 'pb-5') + '">' +
                    (!isLast ? '<div class="absolute left-[7px] top-4 bottom-0 w-px bg-gray-200"></div>' : '') +
                    '<div class="relative mt-1 flex h-4 w-4 shrink-0 items-center justify-center">' +
                        '<span class="h-3 w-3 rounded-full ' + (isLast ? 'bg-[#0047D4] ring-4 ring-blue-50' : 'bg-gray-300') + '"></span>' +
                    '</div>' +
                    '<div>' +
                        '<p class="text-sm font-semibold text-gray-900">' + step.label + '</p>' +
                        '<p class="text-xs text-gray-400">' + step.time + '</p>' +
                    '</div>' +
                '</div>';
            }).join('');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('booking-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        // Close modal on backdrop click
        document.getElementById('booking-modal').addEventListener('click', function (e) {
            if (e.target === this) closeModal();
        });

        // Close modal on Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });
</script>
@endpush
