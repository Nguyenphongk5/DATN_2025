<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    // Các role có thể có
    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';
    public const ROLE_STAFF = 'staff';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'province',
        'district',
        'ward',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Thuộc tính casts đúng chuẩn Laravel
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Trả về danh sách role hợp lệ
     */
    public static function roles(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_USER,
            self::ROLE_STAFF,
        ];
    }
    public function getIsAdminAttribute()
    {
        return $this->role === ' admin ';
    }

    /**
     * Quan hệ messages cho chat
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
