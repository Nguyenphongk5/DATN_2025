<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-undo-alt text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Quản lý hoàn hàng</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-orange-500 to-yellow-400 text-center mb-8 drop-shadow-lg flex items-center justify-center gap-3">
            <i class="fas fa-clipboard-check animate-bounce text-red-400"></i>
            Danh sách yêu cầu hoàn hàng
        </h1>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <div class="overflow-x-auto custom-scrollbar rounded-2xl">
                    <table class="w-full table-auto border-collapse shadow-xl rounded-2xl overflow-hidden">
                        <thead class="bg-gradient-to-r from-red-100 via-orange-100 to-yellow-100 text-red-700">
                            <tr>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">STT</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Mã đơn</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Tên khách</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Lý do</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Trạng thái</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Thời gian</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-red-100 text-center text-lg">
                            @foreach ($returns as $key => $return)
                                <tr class="hover:bg-gradient-to-r hover:from-orange-50 hover:to-yellow-50 transition">
                                    <td class="px-6 py-4 font-bold">{{ $key + 1 }}</td>
                                    <td class="px-6 py-4 font-mono text-red-600">{{ $return->order->order_code }}</td>
                                    <td class="px-6 py-4 font-semibold">{{ $return->user->name }}</td>
                                    <td class="px-6 py-4">{{ $return->reason }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-400',
                                                'approved' => 'bg-green-50 text-green-700 border-green-400',
                                                'rejected' => 'bg-red-50 text-red-700 border-red-400',
                                            ];
                                        @endphp
                                        <span class="inline-block px-4 py-1 rounded-xl font-bold text-base shadow-sm border {{ $statusColors[$return->status] ?? 'bg-gray-100 text-gray-600 border-gray-400' }}">
                                            {{ ucfirst($return->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $return->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2 justify-center">
                                            <a href="{{ route('admin.returns.show', $return->id) }}"
                                                class="bg-gradient-to-r from-red-400 to-orange-500 hover:from-orange-500 hover:to-red-400 text-white font-bold py-2 px-6 rounded-xl shadow-lg flex items-center gap-2 transition">
                                                <i class="fas fa-eye"></i> Xem
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Phân trang --}}
                    @if (isset($returns) && $returns->hasPages())
                        <div class="mt-8 flex justify-center">
                            {{ $returns->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
