<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-users text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Quản lý người dùng</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <h1
            class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 text-center mb-8 drop-shadow-lg flex items-center justify-center gap-3">
            <i class="fas fa-address-book animate-bounce text-indigo-400"></i>
            Danh sách người dùng
        </h1>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-6">
                {{-- Bộ lọc --}}
                <form action="{{ route('admin.users.index') }}" method="GET"
                    class="mb-6 flex items-center gap-3 bg-gradient-to-r from-indigo-50 via-sky-50 to-cyan-50 border border-indigo-200 rounded-xl px-4 py-3 w-fit text-base shadow">
                    <i class="fas fa-filter text-indigo-400 text-lg"></i>
                    <label for="role" class="mr-2 text-gray-700 font-semibold">Vai trò:</label>
                    <select name="role" id="role" onchange="this.form.submit()"
                        class="px-3 py-2 border border-indigo-200 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-sky-400 bg-white/80">
                        <option value="">Tất cả</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Người dùng</option>
                        <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Nhân viên</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Quản trị</option>
                    </select>
                    <button type="submit"
                        class="ml-2 bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white px-4 py-2 rounded-lg font-bold shadow-md flex items-center gap-2 transition">
                        <i class="fas fa-search"></i> Lọc
                    </button>
                </form>
                {{-- Bảng người dùng --}}
                <div class="overflow-x-auto custom-scrollbar rounded-2xl">
                    <table class="w-full table-auto border-collapse shadow-xl rounded-2xl overflow-hidden">
                        <thead class="bg-gradient-to-r from-indigo-100 via-sky-100 to-cyan-100 text-indigo-700">
                            <tr>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">STT</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Họ tên</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Email</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Vai trò</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Ảnh đại diện</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-indigo-100 text-center text-base">
                            @forelse ($users as $key => $user)
                                <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-cyan-50 transition">
                                    <td class="px-6 py-4 font-bold text-indigo-500">{{ $key + 1 }}</td>
                                    <td class="px-6 py-4 font-semibold flex items-center gap-2 justify-center">
                                        <i class="fas fa-user-circle text-sky-400"></i> {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4 capitalize">
                                        @if ($user->role === 'user')
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-green-100 text-green-700 font-bold shadow"><i
                                                    class="fas fa-user"></i> Người dùng</span>
                                        @elseif ($user->role === 'staff')
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-bold shadow"><i
                                                    class="fas fa-user-tie"></i> Nhân viên</span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-100 text-red-700 font-bold shadow"><i
                                                    class="fas fa-user-shield"></i> Quản trị viên</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                                class="w-14 h-14 rounded-full object-cover mx-auto ring-4 ring-sky-300 shadow-lg">
                                        @else
                                            <span class="text-gray-400 italic">Chưa có</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('admin.users.show', $user->id) }}"
                                                class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white px-4 py-2 rounded-lg font-bold shadow-md flex items-center gap-2 transition">
                                                <i class="fas fa-eye"></i> Xem
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="bg-gradient-to-r from-yellow-400 to-pink-500 hover:from-pink-500 hover:to-yellow-400 text-white px-4 py-2 rounded-lg font-bold shadow-md flex items-center gap-2 transition">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Bạn chắc chắn muốn xoá?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-gradient-to-r from-pink-500 to-red-500 hover:from-red-500 hover:to-pink-500 text-white px-4 py-2 rounded-lg font-bold shadow-md flex items-center gap-2 transition">
                                                    <i class="fas fa-trash"></i> Xoá
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
                    <div class="mt-8 flex justify-center">
                        {{ $users->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
