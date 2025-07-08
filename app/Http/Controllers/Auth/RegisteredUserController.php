<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $categories = DB::table('categories')->get();
        return view('auth.register', compact('categories'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);
        if (strlen($request->name) < 3) {
            return back()->withInput($request->only('name', 'email'))
                ->with('error', 'Tên người dùng phải có ít nhất 3 ký tự.');
        }
        if (User::where('email', $request->email)->exists()) {
            return back()->withInput($request->only('name', 'email'))
                ->with('error', 'Email đã tồn tại trong hệ thống.');
        }
        if (strlen($request->password) < 8) {
            return back()->withInput($request->only('name', 'email'))
                ->with('error', 'Mật khẩu phải có ít nhất 8 ký tự.');
        }
        if ($request->password_confirmation !== $request->password) {
            return back()->withInput($request->only('name', 'email'))
                ->with('error', 'Mật khẩu xác nhận không khớp.');
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home.index', absolute: false))->with(
            'success',
            'Đăng ký thành công! Bạn đã được đăng nhập.'
        );
    }
}
