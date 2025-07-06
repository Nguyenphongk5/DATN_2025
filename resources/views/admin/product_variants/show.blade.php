<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-cube text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Chi tiết biến thể sản phẩm</h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <h1
                    class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 drop-shadow-lg flex items-center gap-2 mb-8">
                    <i class="fas fa-cube animate-bounce text-indigo-400"></i>
                    {{ $productVariant->name ?? 'Chi tiết biến thể' }}
                </h1>
                <div class="overflow-x-auto custom-scrollbar rounded-2xl">
                    <table class="w-full table-auto border-collapse shadow-xl rounded-2xl overflow-hidden text-base">
                        <thead class="bg-gradient-to-r from-indigo-100 via-sky-100 to-cyan-100 text-indigo-700">
                            <tr>
                                <!-- ... giữ nguyên các cột ... -->
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-indigo-100 text-center">
                            <tr>
                                <!-- ... giữ nguyên dữ liệu, chỉ thêm style cho badge trạng thái ... -->
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-8 flex gap-4 justify-center">
                    <a href="{{ route('admin.product_variants.index') }}"
                        class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách
                    </a>
                    <a href="{{ route('admin.product_variants.edit', $productVariant->id) }}"
                        class="bg-gradient-to-r from-yellow-400 to-pink-500 hover:from-pink-500 hover:to-yellow-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-edit"></i> Chỉnh sửa
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
