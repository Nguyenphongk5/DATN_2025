<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdminOtp;
use App\Models\User;

class ShowOtpCommand extends Command
{
    protected $signature = 'show:otp {email}';
    protected $description = 'Show OTP for testing';

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

        // Tìm OTP hiện tại
        $otp = AdminOtp::where('user_id', $user->id)
                       ->where('is_used', false)
                       ->where('expires_at', '>', now())
                       ->first();

        if (!$otp) {
            $this->info("No active OTP found. Creating new OTP...");
            
            // Tạo OTP mới
            $otp = AdminOtp::generateOtp($user->id, '127.0.0.1', 'Test Command');
        }

        $this->info("=== OTP INFORMATION ===");
        $this->info("User: {$user->name} ({$user->email})");
        $this->info("OTP Code: {$otp->otp}");
        $this->info("Expires at: {$otp->expires_at}");
        $this->info("Is Used: " . ($otp->is_used ? 'Yes' : 'No'));
        $this->info("IP Address: {$otp->ip_address}");
        $this->info("======================");
        
        $this->info("You can use this OTP to test the admin login!");
    }
} 