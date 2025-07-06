<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductGalleryRequest extends FormRequest
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
            'images' => 'required|array|min:1|max:10',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'alt_text.*' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'images.required' => 'Vui lòng chọn ít nhất một ảnh.',
            'images.array' => 'Dữ liệu ảnh không hợp lệ.',
            'images.min' => 'Vui lòng chọn ít nhất một ảnh.',
            'images.max' => 'Chỉ được chọn tối đa 10 ảnh.',
            'images.*.required' => 'Vui lòng chọn ảnh.',
            'images.*.image' => 'File phải là ảnh.',
            'images.*.mimes' => 'Định dạng ảnh không được hỗ trợ. Chỉ chấp nhận: jpeg, png, jpg, gif, webp.',
            'images.*.max' => 'Kích thước ảnh không được vượt quá 2MB.',
            'alt_text.*.string' => 'Alt text phải là chuỗi.',
            'alt_text.*.max' => 'Alt text không được vượt quá 255 ký tự.',
        ];
    }
} 