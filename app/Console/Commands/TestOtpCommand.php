<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdminOtp;
use App\Models\User;
use App\Mail\AdminOtpMail;
use Illuminate\Support\Facades\Mail;

class TestOtpCommand extends Command
{
    protected $signature = 'test:otp {email}';
    protected $description = 'Test OTP functionality';

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
            // Tạo OTP
            $otp = AdminOtp::generateOtp($user->id, '127.0.0.1', 'Test Command');
            
            $this->info("OTP created: {$otp->otp}");
            $this->info("Expires at: {$otp->expires_at}");
            
            // Gửi email
            Mail::to($user->email)->send(new AdminOtpMail($otp));
            
            $this->info("OTP email sent to {$user->email}!");
            
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
        }
    }
} 