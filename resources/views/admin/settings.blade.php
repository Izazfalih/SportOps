@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('page-subtitle', 'Manage venue configuration and preferences')

@section('content')

<div class="mx-auto max-w-4xl">

    @if (session('success'))
        <div class="mb-4 rounded-xl bg-emerald-50 border border-emerald-200 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-emerald-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Page header --}}
    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Settings</h1>

    {{-- ==================== TABS ==================== --}}
    <div class="mt-6 border-b border-gray-200">
        <nav class="-mb-px flex gap-1 overflow-x-auto" aria-label="Settings tabs">
            <button type="button" data-tab="general"
                    class="settings-tab active whitespace-nowrap rounded-t-xl px-4 py-2.5 text-sm font-semibold transition-colors duration-150 border-b-2 border-[#0047D4] text-[#0047D4]">
                General
            </button>
            <button type="button" data-tab="payment"
                    class="settings-tab whitespace-nowrap rounded-t-xl px-4 py-2.5 text-sm font-medium transition-colors duration-150 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                Payment
            </button>
            <button type="button" data-tab="notifications"
                    class="settings-tab whitespace-nowrap rounded-t-xl px-4 py-2.5 text-sm font-medium transition-colors duration-150 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                Notifications
            </button>
            <button type="button" data-tab="account"
                    class="settings-tab whitespace-nowrap rounded-t-xl px-4 py-2.5 text-sm font-medium transition-colors duration-150 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                Account
            </button>
        </nav>
    </div>

    {{-- ==================== GENERAL TAB ==================== --}}
    <div id="tab-general" class="settings-panel mt-6">
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-xs sm:p-8">
            <h2 class="text-lg font-bold text-gray-900">General Settings</h2>
            <p class="mt-1 text-sm text-gray-500">Configure your venue's basic information.</p>

            <form action="{{ route('admin.settings.update') }}" method="POST" class="mt-6 space-y-5">
                @csrf
                <input type="hidden" name="form_type" value="general">
                
                {{-- Venue Name --}}
                <div>
                    <label for="venue-name" class="block text-sm font-semibold text-gray-700">Venue Name</label>
                    <input type="text" id="venue-name" name="nama_venue" value="{{ old('nama_venue', $venue->nama_venue) }}"
                           class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                </div>

                {{-- Venue Address --}}
                <div>
                    <label for="venue-address" class="block text-sm font-semibold text-gray-700">Venue Address</label>
                    <textarea id="venue-address" name="alamat" rows="3"
                              class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150 resize-none">{{ old('alamat', $venue->alamat) }}</textarea>
                </div>

                {{-- Contact Phone --}}
                <div>
                    <label for="venue-phone" class="block text-sm font-semibold text-gray-700">Contact Phone</label>
                    <input type="tel" id="venue-phone" name="kontak" value="{{ old('kontak', $venue->kontak) }}"
                           class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                </div>

                {{-- Operating Hours --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Operating Hours</label>
                    <div class="mt-1.5 flex items-center gap-3">
                        <div class="flex-1">
                            <label for="hours-from" class="sr-only">From</label>
                            <div class="relative">
                                <input type="time" id="hours-from" name="open_time" value="{{ old('open_time', \Carbon\Carbon::parse($venue->open_time)->format('H:i')) }}"
                                       class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                            </div>
                        </div>
                        <span class="text-sm font-medium text-gray-400">to</span>
                        <div class="flex-1">
                            <label for="hours-to" class="sr-only">To</label>
                            <div class="relative">
                                <input type="time" id="hours-to" name="close_time" value="{{ old('close_time', \Carbon\Carbon::parse($venue->close_time)->format('H:i')) }}"
                                       class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Save --}}
                <div class="flex justify-end pt-2">
                    <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-[#0047D4] px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== PAYMENT TAB ==================== --}}
    <div id="tab-payment" class="settings-panel mt-6 hidden">
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-xs sm:p-8">
            <h2 class="text-lg font-bold text-gray-900">Payment Settings</h2>
            <p class="mt-1 text-sm text-gray-500">Manage payment methods and down-payment rules.</p>

            <form action="{{ route('admin.settings.update') }}" method="POST" class="mt-6 space-y-5">
                @csrf
                <input type="hidden" name="form_type" value="payment">
                
                {{-- Payment Method (read-only) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Payment Method</label>
                    <div class="mt-1.5 flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50 px-4 py-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50">
                            <svg class="h-5 w-5 text-[#0047D4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">QRIS Only</p>
                            <p class="text-xs text-gray-500">All payments are processed via QRIS</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Merchant Name</label>
                    <input type="text" name="merchant_name" value="{{ old('merchant_name', $venue->merchant_name) }}"
                           class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                </div>

                {{-- Down Payment Percentage --}}
                <div>
                    <label for="dp-percentage" class="block text-sm font-semibold text-gray-700">Down Payment Percentage</label>
                    <div class="relative mt-1.5">
                        <input type="number" id="dp-percentage" name="dp_percentage" value="{{ old('dp_percentage', $venue->dp_percentage) }}" min="0" max="100"
                               class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 pr-12 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4">
                            <span class="text-sm font-medium text-gray-500">%</span>
                        </div>
                    </div>
                    <p class="mt-1.5 text-xs text-gray-500">Minimum percentage required to secure a booking.</p>
                </div>

                {{-- Payment Expiry --}}
                <div>
                    <label for="payment-expiry" class="block text-sm font-semibold text-gray-700">Payment Expiry Limit</label>
                    <select id="payment-expiry" name="payment_expiry"
                            class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150 appearance-none">
                        <option value="30_mins" {{ $venue->payment_expiry == '30_mins' ? 'selected' : '' }}>30 Minutes</option>
                        <option value="1_hour" {{ $venue->payment_expiry == '1_hour' ? 'selected' : '' }}>1 Hour</option>
                        <option value="2_hours" {{ $venue->payment_expiry == '2_hours' ? 'selected' : '' }}>2 Hours</option>
                        <option value="24_hours" {{ $venue->payment_expiry == '24_hours' ? 'selected' : '' }}>24 Hours</option>
                    </select>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-[#0047D4] px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== NOTIFICATIONS TAB ==================== --}}
    <div id="tab-notifications" class="settings-panel mt-6 hidden">
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-xs sm:p-8">
            <h2 class="text-lg font-bold text-gray-900">Notification Preferences</h2>
            <p class="mt-1 text-sm text-gray-500">Choose what events you want to be notified about.</p>

            <form action="{{ route('admin.settings.update') }}" method="POST" class="mt-6 space-y-6">
                @csrf
                <input type="hidden" name="form_type" value="notification">
                
                {{-- Toggle Group --}}
                <div class="space-y-4 divide-y divide-gray-100">
                    
                    {{-- New Bookings --}}
                    <div class="flex items-center justify-between pb-4">
                        <div class="pr-4">
                            <label for="notif-bookings" class="text-sm font-semibold text-gray-900">New Bookings</label>
                            <p class="text-xs text-gray-500">Receive an email when a new booking is created.</p>
                        </div>
                        <label class="relative inline-flex cursor-pointer items-center">
                            <input type="checkbox" id="notif-bookings" name="notif_new_booking" class="peer sr-only" {{ $venue->notif_new_booking ? 'checked' : '' }}>
                            <div class="peer h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#0047D4] peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#0047D4]/20"></div>
                        </label>
                    </div>

                    {{-- Payments --}}
                    <div class="flex items-center justify-between py-4">
                        <div class="pr-4">
                            <label for="notif-payments" class="text-sm font-semibold text-gray-900">Payment Success</label>
                            <p class="text-xs text-gray-500">Receive an email when a payment is verified.</p>
                        </div>
                        <label class="relative inline-flex cursor-pointer items-center">
                            <input type="checkbox" id="notif-payments" name="notif_payment" class="peer sr-only" {{ $venue->notif_payment ? 'checked' : '' }}>
                            <div class="peer h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#0047D4] peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#0047D4]/20"></div>
                        </label>
                    </div>



                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-[#0047D4] px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                        Save Preferences
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== ACCOUNT TAB ==================== --}}
    <div id="tab-account" class="settings-panel mt-6 hidden">
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-xs sm:p-8">
            <h2 class="text-lg font-bold text-gray-900">Account Settings</h2>
            <p class="mt-1 text-sm text-gray-500">Manage your admin profile and credentials.</p>

            <form class="mt-6 space-y-5">
                {{-- Profile Info --}}
                <div class="flex items-center gap-4 pb-4">
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xl font-bold text-white shadow-sm">
                        {{ collect(explode(' ', Auth::user()->name ?? 'A'))->map(fn($w) => mb_substr($w, 0, 1))->take(2)->join('') }}
                    </div>
                    <div>
                        <button type="button" class="text-sm font-semibold text-[#0047D4] hover:text-[#003cb5]">Change Avatar</button>
                        <p class="mt-0.5 text-xs text-gray-500">JPG, GIF or PNG. Max size 2MB.</p>
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="admin-name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                        <input type="text" id="admin-name" value="{{ Auth::user()->name ?? 'Admin' }}"
                               class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-500 shadow-xs focus:outline-none" readonly disabled>
                    </div>
                    <div>
                        <label for="admin-email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                        <input type="email" id="admin-email" value="{{ Auth::user()->email ?? 'admin@sportops.id' }}"
                               class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-500 shadow-xs focus:outline-none" readonly disabled>
                        <p class="mt-1.5 text-xs text-gray-500">To change profile details, please go to User Management.</p>
                    </div>
                </div>

                <hr class="my-6 border-gray-100">

                <h3 class="text-sm font-bold text-gray-900">Change Password</h3>
                
                <div>
                    <label for="current-password" class="block text-sm font-semibold text-gray-700">Current Password</label>
                    <input type="password" id="current-password"
                           class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="new-password" class="block text-sm font-semibold text-gray-700">New Password</label>
                        <input type="password" id="new-password"
                               class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                    </div>
                    <div>
                        <label for="confirm-password" class="block text-sm font-semibold text-gray-700">Confirm New Password</label>
                        <input type="password" id="confirm-password"
                               class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs placeholder-gray-400 focus:border-[#0047D4] focus:ring-2 focus:ring-[#0047D4]/20 focus:outline-none transition-colors duration-150">
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="button"
                            class="inline-flex items-center justify-center rounded-xl bg-[#0047D4] px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.settings-tab');
        const panels = document.querySelectorAll('.settings-panel');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active styling from all tabs
                tabs.forEach(t => {
                    t.classList.remove('active', 'border-[#0047D4]', 'text-[#0047D4]');
                    t.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                });

                // Add active styling to clicked tab
                tab.classList.add('active', 'border-[#0047D4]', 'text-[#0047D4]');
                tab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');

                // Hide all panels
                panels.forEach(p => p.classList.add('hidden'));

                // Show target panel
                const targetId = `tab-${tab.dataset.tab}`;
                document.getElementById(targetId).classList.remove('hidden');
            });
        });
    });
</script>
@endpush
