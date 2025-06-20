<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý thương hiệu') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <h1 class="font-semibold text-gray-800 leading-tight" style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Danh sách thương hiệu') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto" >
                        <!-- Bộ lọc -->
                        <form action="{{ route('brands.index') }}" method="GET" class="mb-6">
                            <div class="flex flex-wrap gap-4 items-center">
                                {{-- <select name="category" id="categoryFilter" class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả danh mục</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="brand" id="brandFilter" class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả thương hiệu</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select> --}}
                                <select name="status" id="statusFilter" class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đang hoạt động</option>
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Đã ẩn</option>
                                </select>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                    Lọc
                                </button>
                                <a href="{{ route('brands.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded btn btn-primary">
                                    Thêm thương hiệu
                                </a>
                            </div>
                        </form>

                        <table class="w-full table-auto border-collapse">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">STT</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Name</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Slug</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Logo</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Status</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-center">
                                @foreach ($brands as $key => $brand)
                                    <tr>
                                        <td class="px-6 py-4">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4">
                                                <p class="font-medium text-gray-900">{{ $brand->name }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-gray-600">{{ $brand->slug }}</p>
                                        <td class="px-6 py-4">
                                            @if ($brand->logo)
                                                <img src="{{ asset('storage/' . $brand->logo) }}"
                                                     alt="{{ $brand->name }}"
                                                     class="w-16 h-16 object-cover rounded mx-auto">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded mx-auto flex items-center justify-center">
                                                    <span class="text-gray-400 text-xs">No Image</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($brand->is_active === 1)
                                                <span class="text-green-600 font-semibold">Đang hoạt động</span>
                                            @else
                                                <span class="text-red-600 font-semibold">Đã ẩn</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex gap-2 justify-center">
                                                <a href="{{ route('brands.show', $brand->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                                    Chi tiết
                                                </a>
                                                <a href="{{ route('brands.edit', $brand->id) }}"
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
                        @if(isset($brands) && $brands->hasPages())
                            <div class="mt-6">
                                {{ $brands->links('pagination::tailwind') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
