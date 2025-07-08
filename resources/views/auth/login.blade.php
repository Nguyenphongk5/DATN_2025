@extends('layouts.user')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-10">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-md p-8">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-purple-700">Welcome Back 👋</h1>
                <p class="text-gray-600 mt-2">Login to your account to continue</p>
            </div>

            @if (session('status'))
                <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded-lg text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input id="email" name="email" type="email"
                        class="mt-1 w-full border rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password"
                        class="mt-1 w-full border rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 @error('password') border-red-500 @enderror"
                        placeholder="••••••••" required>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm">
                        <input type="checkbox" name="remember" class="mr-2 text-purple-600">
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:underline">
                        Forgot password?
                    </a>
                </div>
                
                <div>
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 rounded-xl font-semibold shadow hover:from-purple-700 hover:to-pink-700 transition-all duration-200">
                        Log In
                    </button>
                </div>
            </form>

            <div class="text-center mt-6 text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-purple-700 font-semibold hover:underline">Create one</a>
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
