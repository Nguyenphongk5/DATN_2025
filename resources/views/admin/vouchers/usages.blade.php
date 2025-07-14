@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6 text-blue-700 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l2-2m0 0l2-2m-2 2V7m0 5v5m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
        Lịch sử sử dụng voucher
    </h1>
    <div class="overflow-x-auto rounded shadow">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gradient-to-r from-blue-50 to-blue-100 sticky top-0 z-10">
                <tr>
                    <th class="border px-3 py-2 text-center">#</th>
                    <th class="border px-3 py-2 text-left">Mã voucher</th>
                    <th class="border px-3 py-2 text-left">User</th>
                    <th class="border px-3 py-2 text-left">Đơn hàng</th>
                    <th class="border px-3 py-2 text-left">Thời gian dùng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usages as $usage)
                <tr class="hover:bg-blue-50 transition">
                    <td class="border px-3 py-2 text-center">{{ $loop->iteration + ($usages->currentPage()-1)*$usages->perPage() }}</td>
                    <td class="border px-3 py-2 font-mono font-semibold">{{ $usage->voucher->code ?? '-' }}</td>
                    <td class="border px-3 py-2">{{ $usage->user->name ?? '-' }}<br><span class="text-xs text-gray-500">{{ $usage->user->email ?? '' }}</span></td>
                    <td class="border px-3 py-2">
                        @if($usage->order)
                            <a href="{{ route('admin.orders.show', $usage->order->id) }}" class="text-blue-600 hover:underline">#{{ $usage->order->order_code }}</a>
                        @else
                            -
                        @endif
                    </td>
                    <td class="border px-3 py-2">{{ $usage->used_at ? $usage->used_at->format('d/m/Y H:i') : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $usages->links() }}</div>
</div>
@endsection 