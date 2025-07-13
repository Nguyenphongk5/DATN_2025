<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            if ($user = User::where('email', $googleUser->getEmail())->exists()) {
                return redirect()->route('login')->with('error', 'Email đã được sử dụng để đăng ký tài khoản khác.');
            }

            $user = User::updateOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => bcrypt('default_password'),
            ]);

            Auth::login($user);

            return redirect()->route('home'); // hoặc dashboard
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Lỗi đăng nhập Google');
        }
    }
}
