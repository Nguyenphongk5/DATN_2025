<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreVoucherRequest;
use App\Http\Requests\Admin\UpdateVoucherRequest;

class VoucherController extends Controller
{
    // Hiển thị danh sách voucher
    public function index()
    {
        $vouchers = Voucher::all();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    // Hiển thị form tạo mới voucher
    public function create()
    {
        return view('admin.vouchers.create');
    }

    // Lưu voucher mới
    public function store(StoreVoucherRequest $request)
    {
        Voucher::create($request->validated());
        return redirect()->route('admin.vouchers.index')->with('success', 'Tạo voucher thành công!');
    }

    // Hiển thị form sửa voucher
    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    // Cập nhật voucher
    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        $voucher->update($request->validated());
        return redirect()->route('admin.vouchers.index')->with('success', 'Cập nhật voucher thành công!');
    }

    // Xóa voucher
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Xóa voucher thành công!');
    }
}
