<section class="mb-8">
    <div class="bg-white/90 shadow-xl rounded-2xl p-8 border border-red-200">
        <h4 class="text-lg font-bold text-red-600 mb-2 flex items-center gap-2"><i
                class="fas fa-exclamation-triangle"></i> Xóa tài khoản</h4>
        <p class="text-gray-500 mb-4">Sau khi tài khoản của bạn bị xóa, toàn bộ dữ liệu sẽ bị xóa vĩnh viễn. Vui lòng tải xuống bất kỳ dữ liệu nào bạn muốn giữ lại trước khi tiếp tục.</p>
        <!-- Trigger Delete Modal -->
        <button type="button" @click="showModal = true"
            class="bg-gradient-to-r from-red-400 to-pink-500 hover:from-pink-500 hover:to-red-400 text-white font-bold py-2 px-8 rounded-xl shadow-lg flex items-center gap-2 transition mt-3">Delete
            Account</button>
        <!-- Modal -->
        <div x-data="{ showModal: false }" x-show="showModal" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 border-t-4 border-red-400">
                <h5 class="text-xl font-bold text-red-600 mb-4 flex items-center gap-2"><i
                        class="fas fa-exclamation-circle"></i> Confirm Deletion</h5>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <p class="mb-4 text-gray-700">Are you sure you want to delete your account? This action cannot be
                        undone.</p>
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-bold mb-2 text-indigo-700">Enter your
                            password</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-3 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-pink-400 focus:outline-none shadow @error('password', 'userDeletion') border-red-500 @enderror"
                            placeholder="Password" required>
                        @error('password', 'userDeletion')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex justify-between gap-4">
                        <button type="button" @click="showModal = false"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-6 rounded-xl shadow">Cancel</button>
                        <button type="submit"
                            class="bg-gradient-to-r from-red-400 to-pink-500 hover:from-pink-500 hover:to-red-400 text-white font-bold py-2 px-6 rounded-xl shadow">Delete
                            Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
