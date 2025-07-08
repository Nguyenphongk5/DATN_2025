<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Quản lý bình luận') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Thông báo -->
            @if (session('success'))
                <div
                    class="mb-6 flex items-center gap-3 p-4 rounded-xl bg-green-50 text-green-800 border border-green-200 shadow">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Thống kê + Filter sticky -->
            <div class="sticky top-0 z-10 bg-gray-50 pb-4 mb-6 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-2">
                    <div class="flex flex-wrap gap-4 items-center">
                        <span class="text-lg font-bold text-purple-700">Tổng: {{ $total }}</span>
                        <span class="text-green-700 font-semibold">Hiện: {{ $active }}</span>
                        <span class="text-gray-500 font-semibold">Ẩn: {{ $inactive }}</span>
                    </div>
                    <form method="GET" class="flex flex-wrap gap-2 items-end">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Người dùng</label>
                            <select name="user_id" class="rounded-lg border-gray-300 focus:ring-purple-400">
                                <option value="">Tất cả</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @selected(($filter['user_id'] ?? '') == $user->id)>
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Sản phẩm</label>
                            <select name="product_id" class="rounded-lg border-gray-300 focus:ring-purple-400">
                                <option value="">Tất cả</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" @selected(($filter['product_id'] ?? '') == $product->id)>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Trạng thái</label>
                            <select name="is_active" class="rounded-lg border-gray-300 focus:ring-purple-400">
                                <option value="">Tất cả</option>
                                <option value="1" @selected(($filter['is_active'] ?? '') === '1')>Hiện</option>
                                <option value="0" @selected(($filter['is_active'] ?? '') === '0')>Ẩn</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Nội dung</label>
                            <input type="text" name="content" value="{{ $filter['content'] ?? '' }}"
                                class="rounded-lg border-gray-300 focus:ring-purple-400" placeholder="Tìm nội dung...">
                        </div>
                        <button
                            class="ml-2 px-4 py-2 rounded-lg bg-purple-600 text-white font-semibold hover:bg-purple-700 transition">Lọc</button>
                    </form>
                </div>
            </div>

            <!-- Danh sách bình luận cha -->
            <div class="space-y-10">
                @forelse ($comments as $comment)
                    <div
                        class="relative flex gap-6 group bg-white rounded-2xl shadow-xl border border-gray-100 p-8 hover:shadow-2xl transition-shadow">
                        <!-- Avatar -->
                        <div class="flex flex-col items-center">
                            <img src="{{ $comment->image ? asset('storage/' . $comment->image) : asset('images/default-avatar.png') }}"
                                alt="Ảnh"
                                class="w-20 h-20 rounded-full object-cover border-4 border-purple-300 shadow-lg group-hover:scale-105 transition-transform">
                            <span class="block mt-2 text-xs text-gray-400">ID: {{ $comment->id }}</span>
                        </div>
                        <!-- Card -->
                        <div class="flex-1">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-2">
                                <div>
                                    <span
                                        class="font-bold text-lg text-purple-800">{{ $comment->user->name ?? 'N/A' }}</span>
                                    <span class="ml-2 text-sm text-gray-500">{{ $comment->product->name ?? 'N/A' }}</span>
                                </div>
                                <div class="text-xs text-gray-400">{{ $comment->created_at->format('d/m/Y H:i') }}</div>
                            </div>
                            <div class="flex items-center gap-1 mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 {{ $i <= $comment->rating ? 'text-yellow-400' : 'text-gray-200' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <div class="text-gray-700 text-base mb-4 whitespace-pre-line">{{ $comment->content ?? '-' }}
                            </div>
                            <div class="flex flex-wrap gap-3 mb-4">
                                <form method="POST" action="{{ route('admin.comments.toggle', $comment->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="flex items-center gap-1 px-4 py-1 rounded-full text-xs font-semibold border focus:outline-none focus:ring-2 focus:ring-purple-300 transition {{ $comment->is_active ? 'bg-green-100 text-green-700 border-green-300 hover:bg-green-200' : 'bg-gray-100 text-gray-600 border-gray-300 hover:bg-gray-200' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ $comment->is_active ? 'Ẩn' : 'Hiện' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.comments.destroy', $comment->id) }}"
                                    class="delete-comment-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="flex items-center gap-1 px-4 py-1 rounded-full bg-red-500 text-white text-xs font-semibold hover:bg-red-600 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Xoá
                                    </button>
                                </form>
                            </div>
                            <!-- Nút thu gọn/mở rộng phản hồi -->
                            <div x-data="{ open: false }" class="mb-2">
                                <button @click="open = !open"
                                    class="text-blue-600 hover:underline text-sm font-semibold flex items-center gap-1">
                                    <svg :class="{'rotate-90': open}" class="w-4 h-4 transition-transform inline-block"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    <span
                                        x-text="open ? 'Ẩn phản hồi' : 'Xem phản hồi (' + {{ $comment->replies->count() }} + ')' "></span>
                                </button>
                                <div x-show="open" x-transition class="mt-3 space-y-4">
                                    @forelse ($comment->replies as $reply)
                                        <div class="ml-8 border-l-4 border-blue-400 bg-blue-50 rounded-xl p-5 flex gap-4">
                                            <img src="{{ $reply->image ? asset('storage/' . $reply->image) : asset('images/default-avatar.png') }}"
                                                alt="Ảnh" class="w-12 h-12 rounded-full object-cover border-2 border-blue-200">
                                            <div class="flex-1">
                                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                                                    <span
                                                        class="font-semibold text-blue-800">{{ $reply->user->name ?? 'N/A' }}</span>
                                                    <span
                                                        class="text-xs text-gray-400">{{ $reply->created_at->format('d/m/Y H:i') }}</span>
                                                </div>
                                                <div class="text-gray-700 text-base mb-2 whitespace-pre-line">
                                                    {{ $reply->content ?? '-' }}</div>
                                                @if ($reply->image)
                                                    <img src="{{ asset('storage/' . $reply->image) }}" alt="Ảnh"
                                                        class="rounded mt-2 max-w-[100px] border border-gray-200">
                                                @endif
                                                <div class="flex gap-2 mt-2">
                                                    <form method="POST"
                                                        action="{{ route('admin.comments.toggle', $reply->id) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold border focus:outline-none focus:ring-2 focus:ring-blue-300 transition {{ $reply->is_active ? 'bg-green-100 text-green-700 border-green-300 hover:bg-green-200' : 'bg-gray-100 text-gray-600 border-gray-300 hover:bg-gray-200' }}">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                            {{ $reply->is_active ? 'Ẩn' : 'Hiện' }}
                                                        </button>
                                                    </form>
                                                    <form method="POST"
                                                        action="{{ route('admin.comments.destroy', $reply->id) }}"
                                                        class="delete-comment-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="flex items-center gap-1 px-3 py-1 rounded-full bg-red-500 text-white text-xs font-semibold hover:bg-red-600 transition">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                            Xoá
                                                        </button>
                                                    </form>
                                                    <!-- Nút trả lời reply -->
                                                    <div x-data="{ replyOpen: false }">
                                                        <button @click="replyOpen = !replyOpen" type="button"
                                                            class="ml-2 text-blue-500 hover:underline text-xs font-semibold">Trả
                                                            lời</button>
                                                        <form x-show="replyOpen" x-transition method="POST"
                                                            action="{{ route('admin.comments.index') }}" class="mt-2 space-y-2">
                                                            @csrf
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $reply->product_id }}">
                                                            <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                                                            <textarea name="content"
                                                                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200"
                                                                rows="2" placeholder="Phản hồi tiếp..."></textarea>
                                                            <button
                                                                class="px-4 py-1 rounded-full bg-blue-500 text-white text-xs font-semibold hover:bg-blue-600 transition flex items-center gap-1">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                                </svg>
                                                                Gửi phản hồi
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="ml-8 text-gray-400 italic">Chưa có phản hồi nào.</div>
                                    @endforelse
                                    <!-- Form trả lời bình luận cha -->
                                    <div x-data="{ replyOpen: false }" class="ml-8 mt-4">
                                        <button @click="replyOpen = !replyOpen" type="button"
                                            class="text-blue-500 hover:underline text-sm font-semibold">Trả lời bình luận
                                            này</button>
                                        <form x-show="replyOpen" x-transition method="POST"
                                            action="{{ route('admin.comments.index') }}" class="mt-2 space-y-2">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $comment->product_id }}">
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                            <textarea name="content"
                                                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400"
                                                rows="2" placeholder="Phản hồi người dùng..."></textarea>
                                            <button
                                                class="px-4 py-1 rounded-full bg-purple-600 text-white text-xs font-semibold hover:bg-purple-700 transition flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                                Gửi phản hồi
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-10">Không có bình luận nào phù hợp.</div>
                @endforelse
            </div>

            <!-- Phân trang -->
            <div class="mt-10 flex justify-center">
                {{ $comments->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('form[action*="admin.comments.toggle"]').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const formData = new FormData(form);
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                        .then(response => {
                            if (!response.ok) throw new Error('Lỗi mạng!');
                            return response.text();
                        })
                        .then(() => {
                            const button = form.querySelector('button');
                            const isActive = button.classList.contains('bg-green-100');
                            button.classList.toggle('bg-green-100', !isActive);
                            button.classList.toggle('text-green-700', !isActive);
                            button.classList.toggle('border-green-300', !isActive);
                            button.classList.toggle('hover:bg-green-200', !isActive);
                            button.classList.toggle('bg-gray-100', isActive);
                            button.classList.toggle('text-gray-600', isActive);
                            button.classList.toggle('border-gray-300', isActive);
                            button.classList.toggle('hover:bg-gray-200', isActive);
                            button.textContent = isActive ? 'Hiện' : 'Ẩn';
                        })
                        .catch(error => {
                            alert('Có lỗi xảy ra: ' + error.message);
                        });
                });
            });
            document.querySelectorAll('form.delete-comment-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    if (!confirm('Bạn có chắc chắn muốn xoá bình luận này không?')) return;
                    const formData = new FormData(form);
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                        .then(response => {
                            if (!response.ok) throw new Error('Lỗi mạng!');
                            form.closest('.group, .mt-6').remove();
                        })
                        .catch(error => {
                            alert('Lỗi khi xoá bình luận: ' + error.message);
                        });
                });
            });
        });
    </script>
</x-app-layout>
