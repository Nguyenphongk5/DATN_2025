@extends('layouts.user')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-8">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-8">
            <div class="text-center mb-6">
                <h1 class="font-bold text-3xl mb-1 text-purple-700">Chào mừng đến với LightSteps 👋</h1>
                <p class="text-gray-500 text-base">Đăng nhập vào tài khoản của bạn để tiếp tục mua sắm </p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-green-700 bg-green-100 border border-green-200 rounded-lg px-4 py-2 text-center">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('info'))
                <div
                    class="mb-6 bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-4 rounded-2xl shadow-xl border border-blue-400/30">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-sm">{{ session('info') }}</p>
                            <p class="text-xs text-blue-100">Đăng nhập để tiếp tục mua sắm</p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                    <input id="email" name="email" type="email"
                        class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}" required autofocus placeholder="you@example.com">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password"
                        class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base @error('password') border-red-500 @enderror"
                        required placeholder="••••••••">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500"
                            type="checkbox" name="remember" id="remember">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-purple-600 hover:underline" href="{{ route('password.request') }}">Forgot
                            password?</a>
                    @endif
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                        class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl shadow-md hover:from-purple-700 hover:to-pink-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-50">Log
                        In</button>
                </div>
                <a href="{{ route('auth.google') }}">
    <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" alt="Đăng nhập Google">
</a>
            </form>


            <div class="text-center mt-6">
                <span class="text-gray-500">Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-purple-700 font-semibold hover:underline ml-1">Create one</a>
            </div>
        </div>
    </div>
     @php
        $firstErrorField = null;
        foreach (['email', 'password'] as $field) {
            if ($errors->has($field)) {
                $firstErrorField = $field;
                break;
            }
        }
    @endphp

    @if ($firstErrorField)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const input = document.querySelector('[name="{{ $firstErrorField }}"]');
                if (input) input.focus();
            });
        </script>
    @endif
@endsection
