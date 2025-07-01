<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logo; // Import model Logo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // Import Storage Facade

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('logos');
        if($request->has('is_active') && $request->is_active !== ''){
            $query->where('logos.is_active', $request->is_active);
        }
        $logos = $query->latest()->paginate(10);
        return view('admin.logo.list', compact('logos')); // Giả sử bạn có view này
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.logo.create'); // Giả sử bạn có view này
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Yêu cầu file ảnh, max 2MB
            'active' => 'boolean',
        ]);

        $imagePath = $request->file('image')->store('logos', 'public');

        // Kiểm tra xem file đã thực sự được lưu hay chưa
        if (!Storage::disk('public')->exists($imagePath)) {
            throw new \Exception("Không thể lưu file ảnh.");
        }
        Logo::create([
            'name' => $request->name,
            'image' => $imagePath,
            'active' => $request->boolean('active'), // Sử dụng boolean() để lấy giá trị boolean
        ]);

        return redirect()->route('admin.logos.index')->with('success', 'Logo đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Logo $logo) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logo $logo)
    {
        // ... (Logic sửa logo)
        return view('admin.logo.update', compact('logo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Logo $logo)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 'nullable' vì user có thể không muốn đổi ảnh
            'active' => 'boolean',
        ]);

        $data = $request->except('_token', '_method');

        if ($request->hasFile('image')) {

            if ($logo->image) {
                Storage::disk('public')->delete($logo->image);
            }

            $newImagePath = $request->file('image')->store('logos', 'public');
            $data['image'] = $newImagePath;
        }

        $logo->update($data);

        return redirect()->route('admin.logos.index')
            ->with('success', 'Cập nhật logo thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logo $logo)
    {
        // Xóa file ảnh khỏi storage trước
        if ($logo->image) {
            Storage::disk('public')->delete($logo->image);
        }
        $logo->delete();

        return redirect()->route('admin.logos.index')->with('success', 'Logo đã được xóa thành công!');
    }
}
