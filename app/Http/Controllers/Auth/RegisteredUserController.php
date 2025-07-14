<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Hiển thị form đăng ký tài khoản.
     */
    public function create(): View
    {
        $categories = DB::table('categories')->get();
        return view('auth.register', compact('categories'));
    }

    /**
     * Xử lý form đăng ký.
     */
    public function store(Request $request): RedirectResponse
    {
        // ✅ VALIDATE dữ liệu đầu vào
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            // Địa chỉ
            'province' => ['required', 'string'],
            'district' => ['required', 'string'],
            'ward' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
        ], [
            // ✅ Thông báo lỗi tiếng Việt rõ ràng
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.min' => 'Tên phải có ít nhất :min ký tự.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',

            'province.required' => 'Vui lòng chọn Tỉnh/Thành phố.',
            'district.required' => 'Vui lòng chọn Quận/Huyện.',
            'ward.required' => 'Vui lòng chọn Phường/Xã.',
            'address.required' => 'Vui lòng nhập địa chỉ cụ thể.',
            'address.max' => 'Địa chỉ quá dài. Tối đa :max ký tự.',
        ]);

        // ✅ Tạo tài khoản
        $user = User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'province' => $request->input('province'),
            'district' => $request->input('district'),
            'ward'     => $request->input('ward'),
            'address'  => $request->input('address'),
        ]);

        // ✅ Gửi sự kiện và tự đăng nhập
        event(new Registered($user));
        Auth::login($user);

        // ✅ Redirect kèm thông báo
        return redirect()->route('home.index')->with('success', '🎉 Đăng ký thành công! Chào mừng bạn đến với hệ thống.');
    }
}
