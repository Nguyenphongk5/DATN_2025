@extends('layouts.app')

@section('title', 'Quản lý Ảnh Màu Sắc - ' . $product->name)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-images text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                                Quản lý Ảnh Màu Sắc
                            </h1>
                            <p class="text-gray-600">Quản lý ảnh sản phẩm cùng loại khác màu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-sm text-gray-500">
                        <span class="flex items-center gap-1">
                            <i class="fas fa-box text-purple-500"></i>
                            {{ $product->name }}
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="fas fa-palette text-blue-500"></i>
                            {{ $galleries->count() }} màu sắc
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="fas fa-eye text-green-500"></i>
                            {{ $galleries->where('is_active', 1)->count() }} đang hiển thị
                        </span>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.products.index') }}" 
                       class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl transition-all duration-200 font-medium">
                        <i class="fas fa-arrow-left"></i>
                        Quay lại
                    </a>
                    <a href="{{ route('admin.products.galleries.create', $product->id) }}" 
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-2 rounded-xl transition-all duration-200 font-medium shadow-lg hover:shadow-xl">
                        <i class="fas fa-plus"></i>
                        Thêm màu sắc mới
                    </a>
                </div>
            </div>
        </div>

        <!-- Notification Messages -->
        @if(session('success'))
            <div class="mb-6 transform transition-all duration-500 ease-out">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-2xl shadow-lg border border-green-400/30 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 transform transition-all duration-500 ease-out">
                <div class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-4 rounded-2xl shadow-lg border border-red-400/30 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Gallery Grid -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            @if($galleries->count() > 0)
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="gallery-grid">
                        @foreach($galleries as $gallery)
                            <div class="group relative bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-4 border border-gray-200 hover:border-purple-300 transition-all duration-300 shadow-lg hover:shadow-xl" data-id="{{ $gallery->id }}">
                                <!-- Drag Handle -->
                                <div class="absolute top-3 left-3 z-10 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div class="w-6 h-6 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center cursor-move shadow-lg">
                                        <i class="fas fa-grip-vertical text-gray-500 text-xs"></i>
                                    </div>
                                </div>
                                
                                <!-- Image Container -->
                                <div class="relative overflow-hidden rounded-xl bg-white shadow-inner">
                                    <img src="{{ asset('storage/product_galleries/' . $gallery->image) }}" 
                                         alt="{{ $gallery->alt_text ?? $product->name }}"
                                         class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                                    
                                    <!-- Overlay actions -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-end justify-center pb-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.products.galleries.edit', [$product->id, $gallery->id]) }}" 
                                               class="bg-white/90 backdrop-blur-sm text-gray-800 p-2 rounded-full hover:bg-white transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-110">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>
                                            <button onclick="toggleActive({{ $product->id }}, {{ $gallery->id }})" 
                                                    class="bg-white/90 backdrop-blur-sm text-gray-800 p-2 rounded-full hover:bg-white transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-110">
                                                <i class="fas fa-{{ $gallery->is_active ? 'eye' : 'eye-slash' }} text-sm"></i>
                                            </button>
                                            <button onclick="deleteGallery({{ $product->id }}, {{ $gallery->id }})" 
                                                    class="bg-red-500/90 backdrop-blur-sm text-white p-2 rounded-full hover:bg-red-600 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-110">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Sort order badge -->
                                    <div class="absolute top-3 right-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                        #{{ $gallery->sort_order }}
                                    </div>

                                    <!-- Status badge -->
                                    <div class="absolute bottom-3 left-3">
                                        @if($gallery->is_active)
                                            <span class="bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                                <i class="fas fa-eye mr-1"></i>Active
                                            </span>
                                        @else
                                            <span class="bg-gradient-to-r from-gray-500 to-gray-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                                <i class="fas fa-eye-slash mr-1"></i>Inactive
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Info Section -->
                                <div class="mt-4 space-y-2">
                                    <p class="text-sm font-medium text-gray-800 line-clamp-2">
                                        {{ $gallery->alt_text ?? 'Không có mô tả' }}
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span class="truncate">{{ $gallery->image }}</span>
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $gallery->created_at->format('d/m/Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    </div>
                    
                    <!-- Drag & Drop Instructions -->
                    <div class="mt-8 p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl border border-blue-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-hand-pointer text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Hướng dẫn sử dụng</h4>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-arrows-alt mr-1"></i>
                                    Kéo thả để sắp xếp thứ tự màu sắc
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-eye mr-1"></i>
                                    Click để ẩn/hiện màu sắc
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-edit mr-1"></i>
                                    Click để chỉnh sửa thông tin màu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-palette text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">Chưa có màu sắc nào</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">
                        Hãy thêm ảnh các màu sắc khác của sản phẩm để khách hàng có thể xem và lựa chọn
                    </p>
                    <a href="{{ route('admin.products.galleries.create', $product->id) }}" 
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-3 rounded-xl transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fas fa-plus"></i>
                        Thêm màu sắc đầu tiên
                    </a>
                </div>
            @endif
        </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Xác nhận xóa</h3>
                        <p class="text-sm text-gray-500">Hành động này không thể hoàn tác</p>
                    </div>
                </div>
                
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Bạn có chắc chắn muốn xóa ảnh này? Ảnh sẽ bị xóa vĩnh viễn khỏi hệ thống và không thể khôi phục.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <button onclick="closeDeleteModal()" 
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-3 rounded-xl transition-all duration-200 font-medium">
                        <i class="fas fa-times mr-2"></i>
                        Hủy bỏ
                    </button>
                    <button id="confirmDelete" 
                            class="flex-1 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-4 py-3 rounded-xl transition-all duration-200 font-medium shadow-lg hover:shadow-xl">
                        <i class="fas fa-trash mr-2"></i>
                        Xóa ảnh
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #8b5cf6, #ec4899);
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, #7c3aed, #db2777);
    }
    
    /* Animation for gallery items */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .gallery-item {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    .gallery-item:nth-child(1) { animation-delay: 0.1s; }
    .gallery-item:nth-child(2) { animation-delay: 0.2s; }
    .gallery-item:nth-child(3) { animation-delay: 0.3s; }
    .gallery-item:nth-child(4) { animation-delay: 0.4s; }
    .gallery-item:nth-child(5) { animation-delay: 0.5s; }
    .gallery-item:nth-child(6) { animation-delay: 0.6s; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
// Sortable functionality
const grid = document.getElementById('gallery-grid');
if (grid) {
    new Sortable(grid, {
        animation: 150,
        ghostClass: 'bg-blue-100',
        onEnd: function(evt) {
            const items = Array.from(grid.children).map(item => item.dataset.id);
            updateOrder({{ $product->id }}, items);
        }
    });
}

// Update order function
function updateOrder(productId, orders) {
    fetch(`/admin/products/${productId}/galleries/update-order`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ orders: orders })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload page to update sort order numbers
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi cập nhật thứ tự');
    });
}

// Toggle active status
function toggleActive(productId, galleryId) {
    fetch(`/admin/products/${productId}/galleries/${galleryId}/toggle-active`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi cập nhật trạng thái');
    });
}

// Delete gallery
let deleteProductId, deleteGalleryId;

function deleteGallery(productId, galleryId) {
    deleteProductId = productId;
    deleteGalleryId = galleryId;
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('modalContent');
    
    modal.classList.remove('hidden');
    
    // Animate modal in
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('modalContent');
    
    // Animate modal out
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

document.getElementById('confirmDelete').addEventListener('click', function() {
    // Show loading state
    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Đang xóa...';
    this.disabled = true;
    
    fetch(`/admin/products/${deleteProductId}/galleries/${deleteGalleryId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success animation before reload
            const modalContent = document.getElementById('modalContent');
            modalContent.innerHTML = `
                <div class="p-6 text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Xóa thành công!</h3>
                    <p class="text-gray-600">Ảnh đã được xóa khỏi hệ thống</p>
                </div>
            `;
            
            setTimeout(() => {
                location.reload();
            }, 1500);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi xóa ảnh');
        
        // Reset button
        this.innerHTML = '<i class="fas fa-trash mr-2"></i>Xóa ảnh';
        this.disabled = false;
    });
});
</script>
@endpush 