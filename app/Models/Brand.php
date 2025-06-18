<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'is_active',
    ];

    /**
     * Nếu bạn muốn định nghĩa mối quan hệ với Product:
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
