<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    // 
    protected $table = 'cart_items';
    protected $fillable = [
        'id',
        'cart_id',
        'product_variant_id',
        'quantity'
    ];

    public function variant()
{
    return $this->belongsTo(Product_variants::class, 'product_variant_id');
}
}
