@extends('layouts.staff')

@section('title', 'Offline Booking')
@section('page-title', 'Walk-In Booking')
@section('page-subtitle', 'Register an on-site customer')

@section('content')

    @php
        // Data $sports, $timeSlots, and $courtSchedules are passed from StaffController
    @endphp


    {{-- ============ BOOKING FORM + COURT OVERVIEW — TWO COLUMN ============ --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-5">

        {{-- ===================== LEFT COLUMN: Walk-In Booking Form ===================== --}}
        <div class="xl:col-span-3">

            {{-- Form card --}}
            <div id="booking-form-card" class="rounded-2xl border border-gray-100 bg-white shadow-xs">
                <div class="border-b border-gray-100 px-6 py-5">
                    <h2 class="text-lg font-bold text-gray-900">Create Walk-In Booking</h2>
                    <p class="mt-1 text-sm text-gray-500">Fill in the details below to book a court for a walk-in customer.
                    </p>
                </div>

                @if(session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const data = @json(session('success'));
                            document.getElementById('success-code').textContent = data.code;
                            document.getElementById('success-customer').textContent = data.customer;
                            document.getElementById('success-court').textContent = data.court;
                            document.getElementById('success-datetime').textContent = data.datetime;
                            document.getElementById('success-payment').textContent = data.payment;

                            document.getElementById('booking-form-card').classList.add('hidden');
                            document.getElementById('booking-success').classList.remove('hidden');
                        });
                    </script>
                @endif

                @if(session('error'))
                    <div class="mx-6 mt-6 mb-0 rounded-xl bg-rose-50 p-4 border border-rose-200">
                        <p class="text-sm font-semibold text-rose-800">{{ session('error') }}</p>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mx-6 mt-6 mb-0 rounded-xl bg-rose-50 p-4 border border-rose-200">
                        <ul class="list-disc pl-5 text-sm font-medium text-rose-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="booking-form" action="{{ route('staff.offline-booking.store') }}" method="POST"
                    class="p-6 space-y-6">
                    @csrf

                    {{-- Customer Info --}}
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="customer-name" class="block text-sm font-semibold text-gray-700 mb-1.5">Customer
                                Name <span class="text-rose-500">*</span></label>
                            <input type="text" id="customer-name" name="customer_name" required
                                placeholder="e.g. Ahmad Fauzi" value="{{ old('customer_name') }}"
                                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-xs transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10 focus:outline-none">
                        </div>
                        <div>
                            <label for="phone-number" class="block text-sm font-semibold text-gray-700 mb-1.5">Phone Number
                                <span class="text-rose-500">*</span></label>
                            <input type="tel" id="phone-number" name="phone_number" required placeholder="e.g. 08123456789"
                                value="{{ old('phone_number') }}"
                                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-xs transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10 focus:outline-none">
                        </div>
                    </div>

                    {{-- Sport Selection --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Select Sport <span
                                class="text-rose-500">*</span></label>
                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">
                            @foreach ($sports as $sport)
                                                <label class="sport-card group cursor-pointer">
                                                    <input type="radio" name="field_id" value="{{ $sport['id'] }}" class="peer sr-only" {{ !$sport['available'] ? 'disabled' : '' }} data-price="{{ $sport['price'] }}"
                                                        data-name="{{ $sport['name'] }}" onchange="updateSummary()" {{ (old('field_id') ?? request('field_id')) == $sport['id'] ? 'checked' : '' }}>
                                                    <div class="relative flex flex-col items-center gap-2 rounded-2xl border-2 p-4 text-center transition-all duration-200
                                                                                                        {{ $sport['available']
                                ? 'border-gray-100 bg-white peer-checked:border-[#0047D4] peer-checked:bg-blue-50/50 hover:border-blue-200 peer-checked:shadow-md'
                                : 'border-gray-100 bg-gray-50 opacity-60' }}">
                                                        <span class="text-2xl">{{ $sport['icon'] }}</span>
                                                        <span class="text-sm font-bold text-gray-900">{{ $sport['name'] }}</span>
                                                        <span class="text-xs font-medium text-gray-500">Rp
                                                            {{ number_format($sport['price'], 0, ',', '.') }}/hr</span>
                                                        @if (!$sport['available'])
                                                            <span
                                                                class="absolute -top-2 -right-2 rounded-full bg-rose-100 px-2 py-0.5 text-[10px] font-bold text-rose-600">{{ $sport['note'] ?? 'Unavailable' }}</span>
                                                        @endif
                                                    </div>
                                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Date Picker --}}
                    <div>
                        <label for="booking-date" class="block text-sm font-semibold text-gray-700 mb-1.5">Date</label>
                        <input type="date" id="booking-date" name="booking_date"
                            value="{{ old('booking_date', request('date', date('Y-m-d'))) }}"
                            class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-xs transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10 focus:outline-none sm:max-w-xs"
                            onchange="changeDate(this.value)">
                    </div>

                    {{-- Available Time Slots --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Available Time Slots</label>
                        <p class="text-xs text-gray-400 mb-3">Click on an available slot to select it</p>
                        <div class="grid grid-cols-2 gap-2.5 sm:grid-cols-4 lg:grid-cols-7">
                            @foreach ($timeSlots as $slot)
                                <label class="time-slot cursor-pointer group">
                                    <input type="radio" name="time" value="{{ $slot['time'] }}" class="peer sr-only"
                                        data-hour="{{ $slot['hour'] }}" onchange="updateSummary()" {{ (old('time') ?? request('time')) == $slot['time'] ? 'checked' : '' }}>
                                    <div
                                        class="flex flex-col items-center justify-center rounded-xl border-2 border-blue-100 bg-blue-50/40 px-2 py-3 transition-all duration-200 group-hover:border-[#0047D4] group-hover:bg-[#0047D4] group-has-[:checked]:border-[#0047D4] group-has-[:checked]:bg-[#0047D4]">
                                        <span
                                            class="text-sm font-semibold text-gray-700 group-hover:text-white group-has-[:checked]:text-white">{{ $slot['hour'] }}</span>
                                        <span
                                            class="mt-0.5 text-[10px] font-medium text-blue-600 group-hover:text-white group-has-[:checked]:text-white">Available</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Payment Type --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Payment Type <span
                                class="text-rose-500">*</span></label>
                        <div class="flex flex-wrap gap-3">
                            <label class="payment-option group">
                                <input type="radio" name="payment_type" value="dp" class="peer sr-only" checked
                                    onchange="updateSummary()">
                                <div
                                    class="flex items-center gap-3 rounded-xl border-2 border-gray-100 bg-white px-5 py-3.5 cursor-pointer transition-all duration-200 peer-checked:border-[#0047D4] peer-checked:bg-blue-50/50 peer-checked:shadow-lg peer-checked:shadow-blue-500/10 hover:border-blue-200">
                                    <span
                                        class="flex h-5 w-5 items-center justify-center rounded-full border-2 border-gray-300 transition-colors duration-200 peer-checked:border-[#0047D4] peer-checked:bg-[#0047D4] group-has-[:checked]:border-[#0047D4] group-has-[:checked]:bg-[#0047D4]">
                                        <svg class="h-3 w-3 text-white opacity-0 transition-opacity duration-200 group-has-[:checked]:opacity-100"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">Down Payment (50%)</p>
                                        <p class="text-xs text-gray-500">Pay half now, rest later</p>
                                    </div>
                                </div>
                            </label>
                            <label class="payment-option group">
                                <input type="radio" name="payment_type" value="full" class="peer sr-only"
                                    onchange="updateSummary()">
                                <div
                                    class="flex items-center gap-3 rounded-xl border-2 border-gray-100 bg-white px-5 py-3.5 cursor-pointer transition-all duration-200 peer-checked:border-[#0047D4] peer-checked:bg-blue-50/50 peer-checked:shadow-lg peer-checked:shadow-blue-500/10 hover:border-blue-200">
                                    <span
                                        class="flex h-5 w-5 items-center justify-center rounded-full border-2 border-gray-300 transition-colors duration-200 group-has-[:checked]:border-[#0047D4] group-has-[:checked]:bg-[#0047D4]">
                                        <svg class="h-3 w-3 text-white opacity-0 transition-opacity duration-200 group-has-[:checked]:opacity-100"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">Full Payment</p>
                                        <p class="text-xs text-gray-500">Pay full amount now</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Booking Summary --}}
                    <div id="booking-summary"
                        class="hidden rounded-2xl border border-blue-100 bg-gradient-to-br from-blue-50/60 to-white p-5">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-[#0047D4]">Booking Summary</h3>
                        <div class="mt-4 space-y-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Court</span>
                                <span id="summary-court" class="font-semibold text-gray-900">—</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Date</span>
                                <span id="summary-date" class="font-semibold text-gray-900">—</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Time</span>
                                <span id="summary-time" class="font-semibold text-gray-900">—</span>
                            </div>
                            <div class="h-px bg-blue-100"></div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Price</span>
                                <span id="summary-price" class="font-semibold text-gray-900">—</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-bold text-gray-900">Payment Amount</span>
                                <span id="summary-payment" class="text-lg font-extrabold text-[#0047D4]">—</span>
                            </div>
                            <p id="summary-payment-label" class="text-right text-xs text-gray-400"></p>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" id="submit-booking"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#0047D4] px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-500/10 transition-all duration-200 hover:bg-[#003cb5] active:scale-[0.99]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M12 5v14" />
                        </svg>
                        Create Booking
                    </button>
                </form>
            </div>

            {{-- ============ SUCCESS STATE ============ --}}
            <div id="booking-success" class="hidden rounded-2xl border border-gray-100 bg-white shadow-xs">
                <div class="flex flex-col items-center px-6 py-12 text-center">
                    {{-- Animated checkmark --}}
                    <div
                        class="flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 ring-8 ring-emerald-50/50">
                        <svg class="h-10 w-10 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                    </div>

                    <h2 class="mt-6 text-2xl font-extrabold tracking-tight text-gray-900">Booking Created Successfully!</h2>
                    <p class="mt-2 text-sm text-gray-500">The walk-in booking has been confirmed.</p>

                    {{-- Booking code --}}
                    <div class="mt-6 rounded-2xl border border-dashed border-blue-200 bg-blue-50/50 px-8 py-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Booking Code</p>
                        <p id="success-code" class="mt-1 text-2xl font-extrabold tracking-widest text-[#0047D4]">
                            WLK-240610-001</p>
                    </div>

                    {{-- Summary details --}}
                    <div class="mt-6 w-full max-w-sm space-y-2.5 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Customer</span>
                            <span id="success-customer" class="font-semibold text-gray-900">—</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Court</span>
                            <span id="success-court" class="font-semibold text-gray-900">—</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Date & Time</span>
                            <span id="success-datetime" class="font-semibold text-gray-900">—</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Payment</span>
                            <span id="success-payment" class="font-semibold text-emerald-600">—</span>
                        </div>
                    </div>

                    {{-- Action buttons --}}
                    <div class="mt-8 flex flex-col gap-3 w-full max-w-sm sm:flex-row">
                        <button type="button" onclick="resetForm()"
                            class="flex flex-1 items-center justify-center gap-2 rounded-xl bg-[#0047D4] px-5 py-3 text-sm font-bold text-white shadow-lg shadow-blue-500/10 transition-all duration-200 hover:bg-[#003cb5] active:scale-[0.99]">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5v14" />
                            </svg>
                            Create Another Booking
                        </button>
                        <button type="button" onclick="window.print()"
                            class="flex flex-1 items-center justify-center gap-2 rounded-xl border-2 border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-700 transition-all duration-200 hover:border-[#0047D4] hover:text-[#0047D4]">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 6 2 18 2 18 9" />
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                                <rect width="12" height="8" x="6" y="14" />
                            </svg>
                            Print Receipt
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===================== RIGHT COLUMN: Court Availability Overview ===================== --}}
        <div class="xl:col-span-2 space-y-6">

            {{-- Today's stats --}}
            <div class="grid grid-cols-2 gap-3">
                <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                    <div class="flex items-center gap-2.5">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-[#0047D4]">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="4" rx="2" />
                                <path d="M16 2v4M8 2v4M3 10h18" />
                            </svg>
                        </span>
                        <div>
                            <p class="text-xl font-extrabold text-gray-900">10</p>
                            <p class="text-xs text-gray-500">Today's Bookings</p>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                    <div class="flex items-center gap-2.5">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <polyline points="22 4 12 14.01 9 11.01" />
                            </svg>
                        </span>
                        <div>
                            <p class="text-xl font-extrabold text-gray-900">46</p>
                            <p class="text-xs text-gray-500">Slots Available</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Court Availability Card --}}
            <div class="rounded-2xl border border-gray-100 bg-white shadow-xs">
                <div class="border-b border-gray-100 px-5 py-4">
                    <h2 class="text-base font-bold text-gray-900">Court Availability</h2>
                    <p class="mt-0.5 text-xs text-gray-400">Date:
                        {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}
                    </p>
                </div>

                <div class="divide-y divide-gray-50">
                    @foreach ($courtSchedules as $court)
                        <div class="px-5 py-4">
                            <div class="flex items-center gap-2.5">
                                <span class="h-2.5 w-2.5 rounded-full {{ $court['color'] }}"></span>
                                <h3 class="text-sm font-bold text-gray-900">{{ $court['court'] }}</h3>
                                @if (!empty($court['note']))
                                    <span
                                        class="ml-auto rounded-full bg-rose-50 px-2 py-0.5 text-[10px] font-bold text-rose-600">{{ $court['note'] }}</span>
                                @endif
                            </div>

                            @if (count($court['slots']) > 0)
                                <div class="mt-2.5 flex flex-wrap gap-1.5">
                                    @foreach ($court['slots'] as $slot)
                                        <div class="rounded-lg bg-gray-50 px-2.5 py-1.5">
                                            <p class="text-[11px] font-semibold text-gray-700">{{ $slot['time'] }}</p>
                                            <p class="text-[10px] text-gray-400">{{ $slot['customer'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @elseif (empty($court['note']))
                                <p class="mt-2 text-xs text-emerald-600 font-medium">All slots available</p>
                            @else
                                <p class="mt-2 text-xs text-gray-400">No bookings — court is closed</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Quick Legend --}}
            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs">
                <h3 class="text-sm font-bold text-gray-900 mb-3">Time Slot Legend</h3>
                <div class="space-y-2.5">
                    <div class="flex items-center gap-2.5">
                        <span class="h-4 w-8 rounded border-2 border-blue-100 bg-blue-50/40"></span>
                        <span class="text-xs text-gray-600">Available — tap to select</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="h-4 w-8 rounded border-2 border-[#0047D4] bg-[#0047D4]"></span>
                        <span class="text-xs text-gray-600">Selected</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="h-4 w-8 rounded border-2 border-gray-100 bg-gray-50"></span>
                        <span class="text-xs text-gray-600">Booked — unavailable</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    @push('scripts')
        <script>
            function changeDate(newDate) {
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('date', newDate);
                // keep selected field if any
                const selectedField = document.querySelector('input[name="field_id"]:checked');
                if (selectedField) {
                    urlParams.set('field_id', selectedField.value);
                }
                window.location.search = urlParams.toString();
            }

            const bookedSlotsByField = {
                @foreach($courtSchedules as $court)
                                    "{{ $court['id'] }}": [
                    @foreach($court['booked_hours'] as $hourStr)
                        "{{ $hourStr }}",
                    @endforeach
                                    ],
                @endforeach
                                };

            function updateSummary() {
                const selectedSport = document.querySelector('input[name="field_id"]:checked');
                const selectedDate = document.getElementById('booking-date').value;
                const paymentTypeElement = document.querySelector('input[name="payment_type"]:checked');

                const fieldId = selectedSport ? selectedSport.value : null;
                const bookedHours = fieldId ? (bookedSlotsByField[fieldId] || []) : [];

                // Dynamically gray out booked time slots
                const timeSlotInputs = document.querySelectorAll('input[name="time"]');
                timeSlotInputs.forEach(input => {
                    const timeValue = input.value;
                    const container = input.nextElementSibling;
                    const label = input.parentElement;

                    if (bookedHours.includes(timeValue)) {
                        input.disabled = true;
                        if (input.checked) input.checked = false;

                        label.classList.remove('cursor-pointer');
                        label.classList.add('cursor-not-allowed');

                        container.className = 'flex flex-col items-center justify-center rounded-xl border-2 border-gray-100 bg-gray-50 px-2 py-3 cursor-not-allowed';
                        container.innerHTML = `
                            <span class="text-sm font-semibold text-gray-400">${input.dataset.hour}</span>
                            <span class="mt-0.5 text-[10px] font-bold uppercase tracking-wide text-gray-400">Booked</span>
                        `;
                    } else {
                        input.disabled = false;
                            
                        label.classList.add('cursor-pointer', 'group');
                        label.classList.remove('cursor-not-allowed');
                            
                        if (input.checked) {
                            container.className = 'flex flex-col items-center justify-center rounded-xl border-2 border-[#0047D4] bg-[#0047D4] px-2 py-3 transition-all duration-200 shadow-md shadow-blue-500/20';
                            container.innerHTML = `
                                <span class="text-sm font-semibold text-white">${input.dataset.hour}</span>
                                <span class="mt-0.5 text-[10px] font-medium text-white">Available</span>
                            `;
                        } else {
                            container.className = 'flex flex-col items-center justify-center rounded-xl border-2 border-blue-100 bg-blue-50/40 px-2 py-3 transition-all duration-200 group-hover:border-[#0047D4] group-hover:bg-[#0047D4]';
                            container.innerHTML = `
                                <span class="text-sm font-semibold text-gray-700 group-hover:text-white">${input.dataset.hour}</span>
                                <span class="mt-0.5 text-[10px] font-medium text-blue-600 group-hover:text-white">Available</span>
                            `;
                        }
                    }
                });

                const selectedTime = document.querySelector('input[name="time"]:checked');
                const paymentType = paymentTypeElement ? paymentTypeElement.value : 'dp';
                const summaryBox = document.getElementById('booking-summary');
                const btnSubmit = document.getElementById('submit-booking');

                if (selectedSport && selectedDate && selectedTime) {
                    summaryBox.classList.remove('hidden');

                    const price = parseInt(selectedSport.dataset.price);
                    const sportName = selectedSport.dataset.name;
                    const timeRange = selectedTime.value;

                    document.getElementById('summary-court').textContent = sportName;
                    document.getElementById('summary-date').textContent = selectedDate;
                    document.getElementById('summary-time').textContent = timeRange;

                    const formattedPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(price);
                    document.getElementById('summary-price').textContent = formattedPrice;

                    const paymentAmount = paymentType === 'dp' ? price / 2 : price;
                    const formattedPayment = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(paymentAmount);
                    document.getElementById('summary-payment').textContent = formattedPayment;
                    document.getElementById('summary-payment-label').textContent = paymentType === 'dp' ? 'Down Payment (50%)' : 'Full Payment';
                    btnSubmit.disabled = false;
                    btnSubmit.classList.remove('opacity-50', 'cursor-not-allowed');
                } else {
                    summaryBox.classList.add('hidden');
                    btnSubmit.disabled = true;
                    btnSubmit.classList.add('opacity-50', 'cursor-not-allowed');
                }
            }

            // init on load
            updateSummary();
        </script>
    @endpush
@endsection