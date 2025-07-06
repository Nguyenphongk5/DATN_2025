<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;
    // Quan hệ với Product
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'is_active',

    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}