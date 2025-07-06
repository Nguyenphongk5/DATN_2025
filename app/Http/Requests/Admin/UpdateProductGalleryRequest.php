<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductGalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'image.image' => 'File phải là ảnh.',
            'image.mimes' => 'Định dạng ảnh không được hỗ trợ. Chỉ chấp nhận: jpeg, png, jpg, gif, webp.',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB.',
            'alt_text.string' => 'Alt text phải là chuỗi.',
            'alt_text.max' => 'Alt text không được vượt quá 255 ký tự.',
            'sort_order.integer' => 'Thứ tự phải là số nguyên.',
            'sort_order.min' => 'Thứ tự không được nhỏ hơn 0.',
            'is_active.boolean' => 'Trạng thái không hợp lệ.',
        ];
    }
} 