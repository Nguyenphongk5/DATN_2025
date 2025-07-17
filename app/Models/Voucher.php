<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'quantity',
        'used_count',
        'user_limit',
        'min_money',
        'max_money',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
