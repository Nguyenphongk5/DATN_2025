<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmailCommand extends Command
{
    protected $signature = 'test:email';
    protected $description = 'Test sending email';

    public function handle()
    {
        try {
            Mail::raw('Test email from Laravel', function($message) {
                $message->to('phongnvph50612@gmail.com')
                        ->subject('Test Email - Laravel');
            });

            $this->info('Email sent successfully!');
        } catch (\Exception $e) {
            $this->error('Error sending email: ' . $e->getMessage());
        }
    }
} 