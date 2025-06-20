<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý bài viết') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <h1 class="font-semibold text-gray-800 leading-tight" style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Danh sách bài viết') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto" >
                        <!-- Bộ lọc -->
                        <form action="{{ route('blogs.index') }}" method="GET" class="mb-6">
                            <div class="flex flex-wrap gap-4 items-center">
                                 <select name="user_id" id="categoryFilter" class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                {{--<select name="blog" id="brandFilter" class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả thương hiệu</option>
                                    @foreach($blogs as $blog)
                                        <option value="{{ $blog->id }}" {{ request('blog') == $blog->id ? 'selected' : '' }}>
                                            {{ $blog->name }}
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
                                <a href="{{ route('blogs.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded btn btn-primary">
                                    Thêm bài viết
                                </a>
                            </div>
                        </form>

                        <table class="w-full table-auto border-collapse">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">STT</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Title</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Slug</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Image</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Short Description</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Author Name</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Status</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-center">
                                @foreach ($blogs as $key => $blog)
                                    <tr>
                                        <td class="px-6 py-4">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4">
                                                <p class="font-medium text-gray-900">{{ $blog->title }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-gray-600">{{ $blog->slug }}</p>
                                        <td class="px-6 py-4">
                                            @if ($blog->img_avt)
                                                <img src="{{ asset('storage/' . $blog->img_avt) }}"
                                                     alt="{{ $blog->title }}"
                                                     class="w-16 h-16 object-cover rounded mx-auto">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded mx-auto flex items-center justify-center">
                                                    <span class="text-gray-400 text-xs">No Image</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-gray-600">{{ $blog->short_description }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-gray-600">{{ $blog->author_name }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($blog->is_active === 1)
                                                <span class="text-green-600 font-semibold">Đang hoạt động</span>
                                            @else
                                                <span class="text-red-600 font-semibold">Đã ẩn</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex gap-2 justify-center">
                                                <a href="{{ route('blogs.show', $blog->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                                    Chi tiết
                                                </a>
                                                <a href="{{ route('blogs.edit', $blog->id) }}"
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
                        @if(isset($blogs) && $blogs->hasPages())
                            <div class="mt-6">
                                {{ $blogs->links('pagination::tailwind') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
