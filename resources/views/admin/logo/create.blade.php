<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-image text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Thêm Logo mới</h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <h1
                    class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 drop-shadow-lg flex items-center gap-2 mb-8">
                    <i class="fas fa-plus-circle animate-bounce text-indigo-400"></i>
                    Thêm Logo mới
                </h1>
                <form action="{{ route('admin.logos.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-bold mb-2 text-indigo-700">Tên logo</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-sky-400 focus:outline-none shadow">
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-bold mb-2 text-indigo-700">Hình ảnh</label>
                        <input type="file" name="image" id="image" accept="image/*" required
                            class="w-full px-4 py-3 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-sky-400 focus:outline-none shadow bg-white">
                        @error('image')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-bold mb-2 text-indigo-700">Trạng thái</label>
                        <select name="status" id="status"
                            class="w-full px-4 py-3 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-sky-400 focus:outline-none shadow">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Đang sử dụng</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Ẩn</option>
                        </select>
                        @error('status')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex justify-end gap-4 mt-8">
                        <a href="{{ route('admin.logos.list') }}"
                            class="bg-gradient-to-r from-gray-400 to-gray-600 hover:from-gray-600 hover:to-gray-400 text-white font-bold py-2 px-6 rounded-xl shadow-lg flex items-center gap-2 transition">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit"
                            class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-2 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                            <i class="fas fa-save"></i> Lưu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
