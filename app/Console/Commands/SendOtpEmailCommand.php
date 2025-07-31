<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdminOtp;
use App\Models\User;
use App\Mail\AdminOtpMail;
use Illuminate\Support\Facades\Mail;

class SendOtpEmailCommand extends Command
{
    protected $signature = 'send:otp-email {email}';
    protected $description = 'Send OTP email with detailed information';

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

        try {
            // Tạo OTP mới
            $otp = AdminOtp::generateOtp($user->id, '127.0.0.1', 'Test Command');
            
            $this->info("=== OTP CREATED ===");
            $this->info("User: {$user->name} ({$user->email})");
            $this->info("OTP Code: {$otp->otp}");
            $this->info("Expires at: {$otp->expires_at}");
            $this->info("IP Address: {$otp->ip_address}");
            $this->info("==================");
            
            // Gửi email
            Mail::to($user->email)->send(new AdminOtpMail($otp));
            
            $this->info("✅ Email sent successfully to {$user->email}!");
            $this->info("📧 Please check your email (including spam folder)");
            $this->info("🔐 OTP Code: {$otp->otp}");
            $this->info("⏰ Expires at: {$otp->expires_at}");
            
        } catch (\Exception $e) {
            $this->error("❌ Error sending email: " . $e->getMessage());
            $this->error("Stack trace: " . $e->getTraceAsString());
        }
    }
} 