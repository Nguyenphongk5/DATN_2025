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
}
