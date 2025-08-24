<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom scrollbar for content and sidebar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: linear-gradient(135deg, #f1f5f9 60%, #e0e7ff 100%);
            border-radius: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #6366f1 30%, #06b6d4 100%);
            border-radius: 8px;
            box-shadow: 0 2px 8px #6366f155;
            border: 2px solid #f1f5f9;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #06b6d4 0%, #6366f1 100%);
        }

        /* For Firefox */
        .custom-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #6366f1 #e0e7ff;
        }
    </style>
</head>

<body class="font-inter bg-gray-100 text-gray-800 antialiased h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
    <div class="h-screen flex">
        <!-- Sidebar -->
        @include('layouts.navigation')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Top Navbar for Admin -->
            @php
                $isAdminOrStaff =
                    auth()->user() && (auth()->user()->role === 'admin' || auth()->user()->role === 'staff');
            @endphp
            @if ($isAdminOrStaff)
                <nav
                    class="bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 shadow-xl border-b-4 border-indigo-300/40 px-6 py-3 flex-shrink-0 relative z-10">
                    <div class="flex items-center justify-between">
                        <!-- Mobile menu button -->
                        <button @click="sidebarOpen = true"
                            class="md:hidden text-white/80 hover:text-white focus:outline-none transition-all duration-200 hover:scale-110">
                            <i class="fas fa-bars text-2xl drop-shadow-lg"></i>
                        </button>
                        <!-- Desktop title -->
                        <div class="hidden md:flex items-center gap-3">
                            <i class="fas fa-crown text-yellow-300 text-2xl animate-bounce drop-shadow-lg"></i>
                            <h1
                                class="text-2xl font-extrabold text-white tracking-wide drop-shadow-lg bg-gradient-to-r from-yellow-200 via-white to-cyan-100 bg-clip-text text-transparent">
                                Admin Dashboard</h1>
                        </div>
                        <div class="dropdown-container" x-data="{ dropdownOpen: false }">
                            <button @click="dropdownOpen = !dropdownOpen"
                                class="flex items-center space-x-2 focus:outline-none group">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-pink-400 via-indigo-500 to-sky-400 rounded-full flex items-center justify-center text-white font-bold shadow-lg border-2 border-white/70 group-hover:ring-4 group-hover:ring-cyan-200 transition-all duration-200">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span
                                    class="hidden md:block font-semibold text-white drop-shadow-lg">{{ auth()->user()->name }}</span>
                                <i :class="dropdownOpen ? 'fas fa-chevron-up' : 'fas fa-chevron-down'"
                                    class="text-white/80 text-sm transition-transform duration-200"></i>
                            </button>
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95" x-cloak
                                class="absolute top-full right-0 z-[9999] min-w-[200px] bg-white rounded-xl shadow-xl py-2 mt-2">
                            
                                <a href="{{ route('home.index') }}"
                                    class="flex items-center justify-center gap-2 px-4 py-2 text-sm rounded-xl bg-gradient-to-r from-indigo-500 to-sky-400 text-white hover:from-indigo-600 hover:to-sky-500 transition shadow-md mx-2 my-1">
                                    <i class="fas fa-home text-white"></i> Home
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="px-2 pt-2">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm rounded-xl bg-gradient-to-r from-pink-500 to-red-500 hover:from-red-600 hover:to-pink-600 transition text-white font-semibold shadow-lg">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
            @endif

            <!-- Notifications -->
            <div class="fixed top-8 right-8 z-50 space-y-4">
                @if (session('success'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => { show = false }, 4000)" x-show="show"
                        x-transition:enter="transition ease-out duration-400"
                        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="flex items-center gap-4 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 text-white px-6 py-4 rounded-2xl shadow-xl border border-indigo-100/60 min-w-[320px] max-w-xs font-inter">
                        <div class="w-10 h-10 flex items-center justify-center bg-white/20 rounded-full shadow">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-opacity=".18"
                                    stroke-width="3" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12l2 2 4-4" stroke="#fff"
                                    stroke-width="3" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-base leading-snug">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false"
                            class="text-white/80 hover:text-white transition p-1 rounded-full focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <div x-show="show" class="absolute bottom-0 left-0 h-1 bg-white/30 rounded-b-2xl"
                            :style="'width: ' + (show ? '100%' : '0') + '; transition: width 4s linear;'"
                            style="min-width: 100%;"></div>
                    </div>
                @endif
                @if (session('error'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => { show = false }, 4000)" x-show="show"
                        x-transition:enter="transition ease-out duration-400"
                        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="flex items-center gap-4 bg-gradient-to-r from-pink-500 via-fuchsia-500 to-indigo-400 text-white px-6 py-4 rounded-2xl shadow-xl border border-pink-100/60 min-w-[320px] max-w-xs font-inter">
                        <div class="w-10 h-10 flex items-center justify-center bg-white/20 rounded-full shadow">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-opacity=".18" stroke-width="3" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"
                                    stroke="#fff" stroke-width="3" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-base leading-snug">{{ session('error') }}</p>
                        </div>
                        <button @click="show = false"
                            class="text-white/80 hover:text-white transition p-1 rounded-full focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <div x-show="show" class="absolute bottom-0 left-0 h-1 bg-white/30 rounded-b-2xl"
                            :style="'width: ' + (show ? '100%' : '0') + '; transition: width 4s linear;'"
                            style="min-width: 100%;"></div>
                    </div>
                @endif
                @if (session('warning'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => { show = false }, 4000)" x-show="show"
                        x-transition:enter="transition ease-out duration-400"
                        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="flex items-center gap-4 bg-gradient-to-r from-yellow-400 via-orange-400 to-pink-400 text-white px-6 py-4 rounded-2xl shadow-xl border border-yellow-100/60 min-w-[320px] max-w-xs font-inter">
                        <div class="w-10 h-10 flex items-center justify-center bg-white/20 rounded-full shadow">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-opacity=".18" stroke-width="3" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"
                                    stroke="#fff" stroke-width="3" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-base leading-snug">{{ session('warning') }}</p>
                        </div>
                        <button @click="show = false"
                            class="text-white/80 hover:text-white transition p-1 rounded-full focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <div x-show="show" class="absolute bottom-0 left-0 h-1 bg-white/30 rounded-b-2xl"
                            :style="'width: ' + (show ? '100%' : '0') + '; transition: width 4s linear;'"
                            style="min-width: 100%;"></div>
                    </div>
                @endif
            </div>

            <!-- Main Content -->
            <main
                class="flex-1 p-6 bg-gradient-to-br from-white via-blue-50 to-cyan-50 min-h-0 h-0 overflow-y-auto custom-scrollbar rounded-tl-3xl rounded-bl-3xl shadow-2xl">
                {{ $slot ?? '' }}
            </main>
        </div>
    </div>
    <script>
        // Auto-hide notifications after 5s
        document.addEventListener('alpine:init', () => {
            setTimeout(() => {
                document.querySelectorAll('[x-data] [x-show]').forEach(el => {
                    if (el.__x) el.__x.$data.show = false;
                });
            }, 5000);
        });
    </script>
    <!-- Confetti JS luxury -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <style>
        .glassmorphism-glow {
            box-shadow: 0 8px 40px 8px #06b6d4cc, 0 0 80px 10px #fff3, 0 0 0 8px #fff2;
            border: 1.5px solid rgba(255, 255, 255, 0.25);
        }

        .animate-bounce-in {
            animation: bounce-in 0.8s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        @keyframes bounce-in {
            0% {
                opacity: 0;
                transform: scale(0.5) translateY(-80px);
            }

            60% {
                opacity: 1;
                transform: scale(1.1) translateY(10px);
            }

            80% {
                transform: scale(0.95) translateY(-4px);
            }

            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .animate-neon-glow {
            animation: neon-glow 1.5s infinite alternate;
        }

        @keyframes neon-glow {
            0% {
                filter: drop-shadow(0 0 8px #fff7) drop-shadow(0 0 16px #67e8f9);
            }

            100% {
                filter: drop-shadow(0 0 24px #fff9) drop-shadow(0 0 32px #06b6d4);
            }
        }

        .neon-stroke {
            filter: drop-shadow(0 0 8px #67e8f9) drop-shadow(0 0 16px #fff);
        }

        .neon-text-glitch {
            color: #fff;
            text-shadow: 0 0 8px #67e8f9, 0 0 16px #fff, 2px 2px 0 #06b6d4, -2px -2px 0 #f472b6;
            animation: neon-glitch 1.2s infinite alternate;
        }

        @keyframes neon-glitch {
            0% {
                text-shadow: 0 0 8px #67e8f9, 0 0 16px #fff, 2px 2px 0 #06b6d4, -2px -2px 0 #f472b6;
            }

            20% {
                text-shadow: 2px 2px 8px #f472b6, -2px -2px 8px #06b6d4, 0 0 16px #fff;
            }

            40% {
                text-shadow: -2px 2px 8px #67e8f9, 2px -2px 8px #fff, 0 0 16px #f472b6;
            }

            60% {
                text-shadow: 0 0 24px #fff, 0 0 32px #06b6d4;
            }

            100% {
                text-shadow: 0 0 8px #67e8f9, 0 0 16px #fff, 2px 2px 0 #06b6d4, -2px -2px 0 #f472b6;
            }
        }

        .neon-btn-glow {
            box-shadow: 0 0 8px 2px #67e8f9, 0 2px 8px #fff7;
            transition: box-shadow 0.2s;
        }

        .neon-btn-glow:hover {
            box-shadow: 0 0 24px 6px #fff9, 0 2px 16px #06b6d4cc;
        }

        .animate-progress-neon {
            animation: progress-neon-anim 5s linear forwards;
        }

        @keyframes progress-neon-anim {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        /* Ripple effect for buttons */
        .ripple {
            position: relative;
            overflow: hidden;
        }

        .ripple:after {
            content: '';
            display: block;
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            width: 100px;
            height: 100px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: rgba(255, 255, 255, 0.3);
            animation: ripple-anim 0.6s linear;
        }

        .ripple:active:after {
            animation: ripple-anim 0.6s linear;
        }

        @keyframes ripple-anim {
            to {
                transform: translate(-50%, -50%) scale(2.5);
                opacity: 0;
            }
        }
    </style>
</body>

</html>
