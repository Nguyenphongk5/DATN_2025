<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-copyright text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Quản lý thương hiệu</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <h1
            class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 text-center mb-8 drop-shadow-lg flex items-center justify-center gap-3">
            <i class="fas fa-copyright animate-bounce text-indigo-400"></i>
            Danh sách thương hiệu
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-6">
                <!-- Bộ lọc -->
                <form action="{{ route('admin.brands.index') }}" method="GET"
                    class="mb-6 flex flex-wrap gap-4 items-center bg-gradient-to-r from-indigo-50 via-sky-50 to-cyan-50 border border-indigo-200 rounded-xl px-4 py-3 w-fit text-base shadow">
                    <i class="fas fa-filter text-indigo-400 text-lg"></i>
                    <input type="text" name="keyword" value="{{ request('keyword') }}"
                        placeholder="Tìm kiếm tên thương hiệu..."
                        class="border border-indigo-200 rounded-lg px-3 py-2 bg-white/80 focus:ring-2 focus:ring-sky-400" />
                    <select name="is_active" id="statusFilter"
                        class="border border-indigo-200 rounded-lg px-3 py-2 bg-white/80 focus:ring-2 focus:ring-sky-400">
                        <option value="1&&0">Tất cả trạng thái</option>
                        <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Đang hoạt động
                        </option>
                        <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Đã ẩn</option>
                    </select>
                    <button type="submit"
                        class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white px-4 py-2 rounded-lg font-bold shadow-md flex items-center gap-2 transition">
                        <i class="fas fa-search"></i> Lọc
                    </button>
                    <a href="{{ route('admin.brands.create') }}"
                        class="bg-gradient-to-r from-green-400 to-emerald-500 hover:from-emerald-500 hover:to-green-400 text-white px-4 py-2 rounded-lg font-bold shadow-md flex items-center gap-2 transition">
                        <i class="fas fa-plus"></i> Thêm thương hiệu mới
                    </a>
                </form>

                <div class="overflow-x-auto custom-scrollbar rounded-2xl">
                    <table class="w-full table-auto border-collapse shadow-xl rounded-2xl overflow-hidden">
                        <thead class="bg-gradient-to-r from-indigo-100 via-sky-100 to-cyan-100 text-indigo-700">
                            <tr>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">STT</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Logo</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Tên thương hiệu</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Mô tả</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Trạng thái</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-indigo-100 text-center text-base">
                            @foreach ($brands as $key => $brand)
                                <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-cyan-50 transition">
                                    <td class="px-6 py-4 font-bold text-indigo-500">{{ $key + 1 }}</td>
                                    <td class="px-6 py-4">
                                        @if ($brand->logo)
                                            <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}"
                                                class="w-16 h-16 object-cover rounded-full mx-auto ring-4 ring-sky-300 shadow-lg">
                                        @else
                                            <div
                                                class="w-16 h-16 bg-gray-200 rounded-full mx-auto flex items-center justify-center">
                                                <span class="text-gray-400 text-xs">No Image</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $brand->name }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $brand->description ?? '-' }}</td>
                                  <td class="px-6 py-4">
    <div class="flex items-center h-full">
        @if ($brand->is_active == 1)
            <span
                class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-green-300 via-emerald-400 to-cyan-300 text-green-900 shadow ring-2 ring-green-200/60">
                Đang hoạt động
            </span>
        @else
            <span
                class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-red-300 via-pink-400 to-fuchsia-300 text-red-900 shadow ring-2 ring-pink-200/60">
                Đã ẩn
            </span>
        @endif
    </div>
</td>

                                    <td class="px-6 py-4">
                                        <div class="flex gap-2 justify-center">
                                            <a href="{{ route('admin.brands.show', $brand->id) }}"
                                                class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white px-4 py-2 rounded-lg font-bold shadow-md flex items-center gap-2 transition">
                                                <i class="fas fa-eye"></i> Chi tiết
                                            </a>
                                            <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                                class="bg-gradient-to-r from-yellow-400 to-pink-500 hover:from-pink-500 hover:to-yellow-400 text-white px-4 py-2 rounded-lg font-bold shadow-md flex items-center gap-2 transition">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Phân trang -->
                    @if (isset($brands) && $brands->hasPages())
                        <div class="mt-8 flex justify-center">
                            {{ $brands->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
