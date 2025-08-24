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

    /**
     * Quan hệ với Comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->where('is_active', 1);
    }

    /**
     * Lấy rating trung bình của sản phẩm
     */
    public function getAverageRatingAttribute()
    {
        $rating = $this->comments()->whereNotNull('rating')->avg('rating');
        return $rating ? round($rating, 1) : 0;
    }

    /**
     * Lấy số lượng đánh giá
     */
    public function getRatingCountAttribute()
    {
        return $this->comments()->whereNotNull('rating')->count();
    }

    /**
     * Lấy phân phối rating (5 sao, 4 sao, 3 sao, 2 sao, 1 sao)
     */
    public function getRatingDistributionAttribute()
    {
        $distribution = [];
        for ($i = 1; $i <= 5; $i++) {
            $distribution[$i] = $this->comments()->where('rating', $i)->count();
        }
        return $distribution;
    }


}
