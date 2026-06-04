<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join SportOps | Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900">
    <div class="flex min-h-full">
        <!-- Left Side: Registration Form -->
        <div class="flex flex-col justify-center flex-1 px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-28 bg-white relative z-10">
            <div class="mx-auto w-full max-w-[480px] lg:w-[480px]">
                <!-- Brand Logo -->
                <div class="col-span-2 md:col-span-1 inline-block">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 select-none">
                        <div class="bg-white border border-gray-150 p-2.5 rounded-xl shadow-xs w-fit">
                            <img class="h-9 w-auto object-contain select-none" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                        </div>
                        <span class="text-lg font-extrabold tracking-tight text-gray-900">SportOps</span>
                    </a>
                </div>

                <!-- Page Header -->
                <div class="mt-8">
                    <h2 class="text-[34px] font-extrabold tracking-tight text-gray-900">Join SportOps</h2>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                        Create your admin account to manage facilities and bookings seamlessly.
                    </p>
                </div>

                <!-- Progress Bar -->
                <div class="mt-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-bold text-[#0047D4]">Step 1 of 3: Details</span>
                        <span class="text-xs font-bold text-gray-400">33%</span>
                    </div>
                    <div class="h-1.5 w-full bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-[#0047D4] rounded-full w-[33%] transition-all duration-300"></div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="mt-8">
                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        
                        <!-- Full Name Input -->
                        <div>
                            <label for="name" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">
                                Full Name
                            </label>
                            <div class="relative rounded-xl border border-gray-200 bg-gray-50/40 focus-within:border-[#0047D4] focus-within:ring-3 focus-within:ring-blue-100 transition-all duration-200">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                    <!-- User Icon -->
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <input id="name" name="name" type="text" autocomplete="name" required placeholder="Jane Doe" 
                                    class="block w-full bg-transparent border-0 py-3.5 pl-12 pr-4 text-sm text-gray-900 placeholder-gray-400 focus:ring-0 focus:outline-none">
                            </div>
                        </div>

                        <!-- Email & Phone Fields (Responsive Grid) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Email Address -->
                            <div>
                                <label for="email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">
                                    Email Address
                                </label>
                                <div class="relative rounded-xl border border-gray-200 bg-gray-50/40 focus-within:border-[#0047D4] focus-within:ring-3 focus-within:ring-blue-100 transition-all duration-200">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <!-- Mail Icon -->
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                        </svg>
                                    </div>
                                    <input id="email" name="email" type="email" autocomplete="email" required placeholder="jane@example.com" 
                                        class="block w-full bg-transparent border-0 py-3.5 pl-12 pr-4 text-sm text-gray-900 placeholder-gray-400 focus:ring-0 focus:outline-none">
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label for="phone" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">
                                    Phone Number
                                </label>
                                <div class="relative rounded-xl border border-gray-200 bg-gray-50/40 focus-within:border-[#0047D4] focus-within:ring-3 focus-within:ring-blue-100 transition-all duration-200">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <!-- Phone Icon -->
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                    </div>
                                    <input id="phone" name="phone" type="tel" placeholder="+1 (555) 000-0000" 
                                        class="block w-full bg-transparent border-0 py-3.5 pl-12 pr-4 text-sm text-gray-900 placeholder-gray-400 focus:ring-0 focus:outline-none">
                                </div>
                            </div>
                        </div>

                        <!-- Password Fields (Responsive Grid) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">
                                    Password
                                </label>
                                <div class="relative rounded-xl border border-gray-200 bg-gray-50/40 focus-within:border-[#0047D4] focus-within:ring-3 focus-within:ring-blue-100 transition-all duration-200">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <!-- Lock Icon -->
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                    </div>
                                    <input id="password" name="password" type="password" required placeholder="••••••••" 
                                        class="block w-full bg-transparent border-0 py-3.5 pl-12 pr-4 text-sm text-gray-900 placeholder-gray-400 focus:ring-0 focus:outline-none">
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">
                                    Confirm Password
                                </label>
                                <div class="relative rounded-xl border border-gray-200 bg-gray-50/40 focus-within:border-[#0047D4] focus-within:ring-3 focus-within:ring-blue-100 transition-all duration-200">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <!-- Custom Lock-Refresh Icon -->
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 8.5-3.5L17 5"></path>
                                            <path d="M14 2h3v3"></path>
                                            <path d="M12 15v3"></path>
                                        </svg>
                                    </div>
                                    <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="••••••••" 
                                        class="block w-full bg-transparent border-0 py-3.5 pl-12 pr-4 text-sm text-gray-900 placeholder-gray-400 focus:ring-0 focus:outline-none">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" 
                                class="flex w-full items-center justify-center rounded-xl bg-[#0047D4] px-4 py-4 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] hover:shadow-blue-500/20 active:scale-[0.99] transition-all duration-200 cursor-pointer">
                                Create My Account
                                <svg class="ml-2 h-4 w-4 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Footer Divider & Link -->
                <div class="mt-8">
                    <hr class="border-gray-100">
                    <p class="mt-8 text-center text-sm text-gray-500">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors duration-150">
                            Log in
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Side: Split-screen Image with testimonial glassmorphic card -->
        <div class="relative hidden w-0 flex-1 lg:block bg-slate-950 overflow-hidden">
            <!-- Background Image -->
            <img class="absolute inset-0 h-full w-full object-cover object-center select-none" src="{{ asset('images/padel.jpg') }}" alt="Indoor tennis court background">
            
            <!-- Dark Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-900/40 to-slate-950/20"></div>
        </div>
    </div>
</body>
</html>
