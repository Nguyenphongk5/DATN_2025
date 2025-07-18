@extends('layouts.user')

@section('content')
    <div class="py-10 min-h-screen bg-gradient-to-br from-white via-blue-50 to-cyan-50"
         x-data="{ 
            tab: localStorage.getItem('profileTab') || 'avatar',
            setTab(t) { this.tab = t; localStorage.setItem('profileTab', t); }
         }">
        <!-- Flash message -->
        @if (session('status'))
            <div id="flash-message" class="mb-4 px-4 py-3 rounded-xl bg-green-100 text-green-800 font-semibold shadow">
                {{ session('status') }}
            </div>
        @endif
        <!-- Tiêu đề -->
        <div class="mb-8 text-center">
            <h2
                class="font-extrabold text-3xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 drop-shadow-lg inline-flex items-center gap-2">
                <i class="fas fa-user-circle animate-pulse"></i> Cài đặt tài khoản
            </h2>
            <p class="text-gray-500 mt-2">Quản lý cài đặt và tùy chọn tài khoản của bạn</p>
        </div>

        <!-- Tabs -->
        <div class="flex justify-center mb-8">
            <nav class="flex rounded-2xl shadow bg-white/90 divide-x divide-indigo-100 overflow-hidden">
                <button
                    class="tab-btn px-8 py-3 font-bold text-indigo-600 hover:bg-indigo-50 focus:bg-indigo-100 focus:outline-none transition"
                    :class="{ 'bg-indigo-100 text-indigo-700': tab === 'avatar' }" @click="setTab('avatar')">Ảnh đại diện </button>
                <button
                    class="tab-btn px-8 py-3 font-bold text-indigo-600 hover:bg-indigo-50 focus:bg-indigo-100 focus:outline-none transition"
                    :class="{ 'bg-indigo-100 text-indigo-700': tab === 'info' }" @click="setTab('info')">Thông tin </button>
                <button
                    class="tab-btn px-8 py-3 font-bold text-indigo-600 hover:bg-indigo-50 focus:bg-indigo-100 focus:outline-none transition"
                    :class="{ 'bg-indigo-100 text-indigo-700': tab === 'password' }"
                    @click="setTab('password')">Mật khẩu </button>
                <button
                    class="tab-btn px-8 py-3 font-bold text-red-500 hover:bg-red-50 focus:bg-red-100 focus:outline-none transition"
                    :class="{ 'bg-red-100 text-red-700': tab === 'delete' }" @click="setTab('delete')">Xóa tài khoản</button>
            </nav>
        </div>

        <!-- Nội dung tab -->
        <div class="max-w-3xl mx-auto bg-white/90 shadow-2xl rounded-3xl p-8">
            <div x-show="tab === 'avatar'">
                <h3 class="text-xl font-bold text-indigo-700 mb-4 flex items-center gap-2"><i class="fas fa-image"></i>
                    Cập nhật ảnh đại diện</h3>
                @include('profile.partials.update-profile-avatar')
            </div>
            <div x-show="tab === 'info'">
                <h3 class="text-xl font-bold text-indigo-700 mb-4 flex items-center gap-2"><i class="fas fa-user-edit"></i>
                    Cập nhật thông tin cá nhân</h3>
                @include('profile.partials.update-profile-information-form')
            </div>
            <div x-show="tab === 'password'">
                <h3 class="text-xl font-bold text-indigo-700 mb-4 flex items-center gap-2"><i class="fas fa-key"></i> Thay đổi mật khẩu 
                </h3>
                @include('profile.partials.update-password-form')
            </div>
            <div x-show="tab === 'delete'">
                <h3 class="text-xl font-bold text-red-600 mb-4 flex items-center gap-2"><i
                        class="fas fa-exclamation-triangle"></i>Xóa tài khoản</h3>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Nếu có flash message và tab không phải 'info', chuyển về 'info'
        if (document.getElementById('flash-message')) {
            localStorage.setItem('profileTab', 'info');
        }
    </script>
@endpush
