<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVoucherRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $voucherId = $this->route()->parameter('voucher');
        return [
            'code' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($voucherId) {
                    $exists = \App\Models\Voucher::where('code', $value)
                        ->where('id', '!=', $voucherId)
                        ->exists();
                    if ($exists) {
                        $fail('Mã voucher đã tồn tại.');
                    }
                }
            ],
            'discount_type' => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'quantity' => 'required|integer|min:1',
            'user_limit' => 'required|integer|min:1',
            'min_money' => 'required|numeric|min:0',
            'max_money' => 'nullable|numeric|min:0',
            'is_active' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Vui lòng nhập mã voucher.',
            'discount_type.required' => 'Vui lòng chọn loại voucher.',
            'discount_type.in' => 'Loại voucher không hợp lệ.',
            'discount_value.required' => 'Vui lòng nhập giá trị voucher.',
            'discount_value.numeric' => 'Giá trị voucher phải là số.',
            'start_date.required' => 'Vui lòng nhập ngày bắt đầu.',
            'end_date.required' => 'Vui lòng nhập ngày kết thúc.',
            'end_date.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'user_limit.required' => 'Vui lòng nhập giới hạn sử dụng.',
            'user_limit.integer' => 'Giới hạn sử dụng phải là số nguyên.',
            'min_money.required' => 'Vui lòng nhập giá trị đơn hàng tối thiểu.',
            'min_money.numeric' => 'Giá trị đơn hàng tối thiểu phải là số.',
            'max_money.required' => 'Vui lòng nhập giá trị đơn hàng tối đa.',
            'max_money.numeric' => 'Giá trị đơn hàng tối đa phải là số.',
            'is_active.required' => 'Vui lòng chọn trạng thái.',
        ];
    }
}
