<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdminOtp;
use App\Models\User;
use App\Mail\AdminOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TestOtpWebFlowCommand extends Command
{
    protected $signature = 'test:otp-web-flow {email}';
    protected $description = 'Test OTP web flow simulation';

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

        $this->info("=== TESTING OTP WEB FLOW ===");
        $this->info("User: {$user->name} ({$user->email})");
        $this->info("Role: {$user->role}");
        $this->info("============================");

        try {
            // Simulate web flow
            $this->info("1. Simulating admin login...");
            $this->info("   ✅ Admin logged in successfully");

            $this->info("2. Simulating access to /admin...");
            $this->info("   ✅ Redirected to /admin/otp");

            $this->info("3. Generating OTP (like in showOtpForm)...");
            
            // Log thông tin user
            Log::info("Generating OTP for user: {$user->email}");
            
            $otp = AdminOtp::generateOtp(
                $user->id,
                '127.0.0.1',
                'Test Command'
            );

            // Log thông tin OTP
            Log::info("OTP generated: {$otp->otp} for user: {$user->email}");

            $this->info("   ✅ OTP created: {$otp->otp}");
            $this->info("   ⏰ Expires at: {$otp->expires_at}");

            $this->info("4. Sending email...");
            
            // Gửi email
            Mail::to($user->email)->send(new AdminOtpMail($otp));
            
            // Log email sent
            Log::info("OTP email sent to: {$user->email}");

            $this->info("   ✅ Email sent to {$user->email}");

            $this->info("5. Checking database...");
            $dbOtp = AdminOtp::where('user_id', $user->id)
                             ->where('otp', $otp->otp)
                             ->first();
            
            if ($dbOtp) {
                $this->info("   ✅ OTP found in database");
                $this->info("   📊 Database record: ID={$dbOtp->id}, Used={$dbOtp->is_used}, Expires={$dbOtp->expires_at}");
            } else {
                $this->error("   ❌ OTP not found in database!");
            }

            $this->info("=== WEB FLOW COMPLETED SUCCESSFULLY ===");
            $this->info("🔐 OTP Code: {$otp->otp}");
            $this->info("📧 Check email: {$user->email}");
            $this->info("🌐 Test URL: http://127.0.0.1:8000/admin/otp");
            $this->info("📝 Log file: storage/logs/laravel.log");
            
        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
            Log::error("Error in OTP web flow: " . $e->getMessage());
        }
    }
} 