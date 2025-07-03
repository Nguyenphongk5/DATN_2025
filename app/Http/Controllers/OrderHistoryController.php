<?php

namespace App\Http\Controllers;


use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
        ->orderByDesc('created_at')
        ->paginate(5); // Hiển thị 5 đơn mỗi trang

    return view('user.order_history', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id', $id)
    ->where('user_id', Auth::id())
    ->with(['orderDetails.productVariant.product']) // load hình ảnh qua variant
    ->firstOrFail();

        return view('user.history_detail', compact('order'));
    }
    public function cancel($id)
{
    $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    if (!in_array($order->status, ['pending', 'confirmed'])) {
        return back()->with('error', 'Không thể hủy đơn hàng khi đã xác nhận.');
    }

    $order->update([
        'status' => 'cancelled'
    ]);

    return back()->with('success', 'Đơn hàng đã được hủy.');
}

}
