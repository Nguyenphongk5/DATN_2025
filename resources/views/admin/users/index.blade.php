<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý người dùng') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="text-2xl font-semibold text-gray-800 text-center mb-8">
            {{ __('Danh sách người dùng') }}
        </h1>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Bộ lọc --}}
                   <form action="{{ route('admin.users.index') }}" method="GET" class="mb-4">
    <div class="flex items-center gap-2 bg-gray-50 border border-gray-200 rounded px-3 py-2 w-fit text-sm">
        <label for="role" class="mr-2 text-gray-600">Vai trò:</label>
        <select name="role" id="role"
            onchange="this.form.submit()"
            class="px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-400">
            <option value="">Tất cả</option>
            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Người dùng</option>
            <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Nhân viên</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Quản trị</option>
        </select>

        <button type="submit"
            class="ml-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
            Lọc
        </button>
    </div>
</form>
                    {{-- Bảng người dùng --}}
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">STT</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Họ tên</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Email</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Vai trò</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Ảnh đại diện</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-center text-sm">
                                @forelse ($users as $key => $user)
                                    <tr>
                                        <td class="px-6 py-4">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4">{{ $user->name }}</td>
                                        <td class="px-6 py-4">{{ $user->email }}</td>
                                        <td class="px-6 py-4 capitalize">
                                            @if ($user->role === 'user')
                                                <span class="text-green-600 font-medium">Người dùng</span>
                                            @elseif ($user->role === 'staff')
                                                <span class="text-blue-600 font-medium">Nhân viên</span>
                                            @else
                                                <span class="text-red-600 font-medium">Quản trị viên</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($user->avatar)
                                                <img src="{{ asset('storage/' . $user->avatar) }}"
                                                    alt="Avatar" class="w-12 h-12 rounded-full object-cover mx-auto">
                                            @else
                                                <span class="text-gray-400 italic">Chưa có</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('admin.users.show', $user->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                                    Xem
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                                    Sửa
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Bạn chắc chắn muốn xoá?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                                        Xoá
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">
                                            Không có người dùng nào.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Phân trang --}}
                        <div class="mt-6">
                            {{ $users->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
