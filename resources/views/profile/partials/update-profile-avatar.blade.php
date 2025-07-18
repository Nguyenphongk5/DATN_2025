<section class="mb-8">
    <div class="bg-white/90 shadow-xl rounded-2xl p-8">
        <h4 class="text-lg font-bold text-indigo-700 mb-2 flex items-center gap-2"><i class="fas fa-image"></i> Cập nhật ảnh đại diện </h4>
        <p class="text-gray-500 mb-4">Tải lên ảnh đại diện mới cho tài khoản của bạn.</p>
        <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('POST')
            <!-- Avatar preview -->
            <div class="mb-4 flex flex-col items-center">
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                    class="rounded-full shadow-lg border-4 border-indigo-100 w-32 h-32 object-cover"
                    id="avatar-preview">
            </div>
            <!-- File input -->
            <div>
                <label for="avatar" class="block text-sm font-bold mb-2 text-indigo-700">Chọn hình đại diện mới</label>
                <input
                    class="block w-full text-sm text-gray-700 border border-indigo-200 rounded-xl focus:ring-2 focus:ring-sky-400 focus:outline-none shadow bg-white file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('avatar') border-red-500 @enderror"
                    type="file" id="avatar" name="avatar" accept="image/*" onchange="previewAvatar(event)">
                @error('avatar')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <!-- Submit -->
            <div class="flex justify-between items-center mt-6">
                <button type="submit"
                    class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-2 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">Save</button>
                @if (session('success'))
                    <span class="text-green-600 text-sm font-semibold ml-4 flex items-center gap-1">
                    </span>
                @endif
            </div>
        </form>
    </div>
    <script>
        function previewAvatar(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('avatar-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</section>
