<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-undo-alt text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Chi tiết yêu cầu hoàn hàng</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-lg">
                    <div>
                        <strong class="text-gray-700">Mã đơn hàng:</strong>
                        <p class="font-mono text-red-600 text-xl">{{ $return->order->order_code }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-700">Khách hàng:</strong>
                        <p class="font-semibold">{{ $return->user->name }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-700">Lý do hoàn hàng:</strong>
                        <p class="text-gray-800">{{ $return->reason }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-700">Trạng thái:</strong>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-400',
                                'approved' => 'bg-green-50 text-green-700 border-green-400',
                                'rejected' => 'bg-red-50 text-red-700 border-red-400',
                            ];
                        @endphp
                        <span class="inline-block px-4 py-1 mt-1 rounded-xl font-bold text-base shadow-sm border {{ $statusColors[$return->status] ?? 'bg-gray-100 text-gray-600 border-gray-400' }}">
                            {{ ucfirst($return->status) }}
                        </span>
                    </div>
                    <div>
                        <strong class="text-gray-700">Thời gian gửi yêu cầu:</strong>
                        <p>{{ $return->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    @if ($return->image)
                        <div class="md:col-span-2">
                            <strong class="text-gray-700">Ảnh minh họa:</strong>
                            <img src="{{ asset('storage/returns/' . $return->image) }}" alt="Ảnh hoàn hàng" class="w-full max-w-md mt-2 rounded-xl border shadow">
                        </div>
                    @endif
                </div>

                @if ($return->status === 'pending')
                    <div class="flex justify-center mt-10 gap-4">
                        <form action="{{ route('admin.returns.update', ['id' => $return->id, 'action' => 'approve']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-bold py-2 px-6 rounded-xl shadow-lg flex items-center gap-2 transition">
                                <i class="fas fa-check-circle"></i> Duyệt
                            </button>
                        </form>

                        <form action="{{ route('admin.returns.update', ['id' => $return->id, 'action' => 'reject']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white font-bold py-2 px-6 rounded-xl shadow-lg flex items-center gap-2 transition">
                                <i class="fas fa-times-circle"></i> Từ chối
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
