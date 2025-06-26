<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý bình luận') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow rounded-lg">
                @if (session('success'))
                    <div class="alert alert-success mb-3">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-striped table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Người dùng</th>
                            <th>Sản phẩm</th>
                            <th>Nội dung</th>
                            <th>Đánh giá</th>
                            <th>Ảnh</th>
                            <th>Trạng thái</th>
                            <th>Ngày</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($comments as $comment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $comment->user->name ?? 'N/A' }}</td>
                                <td>{{ $comment->product->name ?? 'N/A' }}</td>
                                <td class="text-start">{{ $comment->content ?? '-' }}</td>
                                <td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $comment->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                                    @endfor
                                </td>
                                <td>
                                    @if ($comment->image)
                                        <img src="{{ asset('storage/' . $comment->image) }}" alt="Ảnh" width="50" height="50" class="rounded">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $comment->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $comment->is_active ? 'Hiện' : 'Ẩn' }}
                                    </span>
                                </td>
                                <td>{{ $comment->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <form method="POST" action="{{ route('comments.toggle', $comment->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                                {{ $comment->is_active ? 'Ẩn' : 'Hiện' }}
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" onsubmit="return confirm('Bạn có chắc chắn muốn xoá bình luận này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">Không có bình luận nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Nếu dùng paginate --}}
                {{-- <div class="mt-3">{{ $comments->links() }}</div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
