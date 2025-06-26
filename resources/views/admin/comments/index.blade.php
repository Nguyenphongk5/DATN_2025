<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý bình luận') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                @if (session('success'))
                    <div class="alert alert-success mb-3">{{ session('success') }}</div>
                @endif

                @foreach ($comments->where('parent_id', null) as $comment)
                    <!-- Bình luận gốc -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-3">
                                <div class="flex-shrink-0">
                                    <img src="{{ $comment->image ? asset('storage/' . $comment->image) : asset('images/default-avatar.png') }}"
                                        alt="Ảnh" width="70" height="70" class="rounded">
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <strong>{{ $comment->user->name ?? 'N/A' }}</strong> -
                                            {{ $comment->product->name ?? 'N/A' }}
                                            <div class="text-muted small">
                                                {{ $comment->created_at->format('d/m/Y H:i') }}</div>
                                        </div>
                                        <form method="POST" action="{{ route('comments.toggle', $comment->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm {{ $comment->is_active ? 'btn-success' : 'btn-secondary' }}">
                                                {{ $comment->is_active ? 'Ẩn' : 'Hiện' }}
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mt-2">
                                        {{ $comment->content ?? '-' }}
                                    </div>
                                    <div class="my-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="bi {{ $i <= $comment->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                                        @endfor
                                    </div>
                                    <div class="d-flex gap-2 mt-3">
                                        <form method="POST" action="{{ route('comments.destroy', $comment->id) }}"
                                            class="delete-comment-form d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                        </form>
                                    </div>

                                    <!-- Form trả lời -->
                                    <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $comment->product_id }}">
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <textarea name="content" class="form-control mb-2" rows="2" placeholder="Phản hồi người dùng..."></textarea>
                                        <button class="btn btn-sm btn-success">Trả lời</button>
                                    </form>

                                    <!-- Các phản hồi -->
                                    @foreach ($comments->where('parent_id', $comment->id) as $reply)
                                        <div class="card mt-3 ms-4 border-start border-3 border-primary">
                                            <div class="card-body bg-light">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <strong>{{ $reply->user->name ?? 'N/A' }}</strong>
                                                        <div class="text-muted small">
                                                            {{ $reply->created_at->format('d/m/Y H:i') }}</div>
                                                    </div>
                                                    <form method="POST"
                                                        action="{{ route('comments.toggle', $reply->id) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="btn btn-sm {{ $reply->is_active ? 'btn-success' : 'btn-secondary' }}">
                                                            {{ $reply->is_active ? 'Ẩn' : 'Hiện' }}
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="mt-2">{{ $reply->content ?? '-' }}</div>
                                                @if ($reply->image)
                                                    <img src="{{ asset('storage/' . $reply->image) }}" alt="Ảnh"
                                                        width="100" class="img-thumbnail mt-2">
                                                @endif

                                                <div class="d-flex gap-2 mt-3">
                                                    <form method="POST"
                                                        action="{{ route('comments.destroy', $reply->id) }}"
                                                        class="delete-comment-form d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger">Xoá</button>
                                                    </form>
                                                </div>

                                                <!-- Form trả lời tiếp -->
                                                <form action="{{ route('comments.store') }}" method="POST"
                                                    class="mt-3">
                                                    @csrf
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $reply->product_id }}">
                                                    <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                                                    <textarea name="content" class="form-control mb-2" rows="2" placeholder="Phản hồi tiếp..."></textarea>
                                                    <button class="btn btn-sm btn-secondary">Phản hồi</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Script xử lý AJAX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý form ẩn/hiện
            document.querySelectorAll('form[action*="comments.toggle"]').forEach(form => {
                form.addEventListener('submit', function(e) {
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
                            const isActive = button.classList.contains('btn-success');
                            button.classList.toggle('btn-success', !isActive);
                            button.classList.toggle('btn-secondary', isActive);
                            button.textContent = isActive ? 'Hiện' : 'Ẩn';
                        })
                        .catch(error => {
                            alert('Có lỗi xảy ra: ' + error.message);
                        });
                });
            });

            // Xử lý form xoá
            document.querySelectorAll('form.delete-comment-form').forEach(form => {
                form.addEventListener('submit', function(e) {
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
                            form.closest('.card').remove();
                        })
                        .catch(error => {
                            alert('Lỗi khi xoá bình luận: ' + error.message);
                        });
                });
            });
        });
    </script>
</x-app-layout>
