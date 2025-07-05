@extends('layouts.user')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-8">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-8">
            <div class="text-center mb-6">
                <h1 class="font-bold text-2xl mb-1 text-purple-700">Tạo tài khoản mới</h1>
                <p class="text-gray-500 text-base">Điền thông tin để đăng ký tài khoản.</p>
            </div>

            @if (session('status'))
                <div class="mb-4 text-green-700 bg-green-100 border border-green-200 rounded-lg px-4 py-2 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Họ và tên</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base @error('name') border-red-500 @enderror"
                        placeholder="Nguyễn Văn A">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base @error('email') border-red-500 @enderror"
                        placeholder="you@example.com">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base @error('password') border-red-500 @enderror"
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Nhập lại mật
                        khẩu</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password"
                        class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base"
                        placeholder="••••••••">
                </div>
                <div>
                    <button type="submit"
                        class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl shadow-md hover:from-purple-700 hover:to-pink-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-50">Đăng
                        ký</button>
                </div>
            </form>
            <div class="text-center mt-6">
                <span class="text-gray-500">Đã có tài khoản?</span>
                <a href="{{ route('login') }}" class="text-purple-700 font-semibold hover:underline ml-1">Đăng nhập</a>
            </div>
        </div>
    </div>
@endsection
