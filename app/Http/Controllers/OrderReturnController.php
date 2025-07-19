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

    public function store(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,id',
        'reason' => 'required|string',
        'note' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('order_returns', 'public');
    }

    OrderReturn::create([
        'order_id' => $request->order_id,
        'user_id' => auth()->id(),
        'reason' => $request->reason,
        'note' => $request->note,
        'image' => $imagePath,
    ]);

    return redirect()->back()->with('success', 'Đã gửi yêu cầu hoàn hàng!');
}

}
