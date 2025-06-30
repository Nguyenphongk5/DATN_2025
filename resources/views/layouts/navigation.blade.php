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
    <div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="h-16 flex items-center justify-center bg-gray-900 text-xl font-bold tracking-wide">
            Admin Panel
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 text-sm">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition {{ request()->routeIs('dashboard') ? 'bg-gray-700 font-semibold' : '' }}">
                📊 Bảng điều khiển
            </a>
            <a href="{{ route('products.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition {{ request()->routeIs('products.*') ? 'bg-gray-700 font-semibold' : '' }}">
                Products
            </a>
            {{-- <a href="{{ route('orders.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition {{ request()->routeIs('orders.*') ? 'bg-gray-700 font-semibold' : '' }}">
                🧾 Đơn hàng
            </a> --}}
            <a href="{{ route('users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition {{ request()->routeIs('users.*') ? 'bg-gray-700 font-semibold' : '' }}">
                Users
            </a>
            <a href="{{ route('product_variants.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition {{ request()->routeIs('product_variants.*') ? 'bg-gray-700 font-semibold' : '' }}">
                Product Variants
            </a>
            <a href="{{ route('brands.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition {{ request()->routeIs('brands.*') ? 'bg-gray-700 font-semibold' : '' }}">
                Brands
            </a>
            <a href="{{ route('blogs.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition {{ request()->routeIs('blogs.*') ? 'bg-gray-700 font-semibold' : '' }}">
                Blogs
            </a>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                ⚙️ Hồ sơ
            </a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="mb-4 px-4">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-600 bg-red-500 transition text-white">
                🚪 Đăng xuất
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Navbar -->
        <header class="bg-white border-b shadow h-16 flex items-center justify-between px-6">
            <div class="text-lg font-semibold">
                @yield('title', 'Quản trị hệ thống')
            </div>
            <div class="flex items-center space-x-3">
                <span>{{ Auth::user()->name }}</span>
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                     alt="Avatar"
                     class="w-8 h-8 rounded-full object-cover border border-gray-300">
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6">
            {{-- @yield('content') --}}
            {{ $slot }}
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
