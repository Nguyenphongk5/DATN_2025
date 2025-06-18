<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'size',
        'color_name',
        'hex_code',
        'quantity',
        'price',
        'price_sale',
    ];

    /**
     * Quan hệ với sản phẩm cha (Product)
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
