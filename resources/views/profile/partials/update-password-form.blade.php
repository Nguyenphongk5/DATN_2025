<section class="mb-8">
    <div class="bg-white/90 shadow-xl rounded-2xl p-8">
        <h4 class="text-lg font-bold text-indigo-700 mb-2 flex items-center gap-2"><i class="fas fa-key"></i> Update
            Password</h4>
        <p class="text-gray-500 mb-4">Use a strong password to keep your account secure.</p>
        <form method="POST" action="{{ route('password.update') }}" class="space-y-6 mt-4">
            @csrf
            @method('put')
            <!-- Current Password -->
            <div>
                <label for="update_password_current_password"
                    class="block text-sm font-bold mb-2 text-indigo-700">Current Password</label>
                <input type="password" name="current_password" id="update_password_current_password"
                    autocomplete="current-password"
                    class="w-full px-4 py-3 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-sky-400 focus:outline-none shadow @error('current_password', 'updatePassword') border-red-500 @enderror">
                @error('current_password', 'updatePassword')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <!-- New Password -->
            <div>
                <label for="update_password_password" class="block text-sm font-bold mb-2 text-indigo-700">New
                    Password</label>
                <input type="password" name="password" id="update_password_password" autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-sky-400 focus:outline-none shadow @error('password', 'updatePassword') border-red-500 @enderror">
                @error('password', 'updatePassword')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <!-- Confirm Password -->
            <div>
                <label for="update_password_password_confirmation"
                    class="block text-sm font-bold mb-2 text-indigo-700">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="update_password_password_confirmation"
                    autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-sky-400 focus:outline-none shadow @error('password_confirmation', 'updatePassword') border-red-500 @enderror">
                @error('password_confirmation', 'updatePassword')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <!-- Submit -->
            <div class="flex justify-between items-center mt-6">
                <button type="submit"
                    class="bg-gradient-to-r from-yellow-400 to-pink-400 hover:from-pink-400 hover:to-yellow-400 text-white font-bold py-2 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">Save</button>
                @if (session('status') === 'password-updated')
                    <span class="text-green-600 text-sm font-semibold ml-4 flex items-center gap-1"><i
                            class="fas fa-check-circle"></i> Password updated!</span>
                @endif
            </div>
        </form>
    </div>
</section>
