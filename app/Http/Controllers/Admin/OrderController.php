<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        // Lọc theo từ khóa
        if ($keyword = $request->keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('order_code', 'like', "%$keyword%")
                    ->orWhere('user_name', 'like', "%$keyword%")
                    ->orWhere('user_phone', 'like', "%$keyword%")
                    ->orWhere('user_email', 'like', "%$keyword%");
            });
        }

        // Lọc theo trạng thái đơn hàng
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Lọc theo trạng thái thanh toán
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function create() {}
    public function store(Request $request) {}
    public function show($id)
    {
        $order = Order::with('orderDetails.productVariant')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function edit(string $id) {}
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'cancelled') {
            return back()->with('error', 'Không thể cập nhật trạng thái đơn hàng đã huỷ.');
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,shipping,completed,cancelled',
        ]);

        // Danh sách thứ tự trạng thái
        $statusOrder = [
            'pending'    => 1,
            'confirmed'  => 2,
            'shipping'   => 3,
            'completed'  => 4,
            'cancelled'  => 5, // có thể đặt cao nhất để ngăn quay lại trạng thái khác
        ];

        $currentStatus = $statusOrder[$order->status];
        $newStatus = $statusOrder[$request->status];

        // Nếu trạng thái mới nhỏ hơn trạng thái hiện tại => không cho cập nhật
        if ($newStatus < $currentStatus) {
            return back()->with('error', 'Không thể cập nhật về trạng thái trước đó.');
        }

        // Nếu hợp lệ thì cập nhật
        if ($newStatus == 4 && $order->payment_status !== 'Paid') {
            $order->payment_status = 'Paid';
            $order->save(); // Cập nhật phương thức thanh toán thành đã thanh toán
        }
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }


    public function destroy(string $id) {}
}