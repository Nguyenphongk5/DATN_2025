<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Validation\Rule;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::orderByDesc('created_at')->get();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:vouchers,code'],
            'discount_type' => ['required', Rule::in(['percent', 'fixed'])],
            'discount_value' => ['required', 'numeric', 'min:1'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'quantity' => ['required', 'integer', 'min:1'],
            'user_limit' => ['required', 'integer', 'min:1'],
            'min_money' => ['required', 'numeric', 'min:0'],
            'max_money' => ['required', 'numeric', 'gte:min_money'],
            'is_active' => ['required', 'boolean'],
        ]);
        $validated['used_count'] = 0;
        Voucher::create($validated);
        return redirect()->route('admin.vouchers.index')->with('success', 'Tạo voucher thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.vouchers.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('vouchers', 'code')->ignore($voucher->id)],
            'discount_type' => ['required', Rule::in(['percent', 'fixed'])],
            'discount_value' => ['required', 'numeric', 'min:1'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'quantity' => ['required', 'integer', 'min:' . $voucher->used_count],
            'user_limit' => ['required', 'integer', 'min:1'],
            'min_money' => ['required', 'numeric', 'min:0'],
            'max_money' => ['required', 'numeric', 'gte:min_money'],
            'is_active' => ['required', 'boolean'],
        ]);
        $voucher->update($validated);
        return redirect()->route('admin.vouchers.index')->with('success', 'Cập nhật voucher thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Xóa voucher thành công!');
    }

    /**
     * Hiển thị lịch sử sử dụng voucher
     */
    public function usages()
    {
        $usages = \App\Models\VoucherUsage::with(['voucher', 'user', 'order'])
            ->orderByDesc('used_at')
            ->paginate(20);
        return view('admin.vouchers.usages', compact('usages'));
    }
}
