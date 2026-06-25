<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F7F8FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | SportOps</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-circle.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen font-sans antialiased text-gray-900 bg-[#F7F8FA]">

    <!-- ============================ TOP NAVIGATION ============================ -->
    <header class="sticky top-0 z-50 border-b border-gray-100 bg-white/80 backdrop-blur-md">
        <nav class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 select-none">
                <div class="bg-white border border-gray-150 p-1.5 rounded-xl shadow-xs">
                    <img class="h-7 w-auto object-contain" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                </div>
                <span class="hidden text-lg font-extrabold tracking-tight text-gray-900 sm:inline">SportOps</span>
            </a>

            <div class="hidden items-center gap-1 lg:flex">
                <a href="{{ route('dashboard') }}" class="rounded-lg px-3.5 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-[#0047D4] transition-colors duration-150">Dashboard</a>
                <a href="{{ route('booking') }}" class="rounded-lg px-3.5 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-[#0047D4] transition-colors duration-150">Book a Court</a>
                <a href="{{ route('bookings') }}" class="rounded-lg px-3.5 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-[#0047D4] transition-colors duration-150">My Bookings</a>
            </div>

            <div class="flex items-center gap-2 sm:gap-3">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-[#0047D4] to-indigo-600 text-xs font-bold text-white">{{ $authUser['initials'] ?? 'G' }}</span>
            </div>
        </nav>
    </header>

    <main class="flex-1 w-full mx-auto max-w-3xl px-4 py-6 sm:px-6 sm:py-10 lg:px-8">
        
        <div class="mb-8">
            <nav class="flex items-center gap-1.5 text-xs font-medium text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-[#0047D4]">Dashboard</a>
                <span>/</span>
                <span class="text-gray-600">Edit Profile</span>
            </nav>
            <h1 class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Edit Profile</h1>
            <p class="mt-1 text-sm text-gray-500">Update your personal information and password.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 p-4 border border-emerald-100">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-xs sm:p-8">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Personal Information</h2>
                        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $authUser['name']) }}" required class="mt-2 block w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-[#0047D4] focus:ring focus:ring-blue-100">
                                @error('name') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $authUser['email']) }}" required class="mt-2 block w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-[#0047D4] focus:ring focus:ring-blue-100">
                                @error('email') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700">Phone Number</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $authUser['phone']) }}" class="mt-2 block w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-[#0047D4] focus:ring focus:ring-blue-100">
                                @error('phone') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <h2 class="text-lg font-bold text-gray-900">Change Password</h2>
                        <p class="mt-1 text-xs text-gray-500">Leave blank if you don't want to change your password.</p>
                        
                        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700">New Password</label>
                                <input type="password" name="password" id="password" class="mt-2 block w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-[#0047D4] focus:ring focus:ring-blue-100">
                                @error('password') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-2 block w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-[#0047D4] focus:ring focus:ring-blue-100">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-6">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-xs hover:border-gray-300 hover:bg-gray-50 transition-colors duration-150">Cancel</a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-[#0047D4] px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.99] transition-all duration-200">Save Changes</button>
                </div>
            </form>
        </div>
    </main>

    <!-- ============================ FOOTER ============================ -->
    <footer class="mt-8 border-t border-gray-100 bg-white">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-4 py-6 sm:flex-row sm:px-6 lg:px-8">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} SportOps. All rights reserved.</p>
            <div class="flex items-center gap-5 text-sm text-gray-400">
                <span>Jl. Olahraga No. 12, Jakarta</span>
            </div>
        </div>
    </footer>

</body>
</html>
