<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // Quan hệ với Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}