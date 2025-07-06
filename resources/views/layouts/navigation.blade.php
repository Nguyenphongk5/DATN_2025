@php
    $isAdminOrStaff = auth()->user() && (auth()->user()->role === 'admin' || auth()->user()->role === 'staff');
@endphp

@if ($isAdminOrStaff)
    <!-- Admin Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed top-0 left-0 z-30 h-screen w-64 bg-gradient-to-b from-indigo-900 via-indigo-700 to-sky-800 text-white transform transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0 flex flex-col shadow-2xl ring-4 ring-indigo-300/30">
        <div class="h-20 flex flex-col items-center justify-center bg-gradient-to-r from-indigo-700 via-sky-600 to-cyan-500 text-2xl font-extrabold tracking-wide border-b-2 border-indigo-400/30 shadow-lg relative">
            <div class="w-14 h-14 bg-gradient-to-br from-pink-400 via-indigo-500 to-sky-400 rounded-full flex items-center justify-center text-white font-bold shadow-xl border-4 border-white/40 mt-2 mb-1 animate-pulse">
                <i class="fas fa-crown text-yellow-300 text-2xl drop-shadow-lg animate-bounce"></i>
            </div>
            <span class="text-white text-lg font-bold drop-shadow-lg tracking-widest">Admin Panel</span>
            <button @click="sidebarOpen = false" class="md:hidden absolute right-4 top-4 text-white text-2xl focus:outline-none hover:scale-110 transition-all">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1 text-base overflow-y-auto custom-scrollbar">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/0 hover:bg-gradient-to-r hover:from-indigo-500 hover:to-sky-400 hover:text-white transition shadow-md border border-transparent hover:border-sky-300/60 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-indigo-500 to-sky-400 text-white font-extrabold ring-2 ring-sky-300/60 shadow-xl' : '' }}">
                <i class="fas fa-chart-line text-sky-300 drop-shadow-lg"></i> Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/0 hover:bg-gradient-to-r hover:from-indigo-500 hover:to-sky-400 hover:text-white transition shadow-md border border-transparent hover:border-sky-300/60 {{ request()->routeIs('admin.products.*') ? 'bg-gradient-to-r from-indigo-500 to-sky-400 text-white font-extrabold ring-2 ring-sky-300/60 shadow-xl' : '' }}">
                <i class="fas fa-box text-pink-300 drop-shadow-lg"></i> Products
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/0 hover:bg-gradient-to-r hover:from-indigo-500 hover:to-sky-400 hover:text-white transition shadow-md border border-transparent hover:border-sky-300/60 {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-indigo-500 to-sky-400 text-white font-extrabold ring-2 ring-sky-300/60 shadow-xl' : '' }}">
                <i class="fas fa-users text-yellow-200 drop-shadow-lg"></i> Users
            </a>
            <a href="{{ route('admin.product_variants.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/0 hover:bg-gradient-to-r hover:from-indigo-500 hover:to-sky-400 hover:text-white transition shadow-md border border-transparent hover:border-sky-300/60 {{ request()->routeIs('admin.product_variants.*') ? 'bg-gradient-to-r from-indigo-500 to-sky-400 text-white font-extrabold ring-2 ring-sky-300/60 shadow-xl' : '' }}">
                <i class="fas fa-cubes text-cyan-300 drop-shadow-lg"></i> Product Variants
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/0 hover:bg-gradient-to-r hover:from-indigo-500 hover:to-sky-400 hover:text-white transition shadow-md border border-transparent hover:border-sky-300/60 {{ request()->routeIs('admin.categories.index') ? 'bg-gradient-to-r from-indigo-500 to-sky-400 text-white font-extrabold ring-2 ring-sky-300/60 shadow-xl' : '' }}">
                <i class="fas fa-tags text-green-200 drop-shadow-lg"></i> Categories
            </a>
            <a href="{{ route('admin.brands.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/0 hover:bg-gradient-to-r hover:from-indigo-500 hover:to-sky-400 hover:text-white transition shadow-md border border-transparent hover:border-sky-300/60 {{ request()->routeIs('admin.brands.*') ? 'bg-gradient-to-r from-indigo-500 to-sky-400 text-white font-extrabold ring-2 ring-sky-300/60 shadow-xl' : '' }}">
                <i class="fas fa-copyright text-orange-200 drop-shadow-lg"></i> Brands
            </a>
            <a href="{{ route('admin.blogs.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/0 hover:bg-gradient-to-r hover:from-indigo-500 hover:to-sky-400 hover:text-white transition shadow-md border border-transparent hover:border-sky-300/60 {{ request()->routeIs('admin.blogs.*') ? 'bg-gradient-to-r from-indigo-500 to-sky-400 text-white font-extrabold ring-2 ring-sky-300/60 shadow-xl' : '' }}">
                <i class="fas fa-blog text-fuchsia-200 drop-shadow-lg"></i> Blogs
            </a>
            <a href="{{ route('admin.logos.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/0 hover:bg-gradient-to-r hover:from-indigo-500 hover:to-sky-400 hover:text-white transition shadow-md border border-transparent hover:border-sky-300/60 {{ request()->routeIs('admin.logos.*') ? 'bg-gradient-to-r from-indigo-500 to-sky-400 text-white font-extrabold ring-2 ring-sky-300/60 shadow-xl' : '' }}">
                <i class="fas fa-image text-cyan-200 drop-shadow-lg"></i> Logos
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/0 hover:bg-gradient-to-r hover:from-indigo-500 hover:to-sky-400 hover:text-white transition shadow-md border border-transparent hover:border-sky-300/60 {{ request()->routeIs('admin.orders.*') ? 'bg-gradient-to-r from-indigo-500 to-sky-400 text-white font-extrabold ring-2 ring-sky-300/60 shadow-xl' : '' }}">
                <i class="fas fa-receipt text-lime-200 drop-shadow-lg"></i> Orders
            </a>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/0 hover:bg-gradient-to-r hover:from-indigo-500 hover:to-sky-400 hover:text-white transition shadow-md border border-transparent hover:border-sky-300/60">
                <i class="fas fa-user-cog text-white drop-shadow-lg"></i> Profile
            </a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="mt-auto mb-6 px-4">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-pink-500 to-red-500 hover:from-red-500 hover:to-pink-500 transition text-white font-semibold shadow-lg ring-2 ring-pink-200/40">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </aside>
    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen" class="fixed inset-0 bg-black bg-opacity-40 z-20 md:hidden" @click="sidebarOpen = false"></div>
@endif
