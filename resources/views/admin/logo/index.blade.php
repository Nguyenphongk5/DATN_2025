<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-image text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Quản lý Logo</h2>
        </div>
    </x-slot>
    <div class="py-8">
        <h1
            class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 text-center mb-8 drop-shadow-lg flex items-center justify-center gap-3">
            <i class="fas fa-images animate-bounce text-indigo-400"></i>
            Danh sách Logo
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.logos.create') }}"
                        class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-2 px-6 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-plus"></i> Thêm Logo
                    </a>
                </div>
                <div class="overflow-x-auto custom-scrollbar rounded-2xl">
                    <table class="w-full table-auto border-collapse shadow-xl rounded-2xl overflow-hidden">
                        <thead class="bg-gradient-to-r from-indigo-100 via-sky-100 to-cyan-100 text-indigo-700">
                            <tr>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">STT</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Hình ảnh</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Tên logo</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Trạng thái</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-indigo-100 text-center text-lg">
                            @foreach ($logos as $key => $logo)
                                <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-cyan-50 transition">
                                    <td class="px-6 py-4 font-bold">{{ $key + 1 }}</td>
                                    <td class="px-6 py-4 flex justify-center">
                                        <img src="{{ asset('storage/' . $logo->image) }}" alt="Logo"
                                            class="h-12 w-12 object-contain rounded-xl shadow border border-indigo-100">
                                    </td>
                                    <td class="px-6 py-4 font-semibold">{{ $logo->name }}</td>
                                    <td class="px-6 py-4">
                                        @if ($logo->is_active == '1')
                                            <span
                                                class="inline-block px-4 py-1 rounded-full bg-gradient-to-r from-green-400 to-cyan-400 text-white font-bold shadow">Đang
                                                sử dụng</span>
                                        @else
                                            <span
                                                class="inline-block px-4 py-1 rounded-full bg-gradient-to-r from-gray-400 to-gray-600 text-white font-bold shadow">Ẩn</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2 justify-center">
                                            <a href="{{ route('admin.logos.edit', $logo->id) }}"
                                                class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-2 px-4 rounded-xl shadow-lg flex items-center gap-2 transition">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (isset($logos) && $logos->hasPages())
                        <div class="mt-8 flex justify-center">
                            {{ $logos->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
