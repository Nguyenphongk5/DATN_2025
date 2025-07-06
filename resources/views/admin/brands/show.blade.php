<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-copyright text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Chi tiết thương hiệu</h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 drop-shadow-lg flex items-center gap-2 mb-8">
                    <i class="fas fa-copyright animate-bounce text-indigo-400"></i>
                    Chi tiết thương hiệu
                </h1>
                <div class="flex flex-col md:flex-row gap-8 mb-8">
                    <div class="flex-shrink-0 flex flex-col items-center justify-center">
                        @if ($brand->logo)
                            <img src="{{ asset('storage/' . $brand->logo) }}" alt="Logo" class="w-32 h-32 object-cover rounded-full ring-4 ring-sky-300 shadow-lg mb-4">
                        @else
                            <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                <span class="text-gray-400 text-xs">No Image</span>
                            </div>
                        @endif
                        <span class="mt-2 px-4 py-1 rounded-full text-xs font-bold shadow @if($brand->is_active == 1) bg-gradient-to-r from-green-300 via-emerald-400 to-cyan-300 text-green-900 ring-2 ring-green-200/60 animate-pulse @else bg-gradient-to-r from-red-300 via-pink-400 to-fuchsia-300 text-red-900 ring-2 ring-pink-200/60 @endif">
                            {{ $brand->is_active == 1 ? 'Đang hoạt động' : 'Đã ẩn' }}
                        </span>
                    </div>
                    <div class="flex-1">
                        <div class="mb-4">
                            <span class="block text-lg font-bold text-indigo-700 mb-1">Tên thương hiệu:</span>
                            <span class="text-xl font-extrabold text-gray-900">{{ $brand->name }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="block text-lg font-bold text-indigo-700 mb-1">Mô tả:</span>
                            <span class="text-base text-gray-700">{{ $brand->description ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex gap-4 justify-center">
                    <a href="{{ route('admin.brands.index') }}" class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách
                    </a>
                    <a href="{{ route('admin.brands.edit', $brand->id) }}" class="bg-gradient-to-r from-yellow-400 to-pink-500 hover:from-pink-500 hover:to-yellow-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-edit"></i> Sửa
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
