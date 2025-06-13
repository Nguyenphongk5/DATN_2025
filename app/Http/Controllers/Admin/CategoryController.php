<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::with('parent')->latest('id')->paginate(10);

        return view('admin.category.list', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();

        return view('admin.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        Category::create([
            'name' => $validated['name'],
            'parent_id' => $validated['parent_id'] ?? null,
            'is_active' => $validated['is_active'],
        ]);

        return redirect()->route('admin.category.listCategory')
            ->with('success', 'Thêm danh mục thành công!');
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
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->get(); // Không cho chọn chính nó làm cha

        return view('admin.category.update', compact('category', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validated();

        $category->update($validated);

        return redirect()->route('admin.category.listCategory')
            ->with('success', 'Cập nhật danh mục thành công!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Đếm số sản phẩm thuộc danh mục này
        $productCount = $category->products()->count();

        if ($productCount > 0) {
            // Nếu còn sản phẩm, trả về thông báo nhắc nhở
            return redirect()->route('admin.category.listCategory')
                ->with('warning', 'Không thể xóa danh mục vì vẫn còn sản phẩm thuộc danh mục này. Vui lòng xóa chọn danh mục khác!!!.');
        }

        // Nếu không còn sản phẩm, cho phép xóa
        $category->delete();

        return redirect()->route('admin.category.listCategory')
            ->with('success', 'Xóa danh mục thành công!');
    }
}
