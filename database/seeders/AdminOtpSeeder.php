<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminOtp;
use App\Models\User;

class AdminOtpSeeder extends Seeder
{
    public function run()
    {
        // Xóa tất cả OTP cũ
        AdminOtp::truncate();

        // Lấy tất cả admin users
        $adminUsers = User::where('role', 'admin')->get();

        foreach ($adminUsers as $admin) {
            // Tạo OTP mẫu cho mỗi admin (nếu cần)
            // AdminOtp::create([
            //     'user_id' => $admin->id,
            //     'otp' => '123456',
            //     'expires_at' => now()->addMinutes(10),
            //     'is_used' => false,
            //     'ip_address' => '127.0.0.1',
            //     'user_agent' => 'Seeder'
            // ]);
        }

        $this->command->info('Admin OTP seeder completed!');
    }
} 