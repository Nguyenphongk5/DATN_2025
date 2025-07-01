<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý logo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="font-semibold text-gray-800 leading-tight"
            style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Danh sách logo') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <!-- Bộ lọc -->
                        <form action="{{ route('admin.logos.index') }}" method="GET" class="mb-6">
                            <div class="flex flex-wrap gap-4 items-center">
                                {{-- <select name="category" id="categoryFilter"
                                    class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="brand" id="brandFilter"
                                    class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả thương hiệu</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select> --}}
                                <select name="status" id="statusFilter"
                                    class="border border-gray-300 rounded px-3 py-2">
                                    <option value="1&&0">Tất cả trạng thái</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đang hoạt
                                        động</option>
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Đã ẩn
                                    </option>
                                </select>
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                    Lọc
                                </button>
                                <a href="{{ route('admin.logos.create') }}"
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded btn btn-primary">
                                    Thêm logo mới
                                </a>
                            </div>
                        </form>

                        <table class="w-full table-auto border-collapse">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">STT</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Hình ảnh</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Tên Logo</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Trạng thái</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-center">
                                @foreach ($logos as $key => $logo)
                                    <tr>
                                        <td class="px-6 py-4">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4">
                                            @if ($logo->img_thumb)
                                                <img src="{{ asset('storage/' . $logo->img_thumb) }}"
                                                    alt="{{ $logo->name }}"
                                                    class="w-16 h-16 object-cover rounded mx-auto">
                                            @else
                                                <div
                                                    class="w-16 h-16 bg-gray-200 rounded mx-auto flex items-center justify-center">
                                                    <span class="text-gray-400 text-xs">No Image</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="max-w-xs">
                                                <p class="font-medium text-gray-900">{{ $logo->name }}</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{-- @if ($logo->brand_is_active == 1 && $logo->cate_is_active == 1) --}}
                                                @if ($logo->is_active == 1)
                                                    <span
                                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                        Đang hoạt động
                                                    </span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                        Đã ẩn
                                                    </span>
                                                @endif
                                            {{-- @else
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    Đã ẩn
                                                </span>
                                            @endif --}}

                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2 justify-center">
                                                <a href="{{ route('admin.logos.show', $logo->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                                    Chi tiết
                                                </a>
                                                <a href="{{ route('admin.logos.edit', $logo->id) }}"
                                                    class="bg-yellow-500 btn btn-primary hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                                    Sửa
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Phân trang -->
                        @if (isset($logos) && $logos->hasPages())
                            <div class="mt-6">
                                {{ $logos->links('pagination::tailwind') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
