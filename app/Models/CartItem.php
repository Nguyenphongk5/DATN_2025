<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_variant_id',
        'quantity',
    ];

    /**
     * Quan hệ: CartItem thuộc về Cart
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Quan hệ: CartItem thuộc về ProductVariant
     */
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
