<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderReturn;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = OrderReturn::with('user', 'order')->latest()->paginate(10);
        return view('admin.returns.index', compact('returns'));
    }

    public function show($id)
    {
        $return = OrderReturn::with('order.orderDetails.productVariant.product')->findOrFail($id);

        return view('admin.returns.show', compact('return'));
    }

    public function approve($id)
    {
        $return = OrderReturn::findOrFail($id);
        $return->status = 'approved';
        $return->save();

        return redirect()->back()->with('success', 'Đã duyệt yêu cầu hoàn hàng.');
    }

    public function reject($id)
    {
        $return = OrderReturn::findOrFail($id);
        $return->status = 'rejected';
        $return->save();

        return redirect()->back()->with('error', 'Đã từ chối yêu cầu hoàn hàng.');
    }
public function update(Request $request, $id)
{
    $return = OrderReturn::findOrFail($id);

    $action = $request->input('action'); // lấy từ button name="action"

    if ($action) {
        if (!in_array($action, ['approve', 'reject'])) {
            return redirect()->back()->with('error', 'Hành động không hợp lệ.');
        }

        $return->status = $action === 'approve' ? 'approved' : 'rejected';
    }

    if ($request->filled('shop_response')) {
        $return->response_note = $request->input('shop_response');
    }

    $return->save();

    return redirect()->route('admin.returns.show', $id)
                     ->with('success', 'Cập nhật thông tin thành công!');
}




}
