<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'product_variants'; // đúng tên bảng, viết thường, không có khoảng trắng

    protected $fillable = [
        'product_id',
        'size',
        'color_name',
        'hex_code',
        'quantity',
        'price',
        'price_sale',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
