<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-user text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Chi tiết người dùng</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
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
                <div class="overflow-x-auto custom-scrollbar rounded-2xl">
                    <table class="w-full table-auto border-collapse shadow-xl rounded-2xl overflow-hidden text-base">
                        <thead class="bg-gradient-to-r from-indigo-100 via-sky-100 to-cyan-100 text-indigo-700">
                            <tr>
                                <th class="px-6 py-3 text-left font-bold uppercase">ID</th>
                                <th class="px-6 py-3 text-left font-bold uppercase">Tên</th>
                                <th class="px-6 py-3 text-left font-bold uppercase">Email</th>
                                <th class="px-6 py-3 text-left font-bold uppercase">Vai trò</th>
                                <th class="px-6 py-3 text-left font-bold uppercase">Ảnh đại diện</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-indigo-100 text-center">
                            <tr>
                                <td class="px-6 py-4 font-bold text-indigo-500">{{ $user->id }}</td>
                                <td class="px-6 py-4 font-semibold flex items-center gap-2 justify-center">
                                    <i class="fas fa-user-circle text-sky-400"></i> {{ $user->name }}
                                </td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4 capitalize">
                                    @if ($user->role === 'user' || $user->role == 0)
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-green-100 text-green-700 font-bold shadow"><i
                                                class="fas fa-user"></i> Người dùng</span>
                                    @elseif ($user->role === 'staff' || $user->role == 1)
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
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-8 flex justify-center">
                    <a href="{{ route('admin.users.index') }}"
                        class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
