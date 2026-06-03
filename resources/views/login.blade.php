<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | SportOps</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900">
    <div class="flex min-h-full">
        <!-- Left Side: Login Form -->
        <div class="flex flex-col justify-center flex-1 px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-28 bg-white relative z-10">
            <div class="mx-auto w-full max-w-[420px] lg:w-[420px]">
                <!-- Brand Logo -->
                <div class="bg-white border border-gray-150 p-2.5 rounded-xl shadow-xs w-fit">
                    <img class="h-9 w-auto object-contain select-none" src="{{ asset('images/logo.png') }}" alt="SportOps Logo">
                </div>

                <!-- Page Header -->
                <div class="mt-8">
                    <h2 class="text-[34px] font-extrabold tracking-tight text-gray-900">Sign In</h2>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed max-w-sm">
                        Enter your credentials to access your sports management dashboard.
                    </p>
                </div>

                <!-- Form Section -->
                <div class="mt-8">
                    <form action="#" method="POST" class="space-y-5">
                        @csrf
                        
                        <!-- Email Address Input -->
                        <div>
                            <label for="email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">
                                Email Address
                            </label>
                            <div class="relative rounded-xl border border-gray-200 bg-gray-50/40 focus-within:border-[#0047D4] focus-within:ring-3 focus-within:ring-blue-100 transition-all duration-200">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                    <!-- Mail Icon -->
                                    <svg class="h-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required placeholder="admin@sportops.com" 
                                    class="block w-full bg-transparent border-0 py-3.5 pl-12 pr-4 text-sm text-gray-900 placeholder-gray-400 focus:ring-0 focus:outline-none">
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Password
                                </label>
                                <div class="text-xs">
                                    <a href="#" class="font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors duration-150">
                                        Forgot password?
                                    </a>
                                </div>
                            </div>
                            <div class="relative rounded-xl border border-gray-200 bg-gray-50/40 focus-within:border-[#0047D4] focus-within:ring-3 focus-within:ring-blue-100 transition-all duration-200">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                    <!-- Lock Icon -->
                                    <svg class="h-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="current-password" required placeholder="••••••••" 
                                    class="block w-full bg-transparent border-0 py-3.5 pl-12 pr-12 text-sm text-gray-900 placeholder-gray-400 focus:ring-0 focus:outline-none">
                                <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 transition-colors duration-150 focus:outline-none">
                                    <!-- Eye Icon -->
                                    <svg id="eye-icon" class="h-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Keep Me Signed In -->
                        <div class="flex items-center mt-6">
                            <input id="remember-me" name="remember-me" type="checkbox" 
                                class="h-5 w-5 rounded border-gray-300 text-[#0047D4] focus:ring-[#0047D4] cursor-pointer">
                            <label for="remember-me" class="ml-3 block text-sm text-gray-500 font-medium select-none cursor-pointer">
                                Keep me signed in
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" 
                                class="flex w-full items-center justify-center rounded-xl bg-[#0047D4] px-4 py-4 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] hover:shadow-blue-500/20 active:scale-[0.99] transition-all duration-200 cursor-pointer">
                                Log In to Dashboard
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
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-semibold text-[#0047D4] hover:text-[#003cb5] transition-colors duration-150">
                            Register your club
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Side: Split-screen Image with Glassmorphic Card -->
        <div class="relative hidden w-0 flex-1 lg:block bg-slate-950 overflow-hidden">
            <!-- Background Image -->
            <img class="absolute inset-0 h-full w-full object-cover object-center select-none" src="{{ asset('images/futsal.jpg') }}" alt="Stadium background">
            
            <!-- Dark Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-900/40 to-slate-950/20"></div>
        </div>
    </div>

    <!-- Password toggle JavaScript -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Switch icon to Slash/Hide state
                eyeIcon.innerHTML = `
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                    <line x1="1" y1="1" x2="23" y2="23"></line>
                `;
            } else {
                passwordInput.type = 'password';
                // Switch icon back to Open state
                eyeIcon.innerHTML = `
                    <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                `;
            }
        }
    </script>
</body>
</html>
