<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="font-semibold text-gray-800 leading-tight"
            style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Update User') }}
        </h1>
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- ID (readonly) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">ID</label>
                        <input type="text" value="{{ $user->id }}" readonly
                            class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100">
                    </div>

                    <!-- Name (readonly) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Name</label>
                        <input type="text" value="{{ $user->name }}" readonly
                            class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100">
                    </div>

                    <!-- Email (readonly) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" value="{{ $user->email }}" readonly
                            class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100">
                    </div>

                    <!-- Avatar (readonly - hiển thị ảnh) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Avatar</label>
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                class="w-20 h-20 rounded-full object-cover">
                        @else
                            <p class="text-gray-400 italic">No avatar</p>
                        @endif
                    </div>

                    <!-- Role (editable) -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-1">Role</label>
                        <select name="role" class="w-full border border-gray-300 rounded px-4 py-2">
                            <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Người Dùng</option>
                            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Nhân Viên</option>
                            <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Quản Trị Viên</option>
                        </select>
                    </div>
                    <div class="flex">
                        <div class="flex justify-start" style="margin-right: 35rem">
                            <a href="{{ route('users.index') }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded mr-2 btn btn-secondary">
                               Back
                            </a>
                        </div>
                        <!-- Submit -->
                        <div class="flex justify-center">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded btn"
                                style="background: rgb(26, 227, 73)">
                                Cập nhật
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
