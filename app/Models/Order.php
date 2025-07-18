<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'user_phone',
        'user_address',
        'province',
        'district',
        'ward',
        'discount_amount',
        'total_amount',
        'status',
        'payment_method',
        'payment_status',
        'shipping_fee',
        'shipping_method',
        'shipped_at',
        'order_code',
        'note',
        'admin_note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
