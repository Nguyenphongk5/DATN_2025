@extends('layouts.user')

@section('content')
    <div class="py-10 min-h-screen bg-gradient-to-br from-white via-blue-50 to-cyan-50" x-data="{ tab: 'avatar' }">
        <!-- Tiêu đề -->
        <div class="mb-8 text-center">
            <h2
                class="font-extrabold text-3xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 drop-shadow-lg inline-flex items-center gap-2">
                <i class="fas fa-user-circle animate-pulse"></i> Profile Settings
            </h2>
            <p class="text-gray-500 mt-2">Manage your account settings and preferences</p>
        </div>

        <!-- Tabs -->
        <div class="flex justify-center mb-8">
            <nav class="flex rounded-2xl shadow bg-white/90 divide-x divide-indigo-100 overflow-hidden">
                <button
                    class="tab-btn px-8 py-3 font-bold text-indigo-600 hover:bg-indigo-50 focus:bg-indigo-100 focus:outline-none transition"
                    :class="{ 'bg-indigo-100 text-indigo-700': tab === 'avatar' }" @click="tab = 'avatar'">Avatar</button>
                <button
                    class="tab-btn px-8 py-3 font-bold text-indigo-600 hover:bg-indigo-50 focus:bg-indigo-100 focus:outline-none transition"
                    :class="{ 'bg-indigo-100 text-indigo-700': tab === 'info' }" @click="tab = 'info'">Information</button>
                <button
                    class="tab-btn px-8 py-3 font-bold text-indigo-600 hover:bg-indigo-50 focus:bg-indigo-100 focus:outline-none transition"
                    :class="{ 'bg-indigo-100 text-indigo-700': tab === 'password' }"
                    @click="tab = 'password'">Password</button>
                <button
                    class="tab-btn px-8 py-3 font-bold text-red-500 hover:bg-red-50 focus:bg-red-100 focus:outline-none transition"
                    :class="{ 'bg-red-100 text-red-700': tab === 'delete' }" @click="tab = 'delete'">Danger Zone</button>
            </nav>
        </div>

        <!-- Nội dung tab -->
        <div class="max-w-3xl mx-auto bg-white/90 shadow-2xl rounded-3xl p-8">
            <div x-show="tab === 'avatar'">
                <h3 class="text-xl font-bold text-indigo-700 mb-4 flex items-center gap-2"><i class="fas fa-image"></i>
                    Update Profile Picture</h3>
                @include('profile.partials.update-profile-avatar')
            </div>
            <div x-show="tab === 'info'">
                <h3 class="text-xl font-bold text-indigo-700 mb-4 flex items-center gap-2"><i class="fas fa-user-edit"></i>
                    Update Personal Information</h3>
                @include('profile.partials.update-profile-information-form')
            </div>
            <div x-show="tab === 'password'">
                <h3 class="text-xl font-bold text-indigo-700 mb-4 flex items-center gap-2"><i class="fas fa-key"></i> Change
                    Password</h3>
                @include('profile.partials.update-password-form')
            </div>
            <div x-show="tab === 'delete'">
                <h3 class="text-xl font-bold text-red-600 mb-4 flex items-center gap-2"><i
                        class="fas fa-exclamation-triangle"></i> Delete Account</h3>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Không cần Alpine.data cho tab ở đây nữa
    </script>
@endpush
