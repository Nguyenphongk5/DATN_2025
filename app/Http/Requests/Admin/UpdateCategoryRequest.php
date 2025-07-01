<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:categories,name,' . $this->route('id'),
            'parent_id' => 'nullable|exists:categories,id',
            'is_active' => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'name.required'   => 'Vui lòng nhập tên danh mục.',
            'name.unique'     => 'Tên danh mục đã tồn tại, vui lòng chọn tên khác.',
            'name.max'        => 'Tên danh mục không được vượt quá :max ký tự.',
            'parent_id.exists' => 'Danh mục cha không hợp lệ.',
            'is_active.required' => 'Vui lòng chọn trạng thái.',
            'is_active.boolean'  => 'Trạng thái không hợp lệ.',
        ];
    }
}
