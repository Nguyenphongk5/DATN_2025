<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\AdminOtp;

class AdminOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $user;
    public $expiresAt;

    /**
     * Create a new message instance.
     */
    public function __construct(AdminOtp $otp)
    {
        $this->otp = $otp;
        $this->user = $otp->user;
        $this->expiresAt = $otp->expires_at;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mã xác thực OTP - Trang quản trị',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-otp',
            with: [
                'otp' => $this->otp->otp,
                'user' => $this->user,
                'expiresAt' => $this->expiresAt,
                'ipAddress' => $this->otp->ip_address,
                'userAgent' => $this->otp->user_agent
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
} 