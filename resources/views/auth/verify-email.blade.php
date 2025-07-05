@extends('layouts.user')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-8">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-8">
            <div class="text-center mb-6">
                <h1 class="font-bold text-2xl mb-1 text-purple-700">Xác minh email</h1>
                <p class="text-gray-500 text-base">Vui lòng kiểm tra email của bạn để xác minh tài khoản.<br>Nếu chưa nhận
                    được, bạn có thể gửi lại liên kết xác minh.</p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-green-700 bg-green-100 border border-green-200 rounded-lg px-4 py-2 text-center">
                    Một liên kết xác minh mới đã được gửi tới email của bạn.
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
                @csrf
                <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl shadow-md hover:from-purple-700 hover:to-pink-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-50">Gửi
                    lại liên kết xác minh</button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full py-3 px-4 bg-gray-200 text-gray-700 font-semibold rounded-xl shadow hover:bg-gray-300 transition-all duration-200">Đăng
                    xuất</button>
            </form>
        </div>
    </div>
@endsection
