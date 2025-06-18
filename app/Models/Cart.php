<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    /**
     * Quan hệ: Một giỏ hàng có nhiều item
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Quan hệ: Giỏ hàng thuộc về user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
