<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class OrderHistoryController extends Controller
{
   // Trong OrderController

public function history()
{
    $orders = Order::with('orderDetails.productVariant.product')
        ->where('user_id', auth()->id())
        ->orderByDesc('created_at')
        ->paginate(5);

    return view('user.order_history', compact('orders'));
}

public function filter(Request $request)
{
    $status = $request->input('status');

    $orders = Order::with('orderDetails.productVariant.product')
        ->where('user_id', auth()->id())
        ->when($status, fn($q) => $q->where('status', $status))
        ->orderByDesc('created_at')
        ->paginate(5);

    return view('user.order_items', compact('orders'));
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



public function reorder(Order $order)
{
    if ($order->user_id !== auth()->id()) {
        abort(403, 'Bạn không có quyền mua lại đơn hàng này');
    }

    $items = [];

    foreach ($order->orderDetails as $detail) {
        $variant = $detail->productVariant;
        if (!$variant) continue;

        $items[] = [
            'product_id' => $variant->product_id,
            'size' => $variant->size,
            'color_name' => $variant->color_name,
            'quantity' => $detail->quantity,
        ];
    }

    if (empty($items)) {
        return back()->with('error', 'Không có sản phẩm hợp lệ để mua lại.');
    }

    // Gán toàn bộ vào session (dạng mảng nhiều sản phẩm)
    session(['reorder_items' => $items]);

    return redirect()->route('checkout.reorder');
}


}