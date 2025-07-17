<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderReturn;
use Illuminate\Support\Facades\Storage;

class OrderReturnController extends Controller
{
    public function create($orderId)
    {
        $order = Order::with('orderDetails.productVariant.product')->findOrFail($orderId);
        return view('user.return', compact('order'));
    }

    public function store(Request $request, $orderId)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
            'note' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('returns', 'public');
        }

        OrderReturn::create([
            'order_id' => $orderId,
            'user_id' => auth()->id(),
            'reason' => $request->reason,
            'note' => $request->note,
            'image' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.show', $orderId)->with('success', 'Gửi yêu cầu hoàn hàng thành công!');
    }
}
