@php
    $isAdminOrStaff = auth()->user() && (auth()->user()->role === 'admin' || auth()->user()->role === 'staff');
@endphp

@if ($isAdminOrStaff)
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts + Tailwind + Alpine -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        fadeIn: 'fadeIn 0.5s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                    },
                    colors: {
                        primary: {
                            DEFAULT: '#4f46e5',
                            dark: '#4338ca',
                            light: '#6366f1'
                        }
                    }
                }
            },
            darkMode: 'class',
        }
    </script>
</head>

<body class="font-inter bg-gray-100 text-gray-800 antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-xl transform transition-all duration-300 ease-in-out md:relative md:translate-x-0 rounded-r-xl">
            <div class="flex items-center justify-between h-16 px-6 bg-primary text-white font-semibold text-lg">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <x-application-logo class="h-8 w-auto text-white" />
                    <span>{{ config('app.name', 'Laravel') }}</span>
                </a>
                <button @click="sidebarOpen = false" class="md:hidden text-white hover:text-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <nav class="mt-6 px-3 space-y-2">
                @php
                    $navClasses = 'flex items-center px-5 py-3 text-lg text-gray-600 hover:bg-indigo-100 hover:text-indigo-700 rounded-xl transition duration-200 hover:scale-[1.02]';
                @endphp

                @foreach ([
                    ['route' => 'dashboard', 'icon' => 'fas fa-tachometer-alt', 'label' => 'Dashboard'],
                    ['route' => 'users.index', 'icon' => 'fas fa-users', 'label' => 'Users'],
                    ['route' => 'products.index', 'icon' => 'fas fa-box', 'label' => 'Products'],
                    ['route' => 'product_variants.index', 'icon' => 'fas fa-cube', 'label' => 'Product Variants'],
                    ['route' => 'brands.index', 'icon' => 'fas fa-tag', 'label' => 'Brands'],
                    ['route' => 'blogs.index', 'icon' => 'fas fa-blog', 'label' => 'Blogs'],
                ] as $nav)
                    <x-nav-link :href="route($nav['route'])" :active="request()->routeIs($nav['route'])"
                        class="{{ request()->routeIs($nav['route']) ? 'bg-indigo-200 text-indigo-800 font-semibold' : $navClasses }}">
                        <i class="{{ $nav['icon'] }} w-6 mr-3"></i> {{ __($nav['label']) }}
                    </x-nav-link>
                @endforeach
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white/80 backdrop-blur-md shadow-sm">
                <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="md:hidden text-gray-700 hover:text-indigo-600">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                        <h1 class="text-xl font-bold tracking-wide text-gray-800">{{ __('Admin Panel') }}</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                         <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-4 py-2 border border-gray-200 dark:border-gray-700 text-base font-medium rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600 shadow transition space-x-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4f46e5&color=fff&rounded=true"
                                        alt="Avatar" class="w-8 h-8 rounded-full">
                                    <span>{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down text-sm ml-1"></i>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                {{-- <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link> --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50 animate-fadeIn transition-all duration-300">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Scrollbar custom -->
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
    </style>
</body>

</html>
@else
    @include('layouts.user')
    @section('content')
    @endsection
@endif
