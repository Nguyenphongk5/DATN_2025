<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdminOtp;
use App\Models\User;

class CheckOtpDatabaseCommand extends Command
{
    protected $signature = 'check:otp-db {email?}';
    protected $description = 'Check OTP records in database';

    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info("=== CHECKING OTP DATABASE ===");
        
        // Kiểm tra tổng số OTP
        $totalOtps = AdminOtp::count();
        $this->info("Total OTPs in database: {$totalOtps}");
        
        if ($totalOtps > 0) {
            $this->info("Latest OTPs:");
            $latestOtps = AdminOtp::with('user')->latest()->take(5)->get();
            
            foreach ($latestOtps as $otp) {
                $this->info("- ID: {$otp->id}, User: {$otp->user->email}, OTP: {$otp->otp}, Used: " . ($otp->is_used ? 'Yes' : 'No') . ", Expires: {$otp->expires_at}");
            }
        }
        
        // Nếu có email, kiểm tra OTP của user đó
        if ($email) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $this->info("\n=== OTPs for {$email} ===");
                $userOtps = AdminOtp::where('user_id', $user->id)->latest()->get();
                
                if ($userOtps->count() > 0) {
                    foreach ($userOtps as $otp) {
                        $this->info("- OTP: {$otp->otp}, Used: " . ($otp->is_used ? 'Yes' : 'No') . ", Expires: {$otp->expires_at}");
                    }
                } else {
                    $this->info("No OTPs found for this user.");
                }
            } else {
                $this->error("User with email {$email} not found!");
            }
        }
        
        $this->info("=== END CHECK ===");
    }
} 