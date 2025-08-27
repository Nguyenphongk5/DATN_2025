<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AdminOtp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'otp',
        'expires_at',
        'is_used',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Kiểm tra OTP có hợp lệ không
    public function isValid()
    {
        return !$this->is_used && $this->expires_at->isFuture();
    }

    // Đánh dấu OTP đã sử dụng
    public function markAsUsed()
    {
        $this->update(['is_used' => true]);
    }

    // Tạo OTP mới
    public static function generateOtp($userId, $ipAddress = null, $userAgent = null)
    {
        // Xóa OTP cũ của user này (chỉ xóa những OTP đã hết hạn hoặc đã sử dụng)
        self::where('user_id', $userId)
            ->where(function($query) {
                $query->where('is_used', true)
                      ->orWhere('expires_at', '<', Carbon::now());
            })
            ->delete();

        // Tạo OTP mới
        return self::create([
            'user_id' => $userId,
            'otp' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT),
            'expires_at' => Carbon::now()->addMinutes(10), // Hết hạn sau 10 phút
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent
        ]);
    }

    // Kiểm tra OTP có tồn tại và hợp lệ
    public static function verifyOtp($userId, $otp)
    {
        $otpRecord = self::where('user_id', $userId)
            ->where('otp', $otp)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($otpRecord) {
            $otpRecord->markAsUsed();
            return true;
        }

        return false;
    }

    // Lấy OTP hiện tại của user (để debug)
    public static function getCurrentOtp($userId)
    {
        return self::where('user_id', $userId)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();
    }
} 