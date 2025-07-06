<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-user-edit text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Cập nhật người dùng</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col items-center mb-8">
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                class="w-32 h-32 rounded-full object-cover ring-4 ring-sky-300 shadow-xl mb-4">
                        @else
                            <div
                                class="w-32 h-32 rounded-full bg-gradient-to-br from-gray-200 to-sky-100 flex items-center justify-center text-5xl text-gray-400 mb-4">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <h1
                            class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 drop-shadow-lg flex items-center gap-2">
                            <i class="fas fa-id-badge animate-bounce text-indigo-400"></i>
                            {{ $user->name }}
                        </h1>
                    </div>

                    <!-- ID (readonly) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-1">ID</label>
                        <input type="text" value="{{ $user->id }}" readonly
                            class="w-full border-2 border-indigo-200 rounded-xl px-4 py-2 bg-gray-100 font-semibold shadow-inner">
                    </div>

                    <!-- Name (readonly) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-1">Tên</label>
                        <input type="text" value="{{ $user->name }}" readonly
                            class="w-full border-2 border-indigo-200 rounded-xl px-4 py-2 bg-gray-100 font-semibold shadow-inner">
                    </div>

                    <!-- Email (readonly) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-1">Email</label>
                        <input type="email" value="{{ $user->email }}" readonly
                            class="w-full border-2 border-indigo-200 rounded-xl px-4 py-2 bg-gray-100 font-semibold shadow-inner">
                    </div>

                    <!-- Role (editable) -->
                    <div class="mb-8">
                        <label class="block text-gray-700 font-bold mb-1">Vai trò</label>
                        <select name="role"
                            class="w-full border-2 border-indigo-200 rounded-xl px-4 py-2 bg-white font-semibold shadow-inner bg-gradient-to-r from-indigo-50 to-cyan-50 focus:ring-2 focus:ring-sky-400">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Người dùng</option>
                            <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Nhân viên</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                        </select>
                    </div>
                    <div class="flex justify-between mt-8">
                        <a href="{{ route('admin.users.index') }}"
                            class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit"
                            class="bg-gradient-to-r from-green-400 to-emerald-500 hover:from-emerald-500 hover:to-green-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                            <i class="fas fa-save"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
