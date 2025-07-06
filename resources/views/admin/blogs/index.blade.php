<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-blog text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Quản lý bài viết</h2>
        </div>
    </x-slot>
    <div class="py-8">
        <h1
            class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 drop-shadow-lg flex items-center gap-2 mb-8 justify-center">
            <i class="fas fa-list-alt animate-bounce text-indigo-400"></i>
            Danh sách bài viết
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <div class="flex flex-wrap gap-4 items-end mb-8">
                    <form action="{{ route('admin.blogs.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                        <select name="user_id" id="categoryFilter"
                            class="border border-indigo-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-sky-400 shadow">
                            <option value="">Tất cả User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        <select name="is_active" id="statusFilter"
                            class="border border-indigo-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-sky-400 shadow">
                            <option value="1&&0">Tất cả trạng thái</option>
                            <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Đang hoạt động</option>
                            <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Đã ẩn</option>
                        </select>
                        <button type="submit"
                            class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold px-6 py-2 rounded-xl shadow-lg flex items-center gap-2 transition">
                            <i class="fas fa-filter"></i> Lọc
                        </button>
                    </form>
                    <a href="{{ route('admin.blogs.create') }}"
                        class="bg-gradient-to-r from-green-400 to-cyan-400 hover:from-cyan-400 hover:to-green-400 text-white font-bold px-6 py-2 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-plus-circle"></i> Thêm bài viết
                    </a>
                </div>
                <div class="overflow-x-auto custom-scrollbar rounded-2xl">
                    <table class="w-full table-auto border-collapse shadow-xl rounded-2xl overflow-hidden">
                        <thead class="bg-gradient-to-r from-indigo-100 via-sky-100 to-cyan-100 text-indigo-700">
                            <tr>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">STT</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Tiêu đề</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Slug</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Hình ảnh</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Mô tả ngắn</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Tác giả</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Trạng thái</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-indigo-100 text-center text-lg">
                            @foreach ($blogs as $key => $blog)
                                <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-cyan-50 transition">
                                    <td class="px-6 py-4 font-bold">{{ $key + 1 }}</td>
                                    <td class="px-6 py-4 font-semibold text-indigo-700">{{ $blog->title }}</td>
                                    <td class="px-6 py-4 text-gray-500 font-mono">{{ $blog->slug }}</td>
                                    <td class="px-6 py-4">
                                        @if ($blog->img_avt)
                                            <img src="{{ asset('storage/' . $blog->img_avt) }}" alt="{{ $blog->title }}"
                                                class="w-16 h-16 object-cover rounded-xl shadow border border-indigo-100 mx-auto">
                                        @else
                                            <div
                                                class="w-16 h-16 bg-gray-200 rounded-xl mx-auto flex items-center justify-center">
                                                <span class="text-gray-400 text-xs">No Image</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $blog->short_description }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $blog->author_name }}</td>
                                    <td class="px-6 py-4">
                                        @if ($blog->is_active === 1)
                                            <span
                                                class="inline-block px-4 py-1 rounded-full bg-gradient-to-r from-green-400 to-cyan-400 text-white font-bold shadow text-sm">Đang
                                                hoạt động</span>
                                        @else
                                            <span
                                                class="inline-block px-4 py-1 rounded-full bg-gradient-to-r from-gray-400 to-gray-600 text-white font-bold shadow text-sm">Đã
                                                ẩn</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2 justify-center">
                                            <a href="{{ route('admin.blogs.show', $blog->id) }}"
                                                class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-2 px-5 rounded-xl shadow-lg flex items-center gap-2 transition">
                                                <i class="fas fa-eye"></i> Xem
                                            </a>
                                            <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                                class="bg-gradient-to-r from-yellow-400 to-pink-400 hover:from-pink-400 hover:to-yellow-400 text-white font-bold py-2 px-5 rounded-xl shadow-lg flex items-center gap-2 transition">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(isset($blogs) && $blogs->hasPages())
                        <div class="mt-8 flex justify-center">
                            {{ $blogs->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
