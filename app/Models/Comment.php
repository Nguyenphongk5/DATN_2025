<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'content',
         'rating',
        'parent_id',
        'is_active',
    ];

    // Quan hệ: bình luận thuộc về người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ: bình luận thuộc về sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Quan hệ: bình luận cha
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Quan hệ: các bình luận con (reply)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
