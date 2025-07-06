<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'img_thumb',
        'description',
        'price',
        'price_sale',
        'category_id',
        'brand_id',
        'view',
        'is_active'
    ];
    // Quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    // App\Models\Product.php
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Quan hệ với ProductGallery
     */
    public function galleries()
    {
        return $this->hasMany(ProductGallery::class)->ordered();
    }

    /**
     * Lấy ảnh chính (ảnh đầu tiên trong gallery)
     */
    public function getMainImageAttribute()
    {
        return $this->galleries()->first()?->image ?? $this->img_thumb;
    }

    /**
     * Lấy tất cả ảnh gallery
     */
    public function getAllImagesAttribute()
    {
        return $this->galleries()->pluck('image')->toArray();
    }
}
