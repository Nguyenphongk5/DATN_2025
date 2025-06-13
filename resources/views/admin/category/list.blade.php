<x-app-layout>
    {{-- <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot> --}}
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-100 border-r border-gray-200 p-6">
            <nav class="space-y-2">
                <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-gray-300">
                    <!-- Product Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 7v4a1 1 0 001 1h3m10-5v4a1 1 0 01-1 1h-3m-7 6h6m-6 0v2a1 1 0 001 1h4a1 1 0 001-1v-2m-6 0h6" />
                    </svg>
                    Product
                </a>

                <a href="{{ route('admin.category.listCategory') }}"
                    class="flex items-center gap-2 py-2 px-4 rounded hover:bg-gray-300">
                    <!-- Category Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Category
                </a>

                <!-- User with dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center gap-2 w-full py-2 px-4 rounded hover:bg-gray-300 focus:outline-none">
                        <!-- User Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A9 9 0 1118.88 6.195M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        User Management
                        <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'rotate-180': open }"
                            class="ml-auto h-4 w-4 text-gray-600 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="absolute left-0 mt-1 w-full bg-white border border-gray-300 rounded shadow-md z-10"
                        style="display: none;">
                        <a href="{{ route('admin.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Users List
                        </a>
                        <!-- Bạn có thể thêm link khác ở đây -->
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="d-flex justify-content-between align-content-center">
                    <h1>Danh sách danh mục</h1>
                    <a href="{{ route('admin.category.createCategory') }}" class="btn btn-outline-success">Thêm mới</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Thuộc Loại</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->parent ? $value->parent->name : 'Không có' }}</td>
                                <td>
                                    {!! $value->is_active ? '<p class="text-success">Kích hoạt</p>' : '<p class="text-danger">Ngưng hoạt động</p>' !!}
                                </td>
                                <td>
                                    <a href="{{ route('admin.category.editCategory', $value->id) }}"
                                        class="btn btn-outline-warning">Sửa</a>

                                    <a href="{{ route('admin.category.deleteCategory', $value->id) }}"
                                        onclick="return confirm('Bạn có chắc muốn xóa ?')"
                                        class="btn btn-outline-danger">Xóa</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $category->links() }}
            </div>
        </main>
    </div>

    <!-- Alpine.js (cần để chạy dropdown) -->
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
