<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdminOtp;
use App\Models\User;
use App\Mail\AdminOtpMail;
use Illuminate\Support\Facades\Mail;

class TestOtpFlowCommand extends Command
{
    protected $signature = 'test:otp-flow {email}';
    protected $description = 'Test complete OTP flow';

    public function handle()
    {
        $email = $this->argument('email');
        
        // Tìm user theo email
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found!");
            return;
        }

        if (!$user->isAdmin()) {
            $this->error("User {$email} is not an admin!");
            return;
        }

        $this->info("=== TESTING OTP FLOW ===");
        $this->info("User: {$user->name} ({$user->email})");
        $this->info("Role: {$user->role}");
        $this->info("========================");

        try {
            // Bước 1: Tạo OTP
            $this->info("1. Creating OTP...");
            $otp = AdminOtp::generateOtp($user->id, '127.0.0.1', 'Test Command');
            $this->info("   ✅ OTP created: {$otp->otp}");
            $this->info("   ⏰ Expires at: {$otp->expires_at}");

            // Bước 2: Gửi email
            $this->info("2. Sending email...");
            Mail::to($user->email)->send(new AdminOtpMail($otp));
            $this->info("   ✅ Email sent to {$user->email}");

            // Bước 3: Verify OTP
            $this->info("3. Testing OTP verification...");
            $isValid = AdminOtp::verifyOtp($user->id, $otp->otp);
            $this->info("   " . ($isValid ? "✅ OTP is valid" : "❌ OTP is invalid"));

            $this->info("=== FLOW COMPLETED SUCCESSFULLY ===");
            $this->info("🔐 OTP Code: {$otp->otp}");
            $this->info("📧 Check email: {$user->email}");
            $this->info("🌐 Test URL: http://127.0.0.1:8000/admin/otp");
            
        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
        }
    }
} 