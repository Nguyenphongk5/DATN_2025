<section class="mb-8" id="tab-password">
    <div class="bg-white/90 shadow-xl rounded-2xl p-8">
        <h4 class="text-lg font-bold text-indigo-700 mb-2 flex items-center gap-2">
            <i class="fas fa-key"></i> Cập nhật mật khẩu
        </h4>
        <p class="text-gray-500 mb-4">Sử dụng mật khẩu mạnh để giữ an toàn cho tài khoản của bạn.</p>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6 mt-4">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-bold mb-2 text-indigo-700">Mật khẩu hiện tại</label>
                <input type="password" name="current_password" id="current_password"
                       class="w-full px-4 py-3 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-sky-400 focus:outline-none shadow @error('current_password', 'updatePassword') border-red-500 @enderror">
                @error('current_password', 'updatePassword')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-bold mb-2 text-indigo-700">Mật khẩu mới</label>
                <input type="password" name="password" id="password"
                       class="w-full px-4 py-3 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-sky-400 focus:outline-none shadow @error('password', 'updatePassword') border-red-500 @enderror">
                @error('password', 'updatePassword')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Xác nhận mật khẩu -->
            <div>
                <label for="password_confirmation" class="block text-sm font-bold mb-2 text-indigo-700">Xác nhận mật khẩu mới</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="w-full px-4 py-3 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-sky-400 focus:outline-none shadow @error('password_confirmation', 'updatePassword') border-red-500 @enderror">
                @error('password_confirmation', 'updatePassword')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gửi -->
            <div class="flex justify-between items-center mt-6">
                <button type="submit"
                        class="bg-gradient-to-r from-yellow-400 to-pink-400 hover:from-pink-400 hover:to-yellow-400 text-white font-bold py-2 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                    Lưu
                </button>

                @if (session('success'))
                    <div class="text-green-600 text-sm font-semibold ml-4 flex items-center gap-1">
                    </div>
                @endif
            </div>
        </form>
    </div>
</section>
